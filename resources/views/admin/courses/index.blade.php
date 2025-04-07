@extends('layouts.dashboard.admin.master')

@section('title', 'Courses')

@section('content')

    <style>
        .large-checkbox {
            transform: scale(1.5);
        }
    </style>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Courses </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">

            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Image </th>
                                <th>Course Name </th>
                                <th>Instrutor </th>
                                <th>Category </th>
                                <th>Price </th>
                                <th>Action</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($courses as $key => $course)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td> <img src="{{ asset($course->image) }}" alt=""
                                            style="width: 70px; height:40px;"> </td>
                                    <td>{{ $course->title }}</td>
                                    <td>{{ $course->instructor->name }}</td>
                                    <td>{{ $course->category->name }}</td>
                                    <td>{{ $course->price }}</td>

                                    <td> <a href="{{ route('admin.courses.show', $course->slug) }}" class="btn btn-info"><i
                                                class="lni lni-eye"></i> </a>
                                        <a href="{{ route('admin.courses.reports.index', $course->slug) }}" class="btn btn-info">Reports </a>
                                    </td>


                                    <td>
                                        <div class="form-check-danger form-check form-switch">
                                            <input class="form-check-input status-toggle large-checkbox" type="checkbox"
                                                id="flexSwitchCheckCheckedDanger" data-course-slug="{{ $course->slug }}"
                                                {{ $course->status ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexSwitchCheckCheckedDanger"> </label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.status-toggle').on('change', function() {
                let checkbox = $(this);
                let courseSlug = checkbox.data('course-slug');
                let status = checkbox.is(':checked') ? 1 : 0; // 1 for checked, 0 for unchecked

                // Send AJAX request
                $.ajax({
                    url: '{{ route('admin.courses.update', ':slug') }}'.replace(':slug',courseSlug),
                    type: 'PUT', // Use PUT for updates
                    data: {
                        status: status,
                        _token: '{{ csrf_token() }}' // CSRF token for Laravel
                    },
                    success: function(response) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: response.message || 'Status updated successfully!',
                            showConfirmButton: false,
                            timer: 3000,
                            customClass: {
                                popup: 'black-toast'
                            }
                        });
                    },
                    error: function(xhr) {
                        // Revert checkbox state on error
                        checkbox.prop('checked', !checkbox.is(':checked'));

                        let errorMessage = xhr.responseJSON?.message ||
                            'Failed to update status. Please try again.';
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: errorMessage,
                            showConfirmButton: false,
                            timer: 5000,
                            customClass: {
                                popup: 'black-toast'
                            }
                        });
                    }
                });
            });

            $(document).on('submit', '.delete-form', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });

        });
    </script>
@endsection
