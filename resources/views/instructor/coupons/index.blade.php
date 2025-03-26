@extends('layouts.dashboard.instructor.master')

@section('title', 'Coupons')

@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Coupon</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('instructor.coupons.create') }}" class="btn btn-primary px-5">Add Coupon </a>
                </div>
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
                                <th>Code </th>
                                <th>Discount </th>
                                <th>start Date</th>
                                <th>end Date</th>
                                <th>auto apply</th>
                                <th>Status </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($coupons as $key => $coupon)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td> {{ $coupon->code }} </td>
                                    <td>{{ $coupon->discount_percentage }}%</td>
                                    <td> {{ $coupon->start_date->format('d M Y - H:i') }} </td>
                                    <td> {{ $coupon->end_date->format('d M Y - H:i') }} </td>
                                    <td> {{ $coupon->auto_applied ? 'Yes' : 'No' }} </td>

                                    <td>
                                        <div class="form-check-danger form-check form-switch">
                                            <input class="form-check-input status-toggle large-checkbox" type="checkbox"
                                                id="status-{{ $coupon->id }}" data-coupon-id="{{ $coupon->id }}"
                                                {{ $coupon->is_active ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status-{{ $coupon->id }}"></label>
                                        </div>
                                    </td>

                                    <td>
                                        @if ($coupon->created_by == null)
                                            <a href="{{ route('instructor.coupons.edit', $coupon->id) }}"
                                                class="btn btn-info px-2"><i class="bx bx-edit"></i>
                                            </a>
                                            <form action="{{ route('instructor.coupons.destroy', $coupon->id) }}"
                                                method="post" class="delete-form d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger px-2"><i
                                                        class="bx bx-trash"></i></button>
                                            </form>
                                        @endif
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
            // ######################## update coupon status #####################
            $('.status-toggle').on('change', function() {
                let checkbox = $(this);
                let couponId = checkbox.data('coupon-id');
                let status = checkbox.is(':checked') ? 1 : 0; // 1 for checked, 0 for unchecked

                // Send AJAX request
                $.ajax({
                    url: '{{ route('instructor.coupons.update-status', ':id') }}'.replace(':id',
                        couponId),
                    type: 'PATCH', // Use PUT for updates
                    data: {
                        is_active: status,
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
