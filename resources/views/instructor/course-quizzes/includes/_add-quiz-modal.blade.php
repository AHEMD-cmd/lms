

<div class="modal fade" id="addQuizModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Quiz</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('instructor.courses.quizzes.store', $course->slug) }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="lecture" class="form-label">Lecture</label>
                        <select name="lecture_id" class="form-control" id="lecture">
                            @foreach ($section->lecturesWithoutQuiz() as $lecture)
                                <option value="{{ $lecture->id }}">{{ $lecture->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="time-limit" class="form-label">Time Limit</label>
                        <input type="number" name="time_limit" class="form-control" id="time-limit" placeholder="Time Limit in minutes">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
