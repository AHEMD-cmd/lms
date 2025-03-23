@extends('layouts.frontend.master')


@section('title', 'Wishlist')

@section('content')


    <!-- ================================
                                                                                                                            START BREADCRUMB AREA
                                                                                                                        ================================= -->
    @include('frontend.cart.includes.breadcrumb')
    <!-- end breadcrumb-area -->
    <!-- ================================
                                                                                                                            END BREADCRUMB AREA
                                                                                                                        ================================= -->

    <!-- ================================
                                                                                                                               START CONTACT AREA
                                                                                                                        ================================= -->
    @include('frontend.cart.includes.cart-area')
    <!-- ================================
                                                                                                                               END CONTACT AREA
                                                                                                                        ================================= -->

    <!--======================================
                                                                                                                                START COURSE AREA
                                                                                                                        ======================================-->
    @include('frontend.cart.includes.courses')
    <!-- end courses-area -->
    <!--======================================
                                                                                                                                END COURSE AREA
                                                                                                                        ======================================-->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Setup CSRF for all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Remove course from cart
            $(document).on('click', '.delete-item', function(e) {
                e.preventDefault();

                let $this = $(this);
                let cartId = $this.data('cart-id');

                $.ajax({
                    url: "{{ url('carts') }}/" + cartId,
                    method: "DELETE",
                    success: function(response) {
                        if (response.status === 'success') {
                            $this.closest('tr').fadeOut(300, function() {
                                $(this).remove();
                            });

                            // Update cart items in the header
                            $('.header-cart').html(response.headerCartItems);

                            // Update cart items
                            $('.cart-area').html(response.cartItems);

                            if (response.cartItemsNumber === 0) {
                                $('.product-count').text(response.cartItemsNumber);
                                $('.hide-empty-cart').attr('style',
                                'display: none !important;');
                            }
                        }
                    },
                    error: function(xhr) {
                        alert(xhr.responseJSON.message || 'Failed to remove item.');
                    }
                });
            });

            // Apply coupon code (using event delegation since cart area might be reloaded)
            $(document).on('submit', '#apply-coupon-code-form', function(e) {
                e.preventDefault();
                let couponCode = $('#coupon-code').val();

                $.ajax({
                    url: "{{ route('carts.update', 1) }}",
                    method: "PUT",
                    data: {
                        code: couponCode
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            $('.cart-area').html(response.cartItems);
                            $('.coupon-btn').attr('disabled', true).css('opacity', 0.5);
                            $('.coupon-applied').text('coupon code applied for ' + response
                                .usedTimes + ' courses');
                            $('.header-cart').html(response.headerCartItems);
                        }
                    },
                    error: function(xhr) {
                        $('.coupon-error').text('Failed to apply coupon code: ' + (xhr
                            .responseJSON?.message || 'Unknown error'));
                    }
                });
            });
        });
    </script>
@endpush
