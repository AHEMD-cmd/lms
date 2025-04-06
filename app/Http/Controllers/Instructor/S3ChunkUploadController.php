<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Aws\S3\S3Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class S3ChunkUploadController extends Controller
{
    /**
     * Generate a presigned URL for a chunk upload
     */
    public function getPresignedUrl(Request $request)
    {
        $request->validate([
            'filename' => 'required|string',
            'contentType' => 'required|string',
            'chunkNumber' => 'required|integer',
            'totalChunks' => 'required|integer',
        ]);

        // Create a unique filename with instructor ID to avoid collisions
        $instructorId = auth()->user()->id;
        $uniqueId = Str::uuid()->toString();
        $extension = pathinfo($request->filename, PATHINFO_EXTENSION);
        $baseFilename = Str::slug(pathinfo($request->filename, PATHINFO_FILENAME));
        
        // For temporary chunk storage
        $chunkKey = "temp/course-videos/{$instructorId}/{$uniqueId}/{$baseFilename}-{$request->chunkNumber}.part";
        
        // Generate presigned URL for this chunk
        $s3Client = new S3Client([
            'version' => 'latest',
            'region'  => Config::get('filesystems.disks.s3.region'),
            'credentials' => [
                'key'    => Config::get('filesystems.disks.s3.key'),
                'secret' => Config::get('filesystems.disks.s3.secret'),
            ],
        ]);

        $cmd = $s3Client->getCommand('PutObject', [
            'Bucket' => Config::get('filesystems.disks.s3.bucket'),
            'Key'    => $chunkKey,
            'ContentType' => $request->contentType,
            'ServerSideEncryption' => 'AES256',
        ]);

        $presignedUrl = $s3Client->createPresignedRequest($cmd, '+1 hour')->getUri()->__toString();

        return response()->json([
            'presignedUrl' => $presignedUrl,
            'chunkKey' => $chunkKey,
        ]);
    }

    /**
     * Complete the upload by merging all chunks into the final file
     */
    public function completeUpload(Request $request)
    {
        $request->validate([
            'filename' => 'required|string',
            'chunkKeys' => 'required|array',
            'contentType' => 'required|string',
        ]);

        // Create a unique filename for the final video
        $instructorId = auth()->user()->id;
        $uniqueId = Str::uuid()->toString();
        $extension = pathinfo($request->filename, PATHINFO_EXTENSION);
        $baseFilename = Str::slug(pathinfo($request->filename, PATHINFO_FILENAME)); 
        $finalKey = "course-videos/{$instructorId}/{$baseFilename}-{$uniqueId}.{$extension}";

        $s3Client = new S3Client([
            'version' => 'latest',
            'region'  => Config::get('filesystems.disks.s3.region'),
            'credentials' => [
                'key'    => Config::get('filesystems.disks.s3.key'),
                'secret' => Config::get('filesystems.disks.s3.secret'),
            ],
        ]);

        $bucket = Config::get('filesystems.disks.s3.bucket');

        // Create a multipart upload for the final file
        $multipartUpload = $s3Client->createMultipartUpload([
            'Bucket' => $bucket,
            'Key' => $finalKey,
            'ContentType' => $request->contentType,
            'ServerSideEncryption' => 'AES256', 
        ]);

        $uploadId = $multipartUpload['UploadId'];
        $parts = [];

        // Copy each chunk as a part of the multipart upload
        try {
            foreach ($request->chunkKeys as $index => $chunkKey) {
                $partNumber = $index + 1;
                
                $copyResult = $s3Client->uploadPartCopy([
                    'Bucket' => $bucket,
                    'CopySource' => $bucket . '/' . $chunkKey,
                    'Key' => $finalKey,
                    'PartNumber' => $partNumber,
                    'UploadId' => $uploadId,
                    'RequestHeaders' => [
                        'Referer' => 'http://localhost:8000/'
                    ]
                ]);

                $parts[] = [
                    'ETag' => $copyResult['CopyPartResult']['ETag'],
                    'PartNumber' => $partNumber,
                ];
            }

            // Complete the multipart upload
            $s3Client->completeMultipartUpload([
                'Bucket' => $bucket,
                'Key' => $finalKey,
                'UploadId' => $uploadId,
                'MultipartUpload' => [
                    'Parts' => $parts,
                ],
            ]);

            // Clean up temporary chunks
            foreach ($request->chunkKeys as $chunkKey) {
                $s3Client->deleteObject([
                    'Bucket' => $bucket,
                    'Key' => $chunkKey,
                ]);
            }

            return response()->json([
                'success' => true,
                'videoPath' => $finalKey,
                'videoUrl' => Config::get('filesystems.disks.s3.url') . '/' . $finalKey,
            ]);
        } catch (\Exception $e) {
            // Abort the multipart upload if something goes wrong
            $s3Client->abortMultipartUpload([
                'Bucket' => $bucket,
                'Key' => $finalKey,
                'UploadId' => $uploadId,
            ]);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}