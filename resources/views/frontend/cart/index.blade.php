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
    {{-- remove course from the cart --}}
    <script>
        $(document).ready(function() {
            $(document).on('click', '.icon-element', function(e) {
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
                            $('.header-cart').html(response.cartItems);

                            // Update cart items number in the header
                            // $('.header-cart-number').html(response.cartItemsNumber);

                            if (response.cartItemsNumber === 0) {
                                $('.product-count').text(response.cartItemsNumber);
                                $('.empty-cart').show();
                                $('.hide-empty-cart').attr('style', 'display: none !important;');

                            }

                        }
                    },
                    error: function(xhr) {
                        alert(xhr.responseJSON.message || 'Failed to remove item.');
                    }
                });
            });
        });
    </script>
@endpush
