<div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addQuestionForm"  action="{{ route('instructor.quizzes.questions.store', $quiz->id) }}" method="POST">
                    @csrf

                    <!-- Question -->
                    <div class="form-group mb-3">
                        <label for="question" class="form-label">Question</label>
                        <textarea name="question" class="form-control" id="question" rows="3" placeholder="Enter the quiz question" ></textarea>
                        @error('question')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Multiple Correct Answers Checkbox -->
                    <div class="form-group mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="is_multiple" id="is-multiple" class="form-check-input" value="1">
                            <label for="is-multiple" class="form-check-label">Allow multiple correct answers</label>
                        </div>
                        @error('is_multiple')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Choices -->
                    <div class="form-group mb-3">
                        <label class="form-label">Answer Options (Check if correct)</label>

                        <!-- Option 1 -->
                        <div class="input-group mb-2">
                            <div class="input-group-text">
                                <input type="checkbox" name="is_correct[0]" value="1" aria-label="Correct option 1">
                            </div>
                            <input type="text" name="options[0]" class="form-control" placeholder="Enter option 1" >
                        </div>
                        @error('options.0')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <!-- Option 2 -->
                        <div class="input-group mb-2">
                            <div class="input-group-text">
                                <input type="checkbox" name="is_correct[1]" value="1" aria-label="Correct option 2">
                            </div>
                            <input type="text" name="options[1]" class="form-control" placeholder="Enter option 2" >
                        </div>
                        @error('options.1')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <!-- Option 3 -->
                        <div class="input-group mb-2">
                            <div class="input-group-text">
                                <input type="checkbox" name="is_correct[2]" value="1" aria-label="Correct option 3">
                            </div>
                            <input type="text" name="options[2]" class="form-control" placeholder="Enter option 3" >
                        </div>
                        @error('options.2')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Question</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>