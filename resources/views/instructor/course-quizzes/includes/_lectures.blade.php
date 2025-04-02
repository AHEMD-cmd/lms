@foreach ($section->lectures as $lecture)
    <div class="lectureDiv mb-3 d-flex align-items-center justify-content-between">
        <div>
            <strong> {{ $loop->iteration }}.
                {{ $lecture->title }}</strong>
        </div>
        @if ($lecture->quiz)
            <div class="btn-group">
                {{-- publish or unpublish --}}
                <div class="form-check form-switch ms-2">
                    <input class="form-check-input published-status" type="checkbox"
                        {{ $lecture->quiz->is_published ? 'checked' : '' }} data-course-slug="{{ $course->slug }}"
                        data-quiz-id="{{ $lecture->quiz->id }}">
                    <label class="form-check-label" for="lecture-preview-{{ $lecture->id }}">
                        published
                    </label>
                </div>

                {{-- <a href="{{ route('instructor.courses.sections.lectures.edit', [$course->slug, $section->id, $lecture->id]) }}"
                    class="btn btn-sm btn-primary ms-2">Edit</a> --}}

                {{-- edit quiz --}}
                <button type="button" class="btn btn-sm btn-primary ms-2" data-bs-toggle="modal"
                    data-bs-target="#editQuizModal{{ $lecture->id }}">
                    Edit Quiz <i class="bx bx-edit"></i>
                </button>

                {{-- delete --}}
                <form class="delete-form ms-2"
                    action="{{ route('instructor.courses.quizzes.destroy', [$course->slug, $lecture->quiz->id]) }}"
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" id="delete">Delete Quiz <i
                            class="bx bx-trash"></i></button>
                </form>

                <a href="{{ route('instructor.quizzes.questions.index', $lecture->quiz->id) }}"
                    class="btn btn-sm btn-primary ms-2">
                    Questions <i class="bx bx-question-mark"></i></a>
                    {{-- Quiz Attempts  --}}
                <a href="{{ route('instructor.quizzes.attempts.index', $lecture->quiz->id) }}"
                    class="btn btn-sm btn-primary ms-2">
                    Attempts <i class="bx bx-task"></i></a>
            </div>
        @endif
    </div>
    @if ($lecture->quiz)
        @include('instructor.course-quizzes.includes._edit-quiz-modal', ['lecture' => $lecture])
    @endif
@endforeach
