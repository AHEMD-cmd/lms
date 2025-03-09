<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Section </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('instructor.courses.sections.store', $course->id) }}" method="POST">
                    @csrf

                    <input type="hidden" name="id" value="{{ $course->id }}">

                    <div class="form-group mb-3">
                        <label for="input1" class="form-label">Course Section</label>
                        <input type="text" name="title" class="form-control" id="input1">
                    </div>


            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>