@extends('frontend.layouts.app')

@section('title')
SSLCommerz Payment
@endsection
@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class='active'>SSLCommerz Payment</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">
                <div class="col-md-4">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Your Checkout Progress</h4>
                                </div>
                                <div class="cart-shopping-total">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <div class="cart-sub-total">
                                                        Total Tax<span class="inner-left-md"
                                                            id="cartTax">${{ $cartsTax }}</span>
                                                    </div>
                                                    <hr>
                                                    <div class="cart-sub-total">
                                                        Subtotal<span class="inner-left-md"
                                                            id="cartSubTotal">${{ $cartsSubTotal }}</span>
                                                    </div>
                                                    <hr>
                                                    <div class="cart-sub-total">
                                                        Discount<span class="inner-left-md"
                                                            id="cartDiscount">${{ Session::has('coupon') ? session()->get('coupon')['discount_amount'].' (Coupon: '.session()->get('coupon')['coupon_code'].' - '.session()->get('coupon')['coupon_discount'].'%)' : $cartsDiscount }}</span>
                                                    </div>
                                                    <hr>
                                                    <div class="cart-grand-total">
                                                        Grand Total<span class="inner-left-md"
                                                            id="cartTotal">${{ Session::has('coupon') ? session()->get('coupon')['total_amount'] : $cartsTotal }}</span>
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead><!-- /thead -->
                                    </table><!-- /table -->
                                </div><!-- /.cart-shopping-total -->
                            </div>
                        </div>
                    </div>
                    <!-- checkout-progress-sidebar -->
                </div>
                <div class="col-md-8">
                    <div class="panel-group checkout-steps" id="accordion">
                        <!-- checkout-step-01  -->
                        <div class="panel panel-default checkout-step-01">
                            <!-- panel-heading -->
                            <div class="panel-heading">
                                <h3 class="unicase-checkout-title">
                                    Payment
                                </h3>
                            </div>
                            <!-- panel-heading -->
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <!-- panel-body  -->
                                <div class="panel-body">
                                    <form action="{{ route('user.checkout.stripe') }}" method="post" id="payment-form">
                                        @csrf
                                        <div class="form-row">
                                            <label for="card-element">
                                                Credit or debit card
                                            </label>

                                            <div id="card-element">
                                                <!-- A Stripe Element will be inserted here. -->
                                            </div>
                                            <!-- Used to display form errors. -->
                                            <div id="card-errors" role="alert"></div>
                                        </div>
                                        <br>
                                    <button class="btn btn-primary btn-lg btn-block" id="sslczPayBtn"
                                            token="if you have any token validation"
                                            postdata="your javascript arrays or objects which requires in backend"
                                            order="If you already have the transaction generated for current order"
                                            endpoint="{{ url('/user/checkout-sslcommerz') }}"> Pay Now
                                    </button>
                                        <input type="hidden" name="name" value="{{ $shipping_name }}">
                                        <input type="hidden" name="email" value="{{ $shipping_email }}">
                                        <input type="hidden" name="phone" value="{{ $shipping_phone }}">
                                        <input type="hidden" name="post_code" value="{{ $post_code }}">
                                        <input type="hidden" name="country_id" value="{{ $country_id }}">
                                        <input type="hidden" name="division_id" value="{{ $division_id }}">
                                        <input type="hidden" name="district_id" value="{{ $district_id }}">
                                        <input type="hidden" name="city_id" value="{{ $city_id }}">
                                        <input type="hidden" name="notes" value="{{ $notes }}">
                                        <input type="hidden" name="payment_method" value="{{ $payment_method }}">
                                    </form>
                                </div>
                                <!-- panel-body  -->

                            </div><!-- row -->
                        </div>
                        <!-- checkout-step-01  -->

                    </div><!-- /.checkout-steps -->
                </div>
            </div><!-- /.row -->
        </div><!-- /.checkout-box -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        @include('frontend.layouts.partials.partner-brands')
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div><!-- /.container -->
</div><!-- /.body-content -->
@endsection

@section('styles')
<style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
</style>
@endsection

@section('scripts')

@endsection

@section('jsscript')
<!-- If you want to use the popup integration, -->
<script>
    var obj = {};
    obj.name = $('input[name=name]').val();
    obj.email = $('input[name=email]').val();
    obj.phone = $('input[name=phone]').val();
    obj.post_code = $('input[name=post_code]').val();
    obj.country_id = $('input[name=country_id]').val();
    obj.division_id = $('input[name=division_id]').val();
    obj.city_id = $('input[name=city_id]').val();
    obj.notes = $('input[name=notes]').val();
    obj.payment_method = $('input[name=payment_method]').val();
    obj.district_id = $('input[name=district_id]').val();

    $('#sslczPayBtn').prop('postdata', obj);

    (function (window, document) {
        var loader = function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
            script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
            tag.parentNode.insertBefore(script, tag);
        };

        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
</script>
@endsection
