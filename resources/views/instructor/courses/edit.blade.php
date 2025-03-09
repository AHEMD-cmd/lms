@extends('layouts.dashboard.instructor.master')

@section('title', 'Edit Course')

@section('css')
    <style>
        /* Optional: Set editor height */
        .ck-editor__editable {
            min-height: 200px;
        }
    </style>
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

    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('instructor.courses.index') }}">Courses</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Course</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Edit Course: {{ $course->title }}</h5>

            <form id="myForm" action="{{ route('instructor.courses.update', $course->id) }}" method="post" class="row g-3"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group col-md-6">
                    <label for="name" class="form-label">Course Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                        value="{{ old('name', $course->name) }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="title" class="form-label">Course Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
                        value="{{ old('title', $course->title) }}">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="image" class="form-label">Course Image <span class="text-danger">*</span></label>
                    <input class="form-control @error('image') is-invalid @enderror" name="image" type="file" id="image">
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <img id="showImage"
                        src="{{ $course->image ? asset($course->image) : asset('assets/dashboard/images/preview.png') }}"
                        alt="Course Image" class="rounded-circle p-1 bg-primary" width="100">
                </div>

                <div class="form-group col-md-6">
                    <label for="video" class="form-label"><span class="text-danger">*</span> Course Intro Video</label>
                    <input type="file" name="video" class="form-control @error('video') is-invalid @enderror">
                    @error('video')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    @if ($course->video)
                        <video width="200" controls>
                            <source src="{{ asset($course->video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    <label for="category_id" class="form-label">Course Category <span class="text-danger">*</span></label>
                    <select name="category_id" id="category_id"
                        class="form-select mb-3 @error('category_id') is-invalid @enderror" aria-label="Default select example">
                        <option value="" disabled>Select a category</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ old('category_id', $course->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="has_certificate" class="form-label">Has Certificate <span class="text-danger">*</span></label>
                    <select name="has_certificate" id="has_certificate"
                        class="form-select mb-3 @error('has_certificate') is-invalid @enderror" aria-label="Default select example">
                        <option value="" disabled>Select one</option>
                        <option value="1" {{ old('has_certificate', $course->has_certificate) == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ old('has_certificate', $course->has_certificate) == 0 ? 'selected' : '' }}>No</option>
                    </select>
                    @error('has_certificate')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="level" class="form-label">Course Level <span class="text-danger">*</span></label>
                    <select name="level" id="level" class="form-select mb-3 @error('level') is-invalid @enderror"
                        aria-label="Default select example">
                        <option value="" disabled>Select one</option>
                        <option value="Beginner" {{ old('level', $course->level) == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                        <option value="Middle" {{ old('level', $course->level) == 'Middle' ? 'selected' : '' }}>Middle</option>
                        <option value="Advance" {{ old('level', $course->level) == 'Advance' ? 'selected' : '' }}>Advance</option>
                    </select>
                    @error('level')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-3">
                    <label for="price" class="form-label">Course Price <span class="text-danger">*</span></label>
                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="price"
                        value="{{ old('price', $course->price) }}">
                    @error('price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-3">
                    <label for="discount" class="form-label">Discount Price (optional)</label>
                    <input type="number" name="discount" class="form-control @error('discount') is-invalid @enderror" id="discount"
                        value="{{ old('discount', $course->discount) }}">
                    @error('discount')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="duration" class="form-label">Duration</label>
                    <input type="text" name="duration" class="form-control @error('duration') is-invalid @enderror" id="duration"
                        value="{{ old('duration', $course->duration) }}">
                    @error('duration')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="resources" class="form-label">Resources</label>
                    <input type="text" name="resources" class="form-control @error('resources') is-invalid @enderror" id="resources"
                        value="{{ old('resources', $course->resources) }}">
                    @error('resources')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-12">
                    <label for="prerequisites" class="form-label">Course Prerequisites</label>
                    <textarea name="prerequisites" class="form-control @error('prerequisites') is-invalid @enderror" id="prerequisites"
                        placeholder="Prerequisites ..." rows="3">{{ old('prerequisites', $course->prerequisites) }}</textarea>
                    @error('prerequisites')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-12">
                    <label for="description" class="form-label">Course Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="editor"
                        placeholder="Course Description ..." rows="3">{!! old('description', $course->description) !!}</textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <p>Course Goals</p>

                @error('course_goals.*')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="row add_item">
                    @foreach ($course->courseGoals as $index => $goal)
                        <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                            <div class="container mt-2">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="goals_{{ $index }}" class="form-label">Goals</label>
                                        <input type="text" name="course_goals[]" id="goals_{{ $index }}"
                                            class="form-control" placeholder="Goals" value="{{ old('course_goals.' . $index, $goal->goal) }}">
                                    </div>
                                    <div class="form-group col-md-6" style="padding-top: 20px">
                                        <span class="btn btn-success btn-sm add-goal"><i class="fa fa-plus-circle">Add</i></span>
                                        @if ($index > 0) <!-- Allow removal of additional goals -->
                                            <span class="btn btn-danger btn-sm remove-goal"><i class="fa fa-minus-circle">Remove</i></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div> <!-- End row -->

                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="bestseller" value="1"
                                id="bestseller" {{ old('bestseller', $course->bestseller) ? 'checked' : '' }}>
                            <label class="form-check-label" for="bestseller">BestSeller</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="featured" value="1"
                                id="featured" {{ old('featured', $course->featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="featured">Featured</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="highestrated" value="1"
                                id="highestrated" {{ old('highestrated', $course->highestrated) ? 'checked' : '' }}>
                            <label class="form-check-label" for="highestrated">Highest Rated</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <button type="submit" class="btn btn-primary px-4">Update Course</button>
                        <a href="{{ route('instructor.courses.index') }}" class="btn btn-secondary px-4">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Hidden template for adding new goals -->
    
        <div class="whole_extra_item_add" id="whole_extra_item_add" style="visibility: hidden">
            <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                <div class="container mt-2">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="goals">Goals</label>
                            <input type="text" name="course_goals[]" id="goals" class="form-control"
                                placeholder="Goals">
                        </div>
                        <div class="form-group col-md-6" style="padding-top: 20px">
                            <span class="btn btn-success btn-sm add-goal"><i class="fa fa-plus-circle">Add</i></span>
                            <span class="btn btn-danger btn-sm remove-goal"><i class="fa fa-minus-circle">Remove</i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            // Image preview
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });

            // Dynamic goals section
            var counter = {{ $course->courseGoals->count() }};
            $(document).on("click", ".add-goal", function() {
                var whole_extra_item_add = $("#whole_extra_item_add").html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click", ".remove-goal", function(event) {
                $(this).closest("#whole_extra_item_delete").remove();
                counter -= 1;
            });

            // CKEditor for description
            ClassicEditor
                .create(document.querySelector('#editor'))
                .then(editor => {
                    console.log('Editor initialized:', editor);
                })
                .catch(error => {
                    console.error('Error initializing editor:', error);
                });
        });
    </script>
@endsection