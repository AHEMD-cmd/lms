<div class="modal fade" id="editQuizModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Quiz</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('instructor.courses.quizzes.update', [$course->slug, $lecture->quiz->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="lecture" class="form-label">Lecture</label>
                        <select name="lecture_id" class="form-control" id="lecture">
                            @foreach ($section->lectures as $sectionLecture)
                                <option value="{{ $sectionLecture->id }}" {{$sectionLecture->id == $lecture->quiz->lecture_id}}>{{ $sectionLecture->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="time-limit" class="form-label">Time Limit</label>
                        <input type="number" value="{{old('time_limit', $lecture->quiz->time_limit)}}" name="time_limit" class="form-control" id="time-limit" placeholder="Time Limit in minutes" required>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
