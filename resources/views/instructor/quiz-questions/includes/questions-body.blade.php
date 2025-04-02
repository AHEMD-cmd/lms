@foreach ($quiz->questions as $index => $question)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $question->question_text }}</td>
        <td>{{ $question->is_multiple ? 'YES' : 'NO' }}</td>
        <td>
            <button type="button" class="btn btn-primary px-2 ms-auto" data-bs-toggle="modal"
                data-bs-target="#{{ $question->id }}_editQuestionModal">
                edit Question
            </button>
            <form action="{{ route('instructor.quizzes.questions.destroy', [$quiz->id, $question->id]) }}" method="POST"
                class="d-inline-block delete-question-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" id="delete" title="delete"><i class="lni lni-trash"></i></button>
            </form>
        </td>
    </tr>
@endforeach