@extends('layouts.dashboard.instructor.master')

@section('title', 'Add Course')
@section('css')
    <style>
        /* Optional: Sezt editor height */
        .ck-editor__editable {
            min-height: 200px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Course</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Add Course</h5>

            <form id="courseForm" action="{{ route('instructor.courses.store') }}" method="post" class="row g-3"
                enctype="multipart/form-data">
                @csrf

                <div class="form-group col-md-6">
                    <label for="title" class="form-label">Course Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="category_id" class="form-label">Course Category <span class="text-danger">*</span></label>
                    <select name="category_id" id="category_id" class="form-select mb-3"
                        aria-label="Default select example">
                        <option selected="" disabled>Open this select menu</option>
                        @foreach ($categories->where('depth', '<=', 2) as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ str_repeat('—', $cat->depth) }}{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="image" class="form-label">Course Image <span class="text-danger">*</span></label>
                    <input class="form-control" name="image" type="file" id="image">
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <img id="showImage" src="{{ asset('assets/dashboard/images/preview.png') }}" alt="Course Image"
                        class="rounded-circle p-1 bg-primary" width="100">
                </div>


                {{-- <div class="form-group col-md-6">
                    <label for="video" class="form-label"><span class="text-danger">*</span> Course Intro Video URL </label>
                    <input type="url" name="video" class="form-control" value="{{ old('video') }}">
                    @error('video')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> --}}
                <!-- Replace the existing video URL field with this uploader -->
                <div class="form-group col-md-12">
                    <label for="video" class="form-label"><span class="text-danger">*</span> Course Intro Video</label>
                    
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="upload-container" class="text-center">
                                            <button type="button" id="browseFile" class="btn btn-primary">Select Video</button>
                                            <input type="hidden" name="video_path" id="video_path">
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
                                        <div id="upload-status" class="alert" style="display: none;"></div>
                                    </div>
                                </div>
                                
                                <!-- Show existing video if available (for edit form) -->
                                @if(isset($course) && ($course->video_path || $course->video))
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <div class="alert alert-info">
                                                <strong>Current Video:</strong> 
                                                @if($course->video_path)
                                                    <span>{{ basename($course->video_path) }}</span>
                                                @else
                                                    <a href="{{ $course->video }}" target="_blank">{{ $course->video }}</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Alternative URL input for users who prefer providing a URL -->
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="useUrlInstead">
                                            <label class="form-check-label" for="useUrlInstead">
                                                Use external video URL instead
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-3" id="urlInputContainer" style="display: none;">
                                    <div class="col-md-12">
                                        <input type="url" name="video" class="form-control" id="videoUrl" 
                                            placeholder="Enter video URL (YouTube, Vimeo, etc.)" value="{{ old('video', $course->video ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        @error('video')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @error('video_path')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
          

                <div class="form-group col-md-6">

                </div>

               

                <div class="form-group col-md-6">
                    <label for="has_certificate" class="form-label">HasCertificate <span
                            class="text-danger">*</span></label>
                    <select name="has_certificate" id="has_certificate" class="form-select mb-3"
                        aria-label="Default select example">
                        <option selected disabled>Select one</option>
                        <option value="1" {{ old('has_certificate') == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ old('has_certificate') == 0 ? 'selected' : '' }}>No</option>
                    </select>
                    @error('has_certificate')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="level" class="form-label">Course Level <span class="text-danger">*</span></label>
                    <select name="level" id="level" class="form-select mb-3" aria-label="Default select example">
                        <option selected="" disabled>Select one</option>
                        <option value="Begginer" {{ old('level') == 'Begginer' ? 'selected' : '' }}>Begginer</option>
                        <option value="Middle" {{ old('level') == 'Middle' ? 'selected' : '' }}>Middle</option>
                        <option value="Advance" {{ old('level') == 'Advance' ? 'selected' : '' }}>Advance</option>
                    </select>
                    @error('level')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="language" class="form-label">Course Language <span class="text-danger">*</span></label>
                    <select name="language" id="language" class="form-select mb-3" aria-label="Default select example">
                        <option selected="" disabled>Select language</option>
                        @foreach($languages as $name)
                            <option value="{{ $name }}" {{ old('language') == $name ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                    @error('language')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                


                <div class="form-group col-md-3">
                    <label for="price" class="form-label">Course Price <span class="text-danger">*</span> </label>
                    <input type="number" name="price" class="form-control" id="price"
                        value="{{ old('price') }}">
                    @error('price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <div class="form-group col-md-3">
                    <label for="discount" class="form-label">Discount Price (optional)</label>
                    <input type="number" name="discount" class="form-control" id="discount"
                        value="{{ old('discount') }}">
                    @error('discount')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>



                <div class="form-group col-md-6">
                    <label for="resources" class="form-label">Resources </label>
                    <input type="text" name="resources" class="form-control" id="resources"
                        value="{{ old('resources') }}">
                    @error('resources')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-12">
                    <label for="prerequisites" class="form-label">Course Prerequisites </label>
                    <textarea name="prerequisites" class="form-control" id="prerequisites" placeholder="Prerequisites ..."
                        rows="3">{{ old('prerequisites') }}</textarea>
                    @error('prerequisites')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-12">
                    <label for="short_description" class="form-label">Course Short Description </label>
                    <textarea name="short_description" class="form-control" id="short_description" placeholder="short_description ..."
                        rows="3">{{ old('short_description') }}</textarea>
                    @error('short_description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-12">
                    <label for="description" class="form-label">Course Description </label>
                    <textarea name="description" class="form-control" id="editor" placeholder="Course Description ..."
                        value="{{ old('description') }}" rows="3"></textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <p>Course Goals </p>

                <!--   //////////// Goal Option /////////////// -->

                @error('course_goals.*')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="row add_item">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="goals" class="form-label"> Goals </label>
                            <input type="text" name="course_goals[]" id="goals" class="form-control"
                                placeholder="Goals ">
                        </div>
                    </div>

                    <div class="form-group col-md-6" style="padding-top: 30px;">
                        <span type="button" class="btn btn-success add-goal">
                            <i class="fa fa-plus-circle"></i> Add More..
                        </span>
                    </div>
                </div> <!---end row-->

                <!--   //////////// End Goal Option /////////////// -->

                <hr>
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="bestseller" value="1"
                                id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">BestSeller</label>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="featured" value="1"
                                id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">Featured</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="highestrated" value="1"
                                id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">Highest Rated</label>
                        </div>
                    </div>

                </div>


                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <button type="submit" class="btn btn-primary px-4">Save Changes</button>

                    </div>
                </div>
            </form>
        </div>
    </div>





    <!--========== Start of add multiple class with ajax ==============-->
    <div class="row" id="add_extra_item" style="visibility: hidden">
        <div class="row" id="remove_item">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="goals" class="form-label"> Goals </label>
                    <input type="text" name="course_goals[]" id="goals" class="form-control"
                        placeholder="Goals ">
                </div>
            </div>

            <div class="form-group col-md-6" style="padding-top: 30px;">
                <span type="button" class="btn btn-success add-goal">
                    <i class="fa fa-plus-circle"></i> Add More..
                </span>
                <span class="btn btn-danger btn-sm remove-goal">
                    <i class="fa fa-minus-circle">Remove</i>
                </span>
            </div>
        </div>
    </div>
    <!--========== End of add multiple class with ajax ==============-->
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            // <!--========== Image preview ===========-->
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]); // Fixed: '0' to 0
            });
            // <!--========== End of Image preview ===========-->

            // <!--========== For Goals Section  ===========-->

            $(document).on("click", ".add-goal", function() {
                var extra_item = $("#add_extra_item").html();
                $(this).closest(".add_item").append(extra_item);
            });

            $(document).on("click", ".remove-goal", function(event) {
                $(this).closest("#remove_item").remove();

            });
            // <!--========== End of For Goals Section  ===========-->

            // <!--========== For Description Section  ===========-->

            ClassicEditor.create(document.querySelector('#editor'))

            // <!--========== End of For Description Section  ===========-->
        });


         // Add this to your scripts section in create.blade.php and edit.blade.php
