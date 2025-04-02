@extends('layouts.frontend.master')

@section('title', $course->title)

@section('content')



    <input type="hidden" name="attempt_id" id="attemptId" value="{{ $attempt->id }}">
    <input type="hidden" name="course_id" id="courseId" value="{{ $course->id }}">
    <div class="quiz-question">
        @include('frontend.quizzes.includes._question-answers')
    </div>


@endsection



@push('scripts')
    <script>
        $(document).ready(function() {
            
            /**
             * Validate that at least one answer is selected
             * @param {array} selectedOptions
             * @returns {boolean}
             */
            function validateSelectedAnswers(selectedOptions) {
                if (selectedOptions.length === 0) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'warning',
                        title: 'Please select at least one answer before proceeding.',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#333', // Dark background
                        color: '#fff', // White text
                        iconColor: '#f8d568',
                    });
                    return false;
                }
                return true;
            }
            
            // ################### Next question button click event #######################
            $(document).on('click', '#nextQuestionBtn', function() {
                let attemptId = '{{ $attempt->id }}';
                // let attemptId = $('#attemptId').val();
                let questionId = $('#questionId').val();
                let quizId = '{{ $quiz->id }}';

                // Collect selected answers
                let selectedOptions = [];
                $('input[name="option_ids[]"]:checked').each(function() {
                    selectedOptions.push($(this).val());
                });

                // Validate that at least one answer is selected
                if (!validateSelectedAnswers(selectedOptions)) {
                    return;
                }

                // Send AJAX request to store answers
                $.ajax({
                    url: `/quizzes/${quizId}/answers`,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        attempt_id: attemptId,
                        question_id: questionId,
                        option_ids: selectedOptions
                    },
                    success: function(response) {

                        // Load the next question
                        $.ajax({
                            url: `/quizzes/${quizId}/questions/${questionId}`,
                            type: 'GET',
                            success: function(response) {
                                if (response.question) {
                                    $('.quiz-question').html(response.question);
                                }
                            },
                            error: function(xhr) {
                                if (xhr.status === 404) {
                                    $('#nextQuestionBtn').addClass('d-none');
                                    $('#quizForm').addClass('d-inline').removeClass(
                                        'd-none');
                                } else {
                                    console.error('Error fetching next question');
                                }
                            }
                        });
                    },
                    error: function(xhr) {
                        console.error('Error storing answer:', xhr.responseJSON.message);
                    }
                });
            });

            // ################### Submit quiz button click event #######################
            $(document).on('click', '#submitQuizBtn', function(e) {
                e.preventDefault();

                let attemptId = '{{ $attempt->id }}';
                let quizId = '{{ $quiz->id }}';
                let courseSlug = '{{ $course->slug }}';

                $.ajax({
                    url: `/courses/${courseSlug}/quizzes/${quizId}/attempts/${attemptId}`,
                    type: 'PUT',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        attempt_id: attemptId
                    },
                    success: function(response) {
                        window.location.href = response.redirect;
                    },
                    error: function(xhr, status, error) {
                        if (xhr.responseJSON) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Error: ' + error + ' - Status: ' + xhr.status,
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
