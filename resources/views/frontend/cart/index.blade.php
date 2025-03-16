@extends('layouts.frontend.master')

@section('styles')
    <style>
        @keyframes soft-beat-fade {
            0% {
                transform: scale(1);
                opacity: 1;
                text-shadow: 0 0 2px red;
            }

            50% {
                transform: scale(1.03);
                opacity: 0.7;
                text-shadow: 0 0 6px red;
            }

            100% {
                transform: scale(1);
                opacity: 1;
                text-shadow: 0 0 2px red;
            }
        }

        .soft-glow {
            color: red;
            font-weight: bold;
            animation: soft-beat-fade 1.5s infinite ease-in-out;
        }
    </style>


@endsection

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
    @include('frontend.cart.includes.cart-items')
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
            // ###################### Remove course from the cart ######################
            $(document).on('click', '.delete-item', function(e) {
                e.preventDefault();

                let $this = $(this);
                let cartId = $this.data('cart-id');

                $.ajax({
                    url: "{{ url('carts') }}/" + cartId,
                    method: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log(response, 'asas');
                        if (response.status === 'success') {
                            $this.closest('tr').fadeOut(300, function() {
                                $(this).remove();
                            });

                            // Update cart items in the header
                            $('.header-cart').html(response.headerCartItems);

                            // Update cart items
                            $('.cart-area').html(response.cartItems);

                            // Update cart items number in the header
                            // $('.header-cart-number').html(response.cartItemsNumber);

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

            // ###################### Apply coupon code ######################
            $('#apply-coupon-code-form').on('submit', function(e) {
                e.preventDefault();
                let couponCode = $('#coupon-code').val();

                $.ajax({
                    url: "{{ route('carts.update', 1) }}",
                    method: "PUT",
                    data: {
                        _token: "{{ csrf_token() }}",
                        code: couponCode
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            $('.cart-area').html(response.cartItems);
                            $('.coupon-btn').attr('disabled', true).css('opacity', 0.5);
                            $('.coupon-applied').text('coupon code applied for ' + response
                                .usedTimes + ' courses');
                            $('.header-cart').html(response.headerCartItems);

                            // $('.header-cart').html(response.cartItems);
                            // $('.header-cart-number').html(response.cartItemsNumber);
                            // if (response.cartItemsNumber === 0) {
                            //     $('.product-count').text(response.cartItemsNumber);
                            //     $('.empty-cart').show();
                            //     $('.hide-empty-cart').attr('style', 'display: none !important;');
                            // }
                        }
                    },
                    error: function(xhr) {
                        $('.coupon-error')
                            .text('Failed to apply coupon code.');


                        // alert(xhr.responseJSON.message || 'Failed to apply coupon code.');
                    }
                });
            });
        });
    </script>
@endpush
