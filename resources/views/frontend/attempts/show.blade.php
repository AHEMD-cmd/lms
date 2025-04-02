@extends('layouts.frontend.master')

@section('title', 'Quiz Attempt')

@section('content')


    <div class="quiz-question">
        @include('frontend.attempts.includes._quiz-answers')
    </div>


@endsection



@push('scripts')
    <script>
        $(document).ready(function() {

            // ################### Next question button click event #######################
            $(document).on('click', '#nextQuestionBtn', function() {
                let attemptId = '{{ $attempt->id }}';
                let questionId = $('#questionId').val();
                let quizId = '{{ $quiz->id }}';

                // Collect selected answers
                $.ajax({
                    url: `/quizzes/${quizId}/attempts/${attemptId}/next-questions/${questionId}`,
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
            });

            // ################### Previous question button click event #######################
            $(document).on('click', '#prevQuestionBtn', function() {
                let attemptId = '{{ $attempt->id }}';
                let questionId = $('#questionId').val();
                let quizId = '{{ $quiz->id }}';

                // Collect selected answers
                $.ajax({
                    url: `/quizzes/${quizId}/attempts/${attemptId}/previous-questions/${questionId}`,
                    type: 'GET',
                    success: function(response) {
                        if (response.question) {
                            $('.quiz-question').html(response.question);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 404) {
                            $('#prevQuestionBtn').addClass('d-none');
                            $('#quizForm').addClass('d-inline').removeClass(
                                'd-none');
                        } else {
                            console.error('Error fetching next question');
                        }
                    }
                });
            });
        });
    </script>
@endpush
