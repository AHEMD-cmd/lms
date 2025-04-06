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


                                            <input type="url" name="url" class="form-control url mt-4"
                                                placeholder="Add URL">
                                            <div class="text-danger url_error"></div>

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

            {{$sections->links()}}



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
    </script>
@endsection
