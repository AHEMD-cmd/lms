@extends('layouts.dashboard.admin.master')

@section('title', 'Instructors')

@section('content')
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Instructors</li>
                </ol>
            </nav>
        </div>
        {{-- Uncomment if you add a create route later
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.instructors.create') }}" class="btn btn-primary px-5">Add Instructor</a>
            </div>
        </div>
        --}}
    </div>
    <!-- End Breadcrumb -->

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($instructors as $index => $instructor)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><img src="{{ asset($instructor->image) }}" alt=""
                                        style="width: 70px; height:40px;"></td>
                                <td>{{ $instructor->name }}</td>
                                <td>{{ $instructor->email }}</td>
                                <td>{{ $instructor->address }}</td>
                                <td>{{ $instructor->phone }}</td>
                                <td>
                                    <div class="form-check-danger form-check form-switch">
                                        <input class="form-check-input status-toggle large-checkbox" type="checkbox"
                                            id="status-{{ $instructor->id }}" data-instructor-id="{{ $instructor->id }}"
                                            {{ $instructor->status ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status-{{ $instructor->id }}"></label>
                                    </div>
                                </td>
                                <td>
                                    <form action="{{ route('admin.instructors.destroy', $instructor->id) }}" method="POST"
                                        class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                class="bx bx-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js">
        < /> <
        script src = "https://cdn.jsdelivr.net/npm/sweetalert2@11" >
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.status-toggle').on('change', function() {
                let checkbox = $(this);
                let instructorId = checkbox.data('instructor-id');
                let status = checkbox.is(':checked') ? 1 : 0; // 1 for checked, 0 for unchecked

                // Send AJAX request
                $.ajax({
                    url: '{{ route('admin.instructors.update', ':id') }}'.replace(':id',
                        instructorId),
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
