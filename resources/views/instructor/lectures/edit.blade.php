@extends('layouts.dashboard.instructor.master')

@section('title', 'Edit Lecture')

@section('css')
    <style>
        .ck-editor__editable {
            min-height: 300px !important;
            max-height: 500px;
            overflow-y: auto;
        }
    </style>
@endsection

@section('content')

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Lecture</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('instructor.courses.sections.index', $course->slug) }}"
                        class="btn btn-primary px-5">Back </a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Edit Lecture</h5>
                <form id="myForm"
                    action="{{ route('instructor.courses.sections.lectures.update', [$course->slug, $section->id, $lecture->id]) }}"
                    method="post" class="row g-3" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group col-md-6">
                        <label for="title" class="form-label">Lecture Title</label>
                        <input type="text" name="title" class="form-control" id="title"
                            value="{{ $lecture->title }}">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-12">
                        <label for="video" class="form-label">Lecture Video</label>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="lecture-upload-container" class="text-center">
                                            <button type="button" id="browseLectureVideo" class="btn btn-primary">
                                                {{ $lecture->video_path ? 'Replace Video' : 'Select Video' }}
                                            </button>
                                            <input type="hidden" name="video_path" id="lecture_video_path" 
                                                   value="{{ $lecture->video_path }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="progress" style="height: 25px; display: none;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" 
                                                role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                            
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div id="lecture-upload-status" class="alert" style="display: none;"></div>
                                    </div>
                                </div>
                                
                                @if($lecture->video_path)
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <div class="alert alert-info">
                                                <strong>Current Video:</strong> 
                                                <video height="300" class="w-100" controls>
                                                    <source src="{{ Storage::disk('s3')->temporaryUrl($lecture->video_path, now()->addSeconds(34)) }}" type="video/mp4">
                                                </video>
                                                <br>
                                                <small>Uploaded: {{ $lecture->created_at->format('M d, Y H:i') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @error('video_path')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-12">
                        <label for="editor" class="form-label">Lecture Content </label>
                        <textarea name="content" id="editor" class="form-control" rows="3">{{ $lecture->content }}</textarea>
                        @error('content')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-12">
                        <label class="form-label">Attachments</label>
                        <input type="file" multiple name="files[]" class="form-control">
                        @error('files')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @if($lecture->files->count())
                            <div class="mt-2">
                                <strong>Current Attachments:</strong>
                                <ul>
                                    @foreach($lecture->files as $file)
                                        <li>
                                            <a href="{{ Storage::url($file->path) }}" target="_blank">
                                                {{ $file->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label for="duration" class="form-label">Duration (minutes)</label>
                        <input type="number" name="duration" class="form-control" 
                               value="{{ $lecture->duration }}" required>
                        @error('duration')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        ClassicEditor.create(document.querySelector('#editor'));

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Resumable.js for lecture videos
            let lectureResumable = new Resumable({
                target: '{{ route('instructor.video-upload.presigned-url') }}',
                query: {
                    _token: '{{ csrf_token() }}'
                },
                testChunks: false,
                chunkSize: 5 * 1024 * 1024, // 5MB chunks
                simultaneousUploads: 3,
                maxChunkRetries: 3,
                chunkRetryInterval: 3000,
                headers: {
                    'Accept': 'application/json',
                    'x-amz-server-side-encryption': 'AES256'
                },
                maxFiles: 1,
                fileType: ['mp4', 'webm', 'mov', 'avi']
            });

            if (!lectureResumable.support) {
                showLectureUploadStatus('error', 'Your browser does not support resumable uploads');
                return;
            }

            lectureResumable.assignBrowse(document.getElementById('browseLectureVideo'));

            lectureResumable.on('fileAdded', function(file) {
                showLectureUploadStatus('info', `Preparing to upload: ${file.fileName}`);
                document.querySelector('.progress').style.display = 'block';
                startLectureUpload(file);
            });

            lectureResumable.on('fileProgress', function(file) {
                const progress = Math.floor(file.progress() * 100);
                updateLectureProgress(progress);
            });

            lectureResumable.on('fileSuccess', function(file, message) {
                showLectureUploadStatus('success', `Upload complete: ${file.fileName}`);
            });

            lectureResumable.on('fileError', function(file, message) {
                showLectureUploadStatus('error', `Upload failed: ${message}`);
            });

            async function startLectureUpload(file) {
                try {
                    const chunkSize = 5 * 1024 * 1024;
                    const fileSize = file.size;
                    const totalChunks = Math.ceil(fileSize / chunkSize);
                    let uploadedChunks = 0;
                    const chunkKeys = [];

                    for (let chunkNumber = 1; chunkNumber <= totalChunks; chunkNumber++) {
                        const start = (chunkNumber - 1) * chunkSize;
                        const end = Math.min(start + chunkSize, fileSize);
                        const chunk = file.file.slice(start, end);

                        const response = await fetch('{{ route('instructor.video-upload.presigned-url') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({
                                filename: file.fileName,
                                contentType: file.file.type,
                                chunkNumber: chunkNumber,
                                totalChunks: totalChunks
                            })
                        });

                        const data = await response.json();
                        
                        if (!response.ok) throw new Error(data.message);

                        const uploadResponse = await fetch(data.presignedUrl, {
                            method: 'PUT',
                            body: chunk,
                            headers: {
                                'Content-Type': file.file.type,
                                'x-amz-server-side-encryption': 'AES256',
                            }
                        });

                        if (!uploadResponse.ok) throw new Error('Chunk upload failed');
                        
                        chunkKeys.push(data.chunkKey);
                        uploadedChunks++;
                        updateLectureProgress(Math.floor((uploadedChunks / totalChunks) * 100));
                    }

                    const completeResponse = await fetch('{{ route('instructor.video-upload.complete') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            filename: file.fileName,
                            chunkKeys: chunkKeys,
                            contentType: file.file.type
                        })
                    });

                    const completeData = await completeResponse.json();
                    
                    if (!completeResponse.ok) throw new Error(completeData.message);

                    document.getElementById('lecture_video_path').value = completeData.videoPath;
                    showLectureUploadStatus('success', 'Video uploaded successfully');
                    document.getElementById('browseLectureVideo').textContent = 'Replace Video';

                } catch (error) {
                    console.error('Upload error:', error);
                    showLectureUploadStatus('error', error.message);
                }
            }

            function updateLectureProgress(progress) {
                document.querySelector('.progress-bar').style.width = progress + '%';
                document.querySelector('.progress-bar').setAttribute('aria-valuenow', progress);
                document.querySelector('.progress-bar').textContent = progress + '%';
            }

            function showLectureUploadStatus(type, message) {
                const statusEl = document.getElementById('lecture-upload-status');
                statusEl.style.display = 'block';
                statusEl.className = `alert alert-${type}`;
                statusEl.textContent = message;
            }
        });
    </script>
@endsection