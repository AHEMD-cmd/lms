@extends('layouts.dashboard.instructor.master')

@section('title', 'Courses')

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
            @foreach ($course->sections as $key => $section)
                <div class="container">
                    <div class="main-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body p-4 d-flex justify-content-between">
                                        <h6>{{ $section->title }} </h6>

                                        <div class="d-flex justify-content-between align-items-center">

                                            <form class="delete-form"
                                                action="{{ route('instructor.courses.sections.destroy', [$course->id, $section->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger px-2 ms-auto"> Delete Section</button> &nbsp;
                                                <button type="button" class="btn btn-primary px-2 ms-auto" data-bs-toggle="modal"
                                                    data-bs-target="#editSectionModal"> Edit Section</button> &nbsp;

                                            </form>


                                            <a class="btn btn-primary"
                                                onclick="addLectureDiv({{ $course->id }}, {{ $section->id }}, 'addLectureContainer{{ $key }}')"
                                                id="addLectureBtn{{ $key }}"> Add Lecture </a>

                                        </div>

                                    </div>


                                    {{-- lectures  --}}
                                    <div class="courseHide" id="lectureContainer{{ $key }}">
                                        <div class="container">
                                            @foreach ($section->lectures as $lecture)
                                                <div
                                                    class="lectureDiv mb-3 d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <strong> {{ $loop->iteration }}.
                                                            {{ $lecture->title }}</strong>
                                                    </div>

                                                    <div class="btn-group">
                                                        <a href="{{ route('instructor.courses.sections.lectures.edit', [$course->id, $section->id, $lecture->id]) }}"
                                                            class="btn btn-sm btn-primary">Edit</a> &nbsp;
                                                        <form class="delete-form"
                                                            action="{{ route('instructor.courses.sections.lectures.destroy', [$course->id, $section->id, $lecture->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                id="delete">Delete</button>
                                                        </form>

                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>

                                    {{-- add new lecture --}}
                                    <div class="container mb-3 " style="display: none;"
                                        id="addLectureContainer{{ $key }}">
                                        <form method="POST" class="lecture-form">
                                            @csrf
                                            {{-- <h6>Lecture Title </h6> --}}
                                            <input type="text" name="title" class="form-control title mt-2"
                                                placeholder="Enter Lecture Title">
                                            <div class="text-danger title_error"></div>

                                            <textarea name="content" class="form-control mt-2 content" placeholder="Enter Lecture Content"></textarea>
                                            <div class="text-danger content_error"></div>

                                            {{-- <h6 class="mt-3">Add Video Url</h6> --}}
                                            <input type="text" name="url" class="form-control url mt-2"
                                                placeholder="Add URL">
                                            <div class="text-danger url_error"></div>

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

            {{-- /// End Add Section and Lecture  --}}
        </div>
    </div>




    <!-- Modal -->
    @include('instructor.course-sections.includes._create-section-modal')

@endsection

@section('scripts')
    <script>
        // ############## show lecture form ################
        function addLectureDiv(courseId, sectionId, containerId) {
            $(`#${containerId}`).show();
            const form = $(`#${containerId} form`);
            const url = `/instructor/courses/${courseId}/sections/${sectionId}/lectures`;
            form.attr('action', url);
        }

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
    </script>
@endsection