document.addEventListener('DOMContentLoaded', function() {
    // Show/hide URL input based on checkbox
    const useUrlCheckbox = document.getElementById('useUrlInstead');
    const urlInputContainer = document.getElementById('urlInputContainer');
    const uploadContainer = document.getElementById('upload-container');
    const progressBar = document.querySelector('.progress');
    
    useUrlCheckbox.addEventListener('change', function() {
        if (this.checked) {
            urlInputContainer.style.display = 'block';
            uploadContainer.style.display = 'none';
            progressBar.style.display = 'none';
        } else {
            urlInputContainer.style.display = 'none';
            uploadContainer.style.display = 'block';
        }
    });
    
    // Initialize resumable.js
    let resumable = new Resumable({
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
        fileType: ['mp4', 'webm', 'mov', 'avi'], // Add any other formats you want to support
        fileTypeErrorCallback: function(file, errorCount) {
            showUploadStatus('error', `Invalid file type. Please upload video files only.`);
        },
        maxFileSizeErrorCallback: function(file, errorCount) {
            showUploadStatus('error', `File is too large. Maximum allowed size is ${(resumable.opts.maxFileSize/1024/1024).toFixed(2)}MB.`);
        }
    });
    
    // Resumable.js isn't supported, fall back to a standard file input
    if (!resumable.support) {
        showUploadStatus('error', 'Your browser does not support resumable uploads. Please use a modern browser.');
        return;
    }
    
    // Assign browse button
    resumable.assignBrowse(document.getElementById('browseFile'));
    
    // Handle when files are added
    resumable.on('fileAdded', function(file) {
        showUploadStatus('info', `Preparing to upload: ${file.fileName}`);
        document.querySelector('.progress').style.display = 'block';
        
        // Custom implementation for S3 presigned URLs
        // We'll get a presigned URL for each chunk
        startUpload(file);
    });
    
    // Show progress
    resumable.on('fileProgress', function(file) {
        const progress = Math.floor(file.progress() * 100);
        document.querySelector('.progress-bar').style.width = progress + '%';
        document.querySelector('.progress-bar').setAttribute('aria-valuenow', progress);
        document.querySelector('.progress-bar').textContent = progress + '%';
    });
    
    // Handle successful upload
    resumable.on('fileSuccess', function(file, message) {
        showUploadStatus('success', `Upload complete: ${file.fileName}`);
    });
    
    // Handle upload error
    resumable.on('fileError', function(file, message) {
        showUploadStatus('error', `Upload failed: ${message}`);
    });
    
    // Custom implementation for S3 direct upload with presigned URLs
    async function startUpload(file) {
        try {
            // Split file into chunks
            const chunkSize = 5 * 1024 * 1024; // 5MB
            const fileSize = file.size;
            const totalChunks = Math.ceil(fileSize / chunkSize);
            let uploadedChunks = 0;
            const chunkKeys = [];
            
            // Process each chunk
            for (let chunkNumber = 1; chunkNumber <= totalChunks; chunkNumber++) {
                const start = (chunkNumber - 1) * chunkSize;
                const end = Math.min(start + chunkSize, fileSize);
                const chunk = file.file.slice(start, end);
                
                // Get presigned URL for this chunk
                const response = await fetch('{{ route('instructor.video-upload.presigned-url') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        filename: file.fileName,
                        contentType: file.file.type,
                        chunkNumber: chunkNumber,
                        totalChunks: totalChunks
                    })
                });
                
                const data = await response.json();
                
                if (!response.ok) {
                    throw new Error(data.message || 'Failed to get presigned URL');
                }
                
                // Upload chunk directly to S3
                const uploadResponse = await fetch(data.presignedUrl, {
                    method: 'PUT',
                    body: chunk,
                    headers: {
                        'Content-Type': file.file.type,
                        'x-amz-server-side-encryption': 'AES256',
                    }
                });
                
                if (!uploadResponse.ok) {
                    throw new Error('Failed to upload chunk to S3');
                }
                
                // Track uploaded chunk
                chunkKeys.push(data.chunkKey);
                uploadedChunks++;
                
                // Update progress
                const progress = Math.floor((uploadedChunks / totalChunks) * 100);
                document.querySelector('.progress-bar').style.width = progress + '%';
                document.querySelector('.progress-bar').setAttribute('aria-valuenow', progress);
                document.querySelector('.progress-bar').textContent = progress + '%';
            }
            
            // All chunks uploaded, now complete the upload
            const completeResponse = await fetch('{{ route('instructor.video-upload.complete') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    filename: file.fileName,
                    chunkKeys: chunkKeys,
                    contentType: file.file.type
                })
            });
            
            const completeData = await completeResponse.json();
            
            if (!completeResponse.ok) {
                throw new Error(completeData.message || 'Failed to complete upload');
            }
            
            // Set the video path in the hidden input
            document.getElementById('video_path').value = completeData.videoPath;
            showUploadStatus('success', `Upload complete! Video has been saved.`);
            
        } catch (error) {
            console.error('Upload error:', error);
            showUploadStatus('error', `Upload failed: ${error.message}`);
        }
    }
    
    function showUploadStatus(type, message) {
        const statusEl = document.getElementById('upload-status');
        statusEl.style.display = 'block';
        statusEl.className = 'alert';
        
        switch (type) {
            case 'info':
                statusEl.classList.add('alert-info');
                break;
            case 'success':
                statusEl.classList.add('alert-success');
                break;
            case 'error':
                statusEl.classList.add('alert-danger');
                break;
            default:
                statusEl.classList.add('alert-secondary');
        }
        
        statusEl.textContent = message;
    }
});
    </script>

@endsection
