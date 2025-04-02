@foreach ($quiz->questions as $question)
    @include('instructor.quiz-questions.modals._edit-question-modal', ['question' => $question])
@endforeach