@extends('layouts.dashboard.admin.master')

@section('title', 'Add Coupon')

@section('content')

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Coupon </li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        


        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Add Coupon</h5>
                <form id="myForm" action="{{ route('admin.coupons.store') }}" method="post" class="row g-3"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-group col-md-6">
                        <label for="coupon_name" class="form-label">Code</label>
                        <input type="text" name="code" class="form-control" id="coupon_name" value="{{ old('code') }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="limit_number" class="form-label">Limit Number</label>
                        <input type="number" name="limit_number" class="form-control" id="limit_number" value="{{ old('limit_number') }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="discount_percentage" class="form-label">Discount Percentage</label>
                        <input class="form-control" name="discount_percentage" type="number" id="discount_percentage" value="{{ old('discount_percentage') }}"
                            placeholder="Enter Discount Percentage">
                    </div>

                    <div class="form-group col-md-6">
                        <label class="form-label" for="auto_applied">Auto Applied </label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="auto_applied" value="1"
                                id="auto_applied" {{ old('auto_applied') ? 'checked' : '' }}>
                            <label class="form-check-label" for="auto_applied">Yes</label>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="form-label" for="type">Type (default is platform)</label>
                        <select class="form-control" name="type" id="type">
                            <option value="platform" {{ old('type') == 'platform' ? 'selected' : '' }}>Platform</option>
                            <option value="instructor" {{ old('type') == 'instructor' ? 'selected' : '' }}>Instructor</option>
                            <option value="course" {{ old('type') == 'course' ? 'selected' : '' }}>Course</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="form-label" for="instructor_id">Instructor (optional)</label>
                        <select class="form-control" name="instructor_id" id="instructor_id">
                            <option value="">Select Instructor</option>
                            @foreach ($instructors as $instructor)
                                <option {{ old('instructor_id') == $instructor->id ? 'selected' : '' }} value="{{ $instructor->id }}" data-instructor-slug="{{ $instructor->slug }}">{{ $instructor->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="form-label" for="course_id">Course (Optional) (choose instructor first)</label>
                        <select class="form-control" name="course_id" id="course_id">
                            <option value="" {{ old('course_id') == '' ? 'selected' : '' }}>Select Course</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="start_date" class="form-label">Start Date </label>
                        <input class="form-control" name="start_date" type="datetime-local" id="start_date" value="{{ old('start_date') }}"
                            min="{{ Carbon\Carbon::now()->startOfDay()->format('Y-m-d H:i') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="end_date" class="form-label">End Date </label>
                        <input class="form-control" name="end_date" type="datetime-local" id="end_date" value="{{ old('end_date') }}">
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

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#instructor_id').change(function() {
                let instructorSlug = $(this).find('option:selected').data('instructor-slug');
                let courseDropdown = $('#course_id');

                courseDropdown.empty().append('<option value="">Loading...</option>');

                if (instructorSlug) {
                    $.ajax({
                        url: `/admin/instructors/${instructorSlug}/courses`,
                        type: 'GET',
                        success: function(response) {
                            console.log(response);
                            courseDropdown.empty().append(
                                '<option value="">Select Course</option>');

                            if (response.courses.length > 0) {
                                response.courses.forEach(course => {
                                    courseDropdown.append(
                                        `<option value="${course.id}">${course.name}</option>`
                                    );
                                });
                            } else {
                                courseDropdown.append(
                                    '<option value="">No courses available</option>');
                            }
                        },
                        error: function() {
                            alert('Error loading courses');
                            courseDropdown.empty().append(
                                '<option value="">Error loading courses</option>');
                        }
                    });
                } else {
                    courseDropdown.empty().append('<option value="">Select Course</option>');
                }
            });
        });
    </script>
@endsection
