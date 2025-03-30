<div class="modal fade" id="{{ $question->id }}_editQuestionModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Quiz Question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editQuestionForm" action="{{ route('instructor.quizzes.questions.update', [$quiz->id, $question->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Question -->
                    <div class="form-group mb-3">
                        <label for="edit-question" class="form-label">Question</label>
                        <textarea name="question" class="form-control" id="edit-question" rows="3" placeholder="Enter the quiz question">{{ old('question', $question->question_text) }}</textarea>
                        @error('question')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Multiple Correct Answers Checkbox -->
                    <div class="form-group mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="is_multiple" id="edit-is-multiple" class="form-check-input" value="1"
                                {{ old('is_multiple', $question->is_multiple) ? 'checked' : '' }}>
                            <label for="edit-is-multiple" class="form-check-label">Allow multiple correct answers</label>
                        </div>
                        @error('is_multiple')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Choices -->
                    <div class="form-group mb-3">
                        <label class="form-label">Answer Options (Check if correct)</label>

                        @foreach($question->options as $index => $option)
                        <div class="input-group mb-2">
                            <div class="input-group-text">
                                <input type="checkbox" name="is_correct[{{ $index }}]" value="1"
                                    {{ old("is_correct.$index", $option->is_correct) ? 'checked' : '' }} 
                                    aria-label="Correct option {{ $index + 1 }}">
                            </div>
                            <input type="text" name="options[{{ $index }}]" class="form-control" 
                                value="{{ old("options.$index", $option->option_text) }}" 
                                placeholder="Enter option {{ $index + 1 }}">
                        </div>
                        @error("options.$index")
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        @endforeach
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update Question</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
