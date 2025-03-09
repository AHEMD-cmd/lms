@extends('layouts.dashboard.instructor.master')

@section('title', 'Edit Lecture')

@section('content')

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Lecture</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('instructor.courses.sections.index', $course->id) }}"
                        class="btn btn-primary px-5">Back </a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Edit Lecture</h5>
                <form id="myForm"
                    action="{{ route('instructor.courses.sections.lectures.update', [$course->id, $section->id, $lecture->id]) }}"
                    method="post" class="row g-3" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Lecture Title</label>
                        <input type="text" name="title" class="form-control" id="input1"
                            value="{{ $lecture->title }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Video Url </label>
                        <input type="text" name="url" class="form-control" id="input1"
                            value="{{ $lecture->url }}">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="input1" class="form-label">Lecture Content </label>
                        <textarea name="content" class="form-control">{{ $lecture->content }}</textarea>
                    </div>

                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Save Changes</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
