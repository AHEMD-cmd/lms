@foreach ($section->lectures as $lecture)
    <div class="lectureDiv mb-3 d-flex align-items-center justify-content-between">
        <div>
            <strong> {{ $loop->iteration }}.
                {{ $lecture->title }}</strong>
        </div>

        <div class="btn-group">
            {{-- acrive and inactive --}}
            <div class="form-check form-switch">
                <input class="form-check-input active-status" type="checkbox"
                    {{ $lecture->is_active ? 'checked' : '' }} data-course-slug="{{ $course->slug }}" data-section-id="{{ $section->id }}" data-lecture-id="{{ $lecture->id }}">
                <label class="form-check-label" for="lecture-status-{{ $lecture->id }}">
                    active
                </label>
            </div>
            {{-- publish or unpublish --}}
            <div class="form-check form-switch ms-2">
                <input class="form-check-input published-status" type="checkbox"
                    {{ $lecture->is_published ? 'checked' : '' }} data-course-slug="{{ $course->slug }}" data-section-id="{{ $section->id }}" data-lecture-id="{{ $lecture->id }}">
                <label class="form-check-label" for="lecture-preview-{{ $lecture->id }}">
                    published
                </label>
            </div>
            {{-- edit --}}
            <a href="{{ route('instructor.courses.sections.lectures.edit', [$course->slug, $section->id, $lecture->id]) }}"
                class="btn btn-sm btn-primary ms-2">Edit</a>

            {{-- delete --}}
            <form class="delete-form ms-2"
                action="{{ route('instructor.courses.sections.lectures.destroy', [$course->slug, $section->id, $lecture->id]) }}"
                method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" id="delete">Delete</button>
            </form>
        </div>
    </div>
@endforeach
