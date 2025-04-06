<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GetTempVideoUrlController extends Controller
{
    /**
     * Handle the incoming request to generate a temporary signed URL for a video
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        try {
            $videoPath = $request->input('video_path');

            // Generate a temporary signed URL that expires in 30 seconds
            $tempUrl = Storage::disk('s3')->temporaryUrl(
                $videoPath,
                now()->addSeconds(3),
                [
                    'ResponseContentType' => 'video/mp4',
                    'ResponseContentDisposition' => 'inline'
                ]
            );

            return response()->json([
                'url' => $tempUrl
            ]);
        } catch (\Exception $e) {
            report($e); // Log the error
            return response()->json([
                'error' => 'Could not generate video URL',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
