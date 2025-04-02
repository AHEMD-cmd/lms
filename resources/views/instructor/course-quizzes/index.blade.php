@extends('layouts.dashboard.instructor.master')

@section('title', 'Courses')

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
                        {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Add Section</button> --}}
                    </div>
                </div>
            </div>

            {{-- /// Add Section and Lecture  --}}
            @foreach ($sections as $key => $section)
                @if ($section->lectures->count() > 0)
                    <div class="container">
                        <div class="main-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body p-4 d-flex justify-content-between">
                                            <h6>{{ $section->title }} </h6>

                                            <div class="d-flex justify-content-between align-items-center">
                                                @if ($section->lecturesWithoutQuiz()->count() > 0)
                                                    <button type="button" class="btn btn-primary px-2 ms-auto"
                                                        data-bs-toggle="modal" data-bs-target="#addQuizModal{{ $section->id }}">
                                                        Add Quiz</button>
                                                @else
                                                    <span class="text-success">No Lecture Without Quiz</span>
                                                @endif
                                            </div>
                                        </div>
                                        {{-- lectures  --}}
                                        <div class="courseHide" id="lectureContainer{{ $key }}">
                                            <div class="container lectures-container">
                                                @include('instructor.course-quizzes.includes._lectures')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @include('instructor.course-quizzes.includes._add-quiz-modal')
            @endforeach

            {{$sections->links()}}

            {{-- /// End Add Section and Lecture  --}}
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        // ############## delete quiz ################
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


        //    once you chage here delete sweet alert does not work
        // ######################## update lecture active status #####################
        $(document).ready(function() {
            $('.published-status').on('change', function() {
                let checkbox = $(this);
                let courseSlug = checkbox.data('course-slug');
                let quizId = checkbox.data('quiz-id');

                // Send AJAX request
                $.ajax({
                    url: "{{ route('instructor.courses.quizzes.update-published-status', ['course' => ':courseSlug', 'quiz' => ':quizId']) }}"
                        .replace(':courseSlug', courseSlug).replace(':quizId', quizId),
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
