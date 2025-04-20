@extends('layouts.frontend.master')

@section('title', 'Checkout')

@section('styles')
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: white;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>
@endsection

@section('content')
    <!-- Breadcrumb Area -->
    @include('frontend.checkout.includes.breadcrumb')

    <!-- Cart Area -->
    <section class="cart-area section--padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-22 pb-3">Select Payment Method</h3>
                            <div class="divider"><span></span></div>
                            <form id="payment-form" action="{{ route('direct.paymentMethod.post') }}" method="POST">
                                @csrf
                                <input type="hidden" name="payment_method_id" id="payment_method_id">
                                <div class="payment-option-wrap">
                                    <!-- PayPal -->
                                    <div class="payment-tab is-active">
                                        <div class="payment-tab-toggle">
                                            <input checked id="paypal" name="payment_method" type="radio"
                                                value="paypal">
                                            <label for="paypal">PayPal</label>
                                            <img class="payment-logo" src="{{ asset('assets/frontend/img/paypal.png') }}" alt="PayPal" width="20">
                                        </div>
                                        <div class="payment-tab-content">
                                            <p class="fs-15 lh-24">In order to complete your transaction, we will transfer
                                                you over to PayPal's secure servers.</p>
                                        </div>
                                    </div>
                                    <!-- Credit/Debit Card -->
                                    <div class="payment-tab">
                                        <div class="payment-tab-toggle">
                                            <input type="radio" name="payment_method" id="creditCard" value="creditCard">
                                            <label for="creditCard">Credit / Debit Card</label>
                                            <img class="payment-logo" src="{{ asset('assets/frontend/img/atm-card.png') }}" width="20"
                                                alt="Cards">
                                        </div>
                                        <div class="payment-tab-content">
                                            <div id="card-element" class="form-control form--control pl-3"></div>
                                            <div id="card-errors" class="text-danger fs-14 mt-2"></div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" id="payment-button" class="btn theme-btn w-100 mt-3">Proceed <i
                                        class="la la-arrow-right icon ml-1"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Order Details -->
                <div class="col-lg-5">
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-22 pb-3">Order Details</h3>
                            <div class="divider"><span></span></div>
                            <div class="order-details-lists">
                                <div class="media media-card border-bottom border-bottom-gray pb-3 mb-3">
                                    <a href="course-details.html" class="media-img">
                                        <img src="{{ asset('images/small-img.jpg') }}" alt="Cart image">
                                    </a>
                                    <div class="media-body">
                                        <h5 class="fs-15 pb-2"><a href="course-details.html">The Complete JavaScript Course
                                                2021: From Zero to Expert!</a></h5>
                                        <p class="text-black font-weight-semi-bold lh-18">$12.99 <span
                                                class="before-price fs-14">$129.99</span></p>
                                    </div>
                                </div>
                                <!-- Repeat for other items -->
                            </div>
                            <a href="course-grid.html" class="btn-text"><i class="la la-edit mr-1"></i>Edit</a>
                        </div>
                    </div>
                    <!-- Order Summary -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-22 pb-3">Order Summary</h3>
                            <div class="divider"><span></span></div>
                            <ul class="generic-list-item generic-list-item-flash fs-15">
                                <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                    <span class="text-black">Original price:</span>
                                    <span>$199.99</span>
                                </li>
                                <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                    <span class="text-black">Coupon discounts:</span>
                                    <span>-$181.99</span>
                                </li>
                                <li class="d-flex align-items-center justify-content-between font-weight-bold">
                                    <span class="text-black">Total:</span>
                                    <span>$18.99</span>
                                </li>
                            </ul>
                            <div class="btn-box border-top border-top-gray pt-3">
                                <p class="fs-14 lh-22 mb-2">Aduca is required by law to collect applicable transaction taxes
                                    for purchases made in certain tax jurisdictions.</p>
                                <p class="fs-14 lh-22 mb-3">By completing your purchase you agree to these <a href="#"
                                        class="text-color hover-underline">Terms of Service.</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize Stripe
            const stripe = Stripe('{{ env('STRIPE_KEY') }}');
            const elements = stripe.elements();
            const cardElement = elements.create('card', {
                style: {
                    base: {
                        fontSize: '16px',
                        color: '#32325d',
                    },
                },
                hidePostalCode: true
            });

            // Mount Stripe card element when credit card is selected
            let cardMounted = false;
            $('input[name="payment_method"]').on('change', function() {
                if ($(this).val() === 'creditCard') {
                    if (!cardMounted) {
                        cardElement.mount('#card-element');
                        cardMounted = true;
                    }
                    $('#card-element').show();
                } else {
                    $('#card-element').hide();
                }
            });

            // Initially hide card element unless credit card is selected
            if (!$('#creditCard').is(':checked')) {
                $('#card-element').hide();
            } else {
                cardElement.mount('#card-element');
                cardMounted = true;
            }

            // Handle payment submission
            $('#payment-button').on('click', function() {
                const paymentMethod = $('input[name="payment_method"]:checked').val();
                $('#card-errors').text(''); // Clear previous errors

                if (paymentMethod === 'creditCard') {
                    stripe.createPaymentMethod({
                        type: 'card',
                        card: cardElement,
                    }).then(function(result) {
                        if (result.error) {
                            $('#card-errors').text(result.error.message);
                        } else {
                            $('#payment_method_id').val(result.paymentMethod.id);
                            $('#payment-form').submit();
                        }
                    });
                } else if (paymentMethod === 'paypal') {
                    // Redirect to PayPal (implement server-side redirect logic)
                    $('#payment_method_id').val('paypal');
                    $('#payment-form').submit();
                }
            });

            // Payment tab toggle for UI
            $('.payment-tab-toggle input').on('change', function() {
                $('.payment-tab').removeClass('is-active');
                $(this).closest('.payment-tab').addClass('is-active');
            });
        });
    </script>
@endpush
