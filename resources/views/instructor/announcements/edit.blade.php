@extends('layouts.dashboard.instructor.master')

@section('title', 'Edit Announcement')
@section('css')
    <style>
        /* Optional: Sezt editor height */
        .ck-editor__editable {
            min-height: 200px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Announcement</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Add Announcement</h5>

            <form id="courseForm" action="{{ route('instructor.courses.announcements.update', [$course->slug, $announcement->id]) }}" method="post" class="row g-3">
                @csrf
                @method('PUT')

                <div class="form-group col-md-12">
                    <label for="body" class="form-label">Announcement content </label>
                    <textarea name="body" class="form-control" id="editor" placeholder="Announcement Body ..."
                        rows="3">{{ old('body', $announcement->body) }}</textarea>
                    @error('body')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Update Announcement</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
     // <!--========== For Description Section  ===========-->

     ClassicEditor.create(document.querySelector('#editor'))

// <!--========== End of For Description Section  ===========-->
</script>
@endsection

