@extends('frontend.layouts.app')

@section('title')
Checkout
@endsection
@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class='active'>Checkout</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">
                <form class="register-form" action="{{ route('user.checkout') }}" method="POST">
                    @csrf
                    <div class="col-md-8">
                        <div class="panel-group checkout-steps" id="accordion">
                            <!-- checkout-step-01  -->
                            <div class="panel panel-default checkout-step-01">
                                <!-- panel-heading -->
                                <div class="panel-heading">
                                    <h3 class="unicase-checkout-title">
                                        Shipping Address
                                    </h3>
                                </div>
                                <!-- panel-heading -->
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <!-- panel-body  -->
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 already-registered-login">
                                                <div class="form-group">
                                                    <label class="info-title" for="name"><b>Shipping
                                                            Name</b> <span>*</span></label>
                                                    <input type="text" name="shipping_name"
                                                        class="form-control unicase-form-control text-input" id="name"
                                                        placeholder="Full Name" value="{{ Auth::user()->name }}"
                                                        required="">
                                                </div> <!-- // end form group  -->
                                                <div class="form-group">
                                                    <label class="info-title" for="email"><b>Email </b>
                                                        <span>*</span></label>
                                                    <input type="email" name="shipping_email"
                                                        class="form-control unicase-form-control text-input" id="email"
                                                        placeholder="Email" value="{{ Auth::user()->email }}"
                                                        required="">
                                                </div> <!-- // end form group  -->
                                                <div class="form-group">
                                                    <label class="info-title" for="phone"><b>Phone</b>
                                                        <span>*</span></label>
                                                    <input type="number" name="shipping_phone"
                                                        class="form-control unicase-form-control text-input" id="phone"
                                                        placeholder="Phone" value="{{ Auth::user()->phone }}"
                                                        required="">
                                                </div> <!-- // end form group  -->
                                                <div class="form-group">
                                                    <label class="info-title" for="post_code"><b>Post Code </b>
                                                        <span>*</span></label>
                                                    <input type="text" name="post_code"
                                                        class="form-control unicase-form-control text-input"
                                                        id="post_code" placeholder="Post Code" required="">
                                                </div> <!-- // end form group  -->
                                            </div>
                                            <div class="col-md-6 col-sm-6 already-registered-login">
                                                <div class="form-group">
                                                    <h5><b>Country</b> <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="country_id" class="form-control" id="country_id">
                                                            <option value="">Select Country
                                                            </option>
                                                            @foreach($countries as $country)
                                                            <option value="{{ $country->id }}">{{ $country->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        @error('country_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div> <!-- // end form group -->
                                                <div class="form-group">
                                                    <h5><b>Division</b> <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="division_id" class="form-control">
                                                            <option value="">Select Division
                                                            </option>
                                                        </select>
                                                        @error('division_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div> <!-- // end form group -->
                                                <div class="form-group">
                                                    <h5><b>District</b> <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="district_id" class="form-control" required="">
                                                            <option value="" selected="" disabled="">Select District
                                                            </option>
                                                        </select>
                                                        @error('district_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div> <!-- // end form group -->
                                                <div class="form-group">
                                                    <h5><b>City Select</b></h5>
                                                    <div class="controls">
                                                        <select name="city_id" class="form-control" required="">
                                                            <option value="" selected="" disabled="">Select City
                                                            </option>
                                                        </select>
                                                        @error('city_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div> <!-- // end form group -->
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="info-title" for="note">Notes
                                                        <span>*</span></label>
                                                    <textarea class="form-control" cols="30" rows="5"
                                                        placeholder="Notes" name="notes"></textarea>
                                                </div> <!-- // end form group  -->
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h3 style="padding-bottom: 10px;">Payment Methods</h3>
                                            <div class="col-md-3 col-sm-12 form-check">
                                                <input class="form-check-input" type="radio" name="payment_method"
                                                    id="payment_method_1" value="stripe">
                                                <label class="form-check-label" for="payment_method_1">
                                                    Stripe
                                                </label>
                                            </div>
                                            <div class="col-md-3 col-sm-12 form-check">
                                                <input class="form-check-input" type="radio" name="payment_method"
                                                    id="payment_method_4" value="sslcommerz">
                                                <label class="form-check-label" for="payment_method_4">
                                                    SSLCommerz
                                                </label>
                                            </div>
                                            <div class="col-md-3 col-sm-12 form-check">
                                                <input class="form-check-input" type="radio" name="payment_method"
                                                    id="payment_method_2" value="card">
                                                <label class="form-check-label" for="payment_method_2">
                                                    Card
                                                </label>
                                            </div>
                                            <div class="col-md-3 col-sm-12 form-check">
                                                <input class="form-check-input" type="radio" name="payment_method"
                                                    id="payment_method_3" value="cod">
                                                <label class="form-check-label" for="payment_method_3">
                                                    Cash on Delivary
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- panel-body  -->

                                </div><!-- row -->
                            </div>
                            <!-- checkout-step-01  -->

                        </div><!-- /.checkout-steps -->
                    </div>
                    <div class="col-md-4">
                        <!-- checkout-progress-sidebar -->
                        <div class="checkout-progress-sidebar ">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">Your Checkout Progress</h4>
                                    </div>
                                    <div class="">
                                        <ul class="nav nav-checkout-progress list-unstyled">
                                            @foreach ($carts as $cart)
                                            <li>
                                                <div class="cart-item product-summary">
                                                    <div class="row">
                                                        <div class="col-xs-4">
                                                            <div class="image"> <a
                                                                    href="{{ route('showProduct', $cart->options->slug) }}"><img
                                                                        src="{{ $cart->options->image }}" alt=""
                                                                        height="70px" width="70px"></a>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-8">
                                                            <h5 class="name"><a
                                                                    href="{{ route('showProduct', $cart->options->slug) }}">{{ $cart->name }}</a>
                                                            </h5>
                                                            @if($cart->options->color !== null || $cart->options->size
                                                            !==
                                                            null)
                                                            <div class="price">
                                                                @if($cart->options->color !== null)
                                                                <strong>Color:</strong> {{ $cart->options->color }}
                                                                @endif
                                                                @if($cart->options->color !== null &&
                                                                $cart->options->size
                                                                !== null),
                                                                @endif
                                                                @if($cart->options->size !== null)
                                                                <strong>Size:</strong> {{ $cart->options->size }}
                                                                @endif
                                                            </div>
                                                            @endif
                                                            <div class="price">${{ $cart->price }} * {{ $cart->qty }} =
                                                                <b>$
                                                                    {{ $cart->subtotal }}</b></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <hr>
                                            @endforeach
                                        </ul>
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
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="cart-checkout-btn text-center">
                                                            <button type="submit" href="{{ route('checkout') }}"
                                                                class="btn btn-primary checkout-btn">Process Payment</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody><!-- /tbody -->
                                        </table><!-- /table -->
                                    </div><!-- /.cart-shopping-total -->
                                </div>
                            </div>
                        </div>
                        <!-- checkout-progress-sidebar -->
                    </div>
                </form>
            </div><!-- /.row -->
        </div><!-- /.checkout-box -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        @include('frontend.layouts.partials.partner-brands')
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div><!-- /.container -->
</div><!-- /.body-content -->
@endsection

@section('jsscript')
<script type="text/javascript">
    $(document).ready(function () {
        // division
        $('select[name="country_id"]').on('change', function () {
            var country_id = $(this).val();
            if (country_id) {
                $.ajax({
                    url: "{{ route('divisionListJson') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": country_id,
                    },
                    dataType: "json",
                    success: function (data) {
                        var division = $('select[name="division_id"]');
                        division.empty();
                        $('select[name="city_id"]').empty();
                        division.append(
                            '<option value="" selected>Select Division</option>');
                        $.each(data, function (key, value) {
                            division.append(
                                '<option value="' + value.id + '">' + value
                                .name + '</option>');
                        });
                    },
                });
            }
        });
        // district
        $('select[name="division_id"]').on('change', function () {
            var division_id = $(this).val();
            if (division_id) {
                $.ajax({
                    url: "{{ route('districtListJson') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": division_id,
                    },
                    dataType: "json",
                    success: function (data) {
                        var district = $('select[name="district_id"]');
                        district.empty();
                        district.append(
                            '<option value="" selected>Select District</option>');
                        $.each(data, function (key, value) {
                            district.append(
                                '<option value="' + value.id + '">' + value
                                .name + '</option>');
                        });
                    },
                });
            }
        });
        // city
        $('select[name="district_id"]').on('change', function () {
            var district_id = $(this).val();
            if (district_id) {
                $.ajax({
                    url: "{{ route('cityListJson') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": district_id,
                    },
                    dataType: "json",
                    success: function (data) {
                        var city = $('select[name="city_id"]');
                        city.empty();
                        city.append('<option value="" selected>Select City</option>');
                        $.each(data, function (key, value) {
                            city.append(
                                '<option value="' + value.id + '">' + value
                                .name + '</option>');
                        });
                    },
                });
            }
        });
    });

</script>
@endsection
