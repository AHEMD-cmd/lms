@extends('layouts.dashboard.instructor.master')

@section('title', 'Course Sections')

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

    <div class="row">
        <div class="col-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset($course->image) }}" class="rounded-circle p-1 border" width="90" height="90"
                            alt="...">
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mt-0">{{ $course->name }}</h5>
                            <p class="mb-0">{{ $course->title }}</p>
                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Add Section</button>
                    </div>
                </div>
            </div>

            {{-- /// Add Section and Lecture  --}}
            @foreach ($sections as $key => $section)
                <div class="container">
                    <div class="main-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body p-4 d-flex justify-content-between">
                                        <h6>{{ $section->title }} </h6>

                                        <div class="d-flex justify-content-between align-items-center">

                                            <form class="delete-form"
                                                action="{{ route('instructor.courses.sections.destroy', [$course->slug, $section->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger px-2 ms-auto"> Delete
                                                    Section</button> &nbsp;
                                                <button type="button" class="btn btn-primary px-2 ms-auto"
                                                    data-bs-toggle="modal" data-bs-target="#editSectionModal"> Edit
                                                    Section</button> &nbsp;

                                            </form>


                                            <a class="btn btn-primary"
                                                onclick="addLectureDiv('{{ $course->slug }}', {{ $section->id }}, 'addLectureContainer{{ $key }}')"
                                                id="addLectureBtn{{ $key }}"> Add Lecture </a>
                                        </div>
                                    </div>
                                    {{-- lectures  --}}
                                    <div class="courseHide" id="lectureContainer{{ $key }}">
                                        <div class="container lectures-container">
                                            @include('instructor.course-sections.includes._lectures')
                                        </div>
                                    </div>

                                    {{-- add new lecture --}}
                                    <div class="container mb-3 " style="display: none;"
                                        id="addLectureContainer{{ $key }}">
                                        <form method="POST" class="lecture-form" enctype="multipart/form-data">
                                            @csrf

                                            <input type="text" name="title" class="form-control title mt-2"
                                                placeholder="Enter Lecture Title ">
                                            <div class="text-danger title_error"></div>


                                            {{-- Replace the existing URL input with this --}}
                                            <div class="form-group col-md-12">
                                                <label for="video" class="form-label">Lecture Video</label>
                                                <div class="card mb-3">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div id="lecture-upload-container" class="text-center">
                                                                    <button type="button" id="browseLectureVideo"
                                                                        class="btn btn-primary">Select Video</button>
                                                                    <input type="hidden" name="video_path"
                                                                        id="lecture_video_path">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row mt-3">
                                                            <div class="col-md-12">
                                                                <div class="progress" style="height: 25px; display: none;">
                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                                        role="progressbar" aria-valuenow="0"
                                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row mt-3">
                                                            <div class="col-md-12">
                                                                <div id="lecture-upload-status" class="alert"
                                                                    style="display: none;"></div>
                                                            </div>
                                                        </div>

                                                        @if (isset($lecture) && $lecture->video_path)
                                                            <div class="row mt-3">
                                                                <div class="col-md-12">
                                                                    <div class="alert alert-info">
                                                                        <strong>Current Video:</strong>
                                                                        {{ basename($lecture->video_path) }}
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

                                            <input type="file" multiple name="files[]"
                                                class="form-control title mt-4 mb-4">
                                            <div class="text-danger files_error"></div>

                                            <textarea name="content" class="form-control mt-4 content" placeholder="Enter lecture content in case there is no video"
                                                rows="10" id="editor"></textarea>
                                            <div class="text-danger content_error"></div>

                                            <input type="number" name="duration" class="form-control url mt-4"
                                                placeholder="Add Duration in minutes">
                                            <div class="text-danger duration_error"></div>


                                            <button class="btn btn-primary mt-3">Save Lecture</button>
                                            <button class="btn btn-secondary mt-3" type="button"
                                                onclick="hideLectureContainer('addLectureContainer{{ $key }}')">Cancel</button>
                                        </form>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>

                </div>

                @include('instructor.course-sections.includes._edit-section-modal')
            @endforeach

            {{ $sections->links() }}



            {{-- /// End Add Section and Lecture  --}}
        </div>
    </div>




    <!-- Modal -->
    @include('instructor.course-sections.includes._create-section-modal')

@endsection

@section('scripts')
    <script>
        // ############## show lecture form ################
        function addLectureDiv(courseSlug, sectionId, containerId) {
            $(`#${containerId}`).show();
            const form = $(`#${containerId} form`);
            const url = `/instructor/courses/${courseSlug}/sections/${sectionId}/lectures`;
            form.attr('action', url);
        }

        // ############## save lecture ################
        $(document).ready(function() {
            $(document).on('submit', '.lecture-form', function(e) {
                e.preventDefault();

                let form = $(this);
                let formData = new FormData(this);
                let url = $(this).attr('action');
                let lecturesContainer = form.closest('.card').find('.lectures-container');

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content') // Ensure CSRF token is sent
                    },
                    beforeSend: function() {
                        $('.text-danger').text(''); // Clear previous errors
                    },
                    success: function(response) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 3000,
                            customClass: {
                                popup: 'black-toast'
                            }
                        });
                        $('.lecture-form')[0].reset(); // Reset the form fields

                        // If you're using CKEditor, reset its content too
                        if (typeof CKEDITOR !== 'undefined') {
                            for (let instance in CKEDITOR.instances) {
                                CKEDITOR.instances[instance].setData('');
                            }
                        }

                        // Update lectures container dynamically
                        if (response.lectures) {
                            lecturesContainer.html(response.lectures);
                        }

                    },
                    error: function(xhr) {
                        if (xhr.status === 422) { // Validation errors
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('.' + key + '_error').text(value[
                                    0]); // Display error messages
                            });
                        } else {
                            alert('Something went wrong. Please try again.');
                        }
                    }
                });
            });
        });


        // ############## hide lecture form ################
        function hideLectureContainer(containerId) {
            $(`#${containerId}`).hide();
        }

        // ############## delete lecture ################
        $(document).ready(function() {
            $(document).on('submit', '.delete-form', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });
        // <!--========== content textarea ===========-->
        ClassicEditor.create(document.querySelector('#editor'));
        // <!--========== End of content textarea  ===========-->

        // ######################## update lecture published status #####################
        $(document).ready(function() {
            $('.published-status').on('change', function() {
                let checkbox = $(this);
                let courseSlug = checkbox.data('course-slug');
                let sectionId = checkbox.data('section-id');
                let lectureId = checkbox.data('lecture-id');

                // Send AJAX request
                $.ajax({
                    url: "{{ route('instructor.courses.sections.lectures.update-published-status', ['course' => ':courseSlug', 'section' => ':sectionId', 'lecture' => ':lectureId']) }}"
                        .replace(':courseSlug', courseSlug).replace(':sectionId', sectionId)
                        .replace(':lectureId', lectureId),
                    type: 'PATCH', // Use PUT for updates
                    data: {
                        _token: '{{ csrf_token() }}' // CSRF token for Laravel
                    },
                    success: function(response) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: response.message || 'Status updated successfully!',
                            showConfirmButton: false,
                            timer: 3000,
                            customClass: {
                                popup: 'black-toast'
                            }
                        });
                    },
                    error: function(xhr) {
                        // Revert checkbox state on error
                        checkbox.prop('checked', !checkbox.is(':checked'));

                        let errorMessage = xhr.responseJSON?.message ||
                            'Failed to update status. Please try again.';
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: errorMessage,
                            showConfirmButton: false,
                            timer: 5000,
                            customClass: {
                                popup: 'black-toast'
                            }
                        });
                    }
                });
            });
        });


        // Add this to your existing scripts
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
