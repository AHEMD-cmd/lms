@extends('layouts.dashboard.instructor.master')

@section('title', 'Add Course')
@section('css')
    <style>
        /* Optional: Sezt editor height */
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


    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Course</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Add Course</h5>

            <form id="myForm" action="{{ route('instructor.courses.store') }}" method="post" class="row g-3"
                enctype="multipart/form-data">
                @csrf

                <div class="form-group col-md-6">
                    <label for="name" class="form-label">Course Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="title" class="form-label">Course Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>



                <div class="form-group col-md-6">
                    <label for="image" class="form-label">Course Image <span class="text-danger">*</span></label>
                    <input class="form-control" name="image" type="file" id="image">
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <img id="showImage" src="{{ asset('assets/dashboard/images/preview.png') }}" alt="Course Image"
                        class="rounded-circle p-1 bg-primary" width="100">
                </div>


                <div class="form-group col-md-6">
                    <label for="video" class="form-label"><span class="text-danger">*</span> Course Intro Video </label>
                    <input type="file" name="video" class="form-control">
                    @error('video')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">

                </div>

                <div class="form-group col-md-6">
                    <label for="category_id" class="form-label">Course Category <span class="text-danger">*</span></label>
                    <select name="category_id" id="category_id" class="form-select mb-3"
                        aria-label="Default select example">
                        <option selected="" disabled>Open this select menu</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="has_certificate" class="form-label">HasCertificate <span
                            class="text-danger">*</span></label>
                    <select name="has_certificate" id="has_certificate" class="form-select mb-3"
                        aria-label="Default select example">
                        <option selected disabled>Select one</option>
                        <option value="1" {{ old('has_certificate') == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ old('has_certificate') == 0 ? 'selected' : '' }}>No</option>
                    </select>
                    @error('has_certificate')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="level" class="form-label">Course Level <span class="text-danger">*</span></label>
                    <select name="level" id="level" class="form-select mb-3" aria-label="Default select example">
                        <option selected="" disabled>Select one</option>
                        <option value="Begginer" {{ old('level') == 'Begginer' ? 'selected' : '' }}>Begginer</option>
                        <option value="Middle" {{ old('level') == 'Middle' ? 'selected' : '' }}>Middle</option>
                        <option value="Advance" {{ old('level') == 'Advance' ? 'selected' : '' }}>Advance</option>
                    </select>
                    @error('level')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <div class="form-group col-md-3">
                    <label for="price" class="form-label">Course Price <span class="text-danger">*</span> </label>
                    <input type="number" name="price" class="form-control" id="price"
                        value="{{ old('price') }}">
                    @error('price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <div class="form-group col-md-3">
                    <label for="discount" class="form-label">Discount Price (optional)</label>
                    <input type="number" name="discount" class="form-control" id="discount"
                        value="{{ old('discount') }}">
                    @error('discount')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <div class="form-group col-md-6">
                    <label for="duration" class="form-label">Duration </label>
                    <input type="text" name="duration" class="form-control" id="duration"
                        value="{{ old('duration') }}">
                    @error('duration')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <div class="form-group col-md-6">
                    <label for="resources" class="form-label">Resources </label>
                    <input type="text" name="resources" class="form-control" id="resources"
                        value="{{ old('resources') }}">
                    @error('resources')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-12">
                    <label for="prerequisites" class="form-label">Course Prerequisites </label>
                    <textarea name="prerequisites" class="form-control" id="prerequisites" placeholder="Prerequisites ..."
                        rows="3">{{ old('prerequisites') }}</textarea>
                    @error('prerequisites')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-12">
                    <label for="description" class="form-label">Course Description </label>
                    <textarea name="description" class="form-control" id="editor" placeholder="Course Description ..."
                        value="{{ old('description') }}" rows="3"></textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <p>Course Goals </p>

                <!--   //////////// Goal Option /////////////// -->

                @error('course_goals.*')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="row add_item">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="goals" class="form-label"> Goals </label>
                            <input type="text" name="course_goals[]" id="goals" class="form-control"
                                placeholder="Goals ">
                        </div>
                    </div>

                    <div class="form-group col-md-6" style="padding-top: 30px;">
                        <span type="button" class="btn btn-success add-goal">
                            <i class="fa fa-plus-circle"></i> Add More..
                        </span>
                    </div>
                </div> <!---end row-->

                <!--   //////////// End Goal Option /////////////// -->

                <hr>
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="bestseller" value="1"
                                id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">BestSeller</label>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="featured" value="1"
                                id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">Featured</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="highestrated" value="1"
                                id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">Highest Rated</label>
                        </div>
                    </div>

                </div>


                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <button type="submit" class="btn btn-primary px-4">Save Changes</button>

                    </div>
                </div>
            </form>
        </div>
    </div>





    <!--========== Start of add multiple class with ajax ==============-->
    <div class="row" id="add_extra_item" style="visibility: hidden">
        <div class="row" id="remove_item">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="goals" class="form-label"> Goals </label>
                    <input type="text" name="course_goals[]" id="goals" class="form-control"
                        placeholder="Goals ">
                </div>
            </div>

            <div class="form-group col-md-6" style="padding-top: 30px;">
                <span type="button" class="btn btn-success add-goal">
                    <i class="fa fa-plus-circle"></i> Add More..
                </span>
                <span class="btn btn-danger btn-sm remove-goal">
                    <i class="fa fa-minus-circle">Remove</i>
                </span>
            </div>
        </div>
    </div>
    <!--========== End of add multiple class with ajax ==============-->
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            // <!--========== Image preview ===========-->
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]); // Fixed: '0' to 0
            });
            // <!--========== End of Image preview ===========-->

            // <!--========== For Goals Section  ===========-->

            $(document).on("click", ".add-goal", function() {
                var extra_item = $("#add_extra_item").html();
                $(this).closest(".add_item").append(extra_item);
            });

            $(document).on("click", ".remove-goal", function(event) {
                $(this).closest("#remove_item").remove();

            });
            // <!--========== End of For Goals Section  ===========-->


            // <!--========== For Description Section  ===========-->

            ClassicEditor.create(document.querySelector('#editor'))

            // <!--========== End of For Description Section  ===========-->
        });
    </script>
@endsection
