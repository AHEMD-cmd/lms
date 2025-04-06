@extends('layouts.dashboard.instructor.master')

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
                <form id="myForm" action="{{ route('instructor.coupons.store') }}" method="post" class="row g-3"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-group col-md-6">
                        <label for="coupon_name" class="form-label">Code</label>
                        <input type="text" name="code" class="form-control" id="coupon_name"
                            value="{{ old('code') }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="limit_number" class="form-label">Limit Number</label>
                        <input type="number" name="limit_number" class="form-control" id="limit_number"
                            value="{{ old('limit_number') }}" max="1000" min="1">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="discount_percentage" class="form-label">Discount Percentage</label>
                        <select name="discount_percentage" id="discount_percentage" class="form-control">
                            <option value="">choose discount percentage</option>
                            <option value="100" {{old('discount_percentage') == 100 ? 'selected': ''}}>100 %</option>
                            <option value="90" {{old('discount_percentage') == 90 ? 'selected' : ''}}>90 %</option>
                            <option value="50" {{old('discount_percentage') == 50 ? 'selected' : ''}}>50 %</option>
                        </select>
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
                            <option value="instructor" {{ old('type') == 'instructor' ? 'selected' : '' }}>All Courses
                            </option>
                            <option value="course" {{ old('type') == 'course' ? 'selected' : '' }}>Course</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="form-label" for="course_id">choose one of your courses in case the
                            type of coupon is course</label>
                        <select class="form-control" name="course_id" id="course_id">
                            <option value="">Select Course</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                    {{ $course->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="start_date" class="form-label">Start Date </label>
                        <input class="form-control" name="start_date" type="datetime-local" id="start_date"
                            value="{{ old('start_date') }}"
                            min="{{ Carbon\Carbon::now()->startOfDay()->format('Y-m-d H:i') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="end_date" class="form-label">End Date </label>
                        <input class="form-control" name="end_date" type="datetime-local" id="end_date"
                            value="{{ old('end_date') }}">
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

            // ############################# change limit number based on discount percentage ######################## 
            // Select the dropdown and input elements
            var discountSelect = $('#discount_percentage');
            var limitInput = $('#limit_number');

            // Function to set the max attribute based on selected percentage
            function setMaxLimit() {
                var percentage = discountSelect.val();
                var maxLimit;

                // Determine the max limit based on the selected percentage
                if (percentage == '100') {
                    maxLimit = 1000;
                } else if (percentage == '90') {
                    maxLimit = 2000;
                } else if (percentage == '50') {
                    maxLimit = 3000;
                } else {
                    maxLimit = 1000; // Default when no percentage is selected
                }

                // Update the max attribute of the input
                limitInput.attr('max', maxLimit);
            }

            // Listen for changes in the dropdown
            discountSelect.on('change', setMaxLimit);

            // Set the initial max value on page load
            setMaxLimit();

        });
    </script>
@endsection
