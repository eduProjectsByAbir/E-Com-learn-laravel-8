@extends('frontend.layouts.app')

@section('title')
{{ $productDetails->name }}
@endsection
@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('home') }}">Home</a></li>
                <a
                        href="{{ route('showProducts', 'category='.$productDetails->category_id) }}"><li>{{ $productDetails->category->name }}
                </li></a>
                <li class='active'>{{ $productDetails->name }}</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row single-product'>
            <div class='col-md-3 sidebar'>
                <div class="sidebar-module-container">
                    <!-- ============================================== HOT DEALS ========================================== -->
                    <x-frontend.sidebar.hotdeals />
                    <!-- ============================================== HOT DEALS: END ============================================== -->
                    <!-- ============================================== NEWSLETTER ============================================== -->
                    <x-frontend.sidebar.newsletter />
                    <!-- ==================================== NEWSLETTER: END =============================== -->
                    <!-- ===================================== Testimonials=============================== -->
                    {{-- <div class="sidebar-widget  wow fadeInUp outer-top-vs ">
                        <div id="advertisement" class="advertisement">
                            <div class="item">
                                <div class="avatar"><img src="assets/images/testimonials/member1.png" alt="Image">
                                </div>
                                <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port
                                    mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                                <div class="clients_author">John Doe <span>Abc Company</span> </div>
                                <!-- /.container-fluid -->
                            </div><!-- /.item -->
                            <div class="item">
                                <div class="avatar"><img src="assets/images/testimonials/member3.png" alt="Image">
                                </div>
                                <div class="testimonials"><em>"</em>Vtae sodales aliq uam morbi non sem lacus port
                                    mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                                <div class="clients_author">Stephen Doe <span>Xperia Designs</span> </div>
                            </div><!-- /.item -->
                            <div class="item">
                                <div class="avatar"><img src="assets/images/testimonials/member2.png" alt="Image">
                                </div>
                                <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port
                                    mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                                <div class="clients_author">Saraha Smith <span>Datsun &amp; Co</span> </div>
                                <!-- /.container-fluid -->
                            </div><!-- /.item -->
                        </div><!-- /.owl-carousel -->
                    </div> --}}
                    <!-- ============================================== Testimonials: END ============================================== -->
                </div>
            </div><!-- /.sidebar -->
            <div class='col-md-9'>
                <div class="detail-block">
                    <div class="row wow fadeInUp">
                        <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                            <div class="product-item-holder size-big single-product-gallery small-gallery">
                                <div id="owl-single-product">
                                    <div class="single-product-gallery-item" id="slide0">
                                        <a data-lightbox="image-1" data-title="Gallery"
                                            href="{{ $productDetails->product_thumbnail_url }}">
                                            <img class="img-responsive" alt=""
                                                src="{{ asset('frontend') }}/images/blank.gif"
                                                data-echo="{{ $productDetails->product_thumbnail_url }}" />
                                        </a>
                                    </div><!-- /.single-product-gallery-item -->
                                    @foreach ($productDetails->product_images as $product_image)
                                    <div class="single-product-gallery-item" id="slide{{ $loop->index+1 }}">
                                        <a data-lightbox="image-1" data-title="Gallery"
                                            href="{{ $product_image->image_url }}">
                                            <img class="img-responsive" alt=""
                                                src="{{ asset('frontend') }}/images/blank.gif"
                                                data-echo="{{ $product_image->image_url }}" />
                                        </a>
                                    </div><!-- /.single-product-gallery-item -->
                                    @endforeach
                                </div><!-- /.single-product-slider -->
                                <div class="single-product-gallery-thumbs gallery-thumbs">
                                    <div id="owl-single-product-thumbnails">
                                        <div class="item">
                                            <a class="horizontal-thumb active" data-target="#owl-single-product"
                                                data-slide="0" href="#slide0">
                                                <img class="img-responsive" width="85" alt=""
                                                    src="{{ asset('frontend') }}/images/blank.gif"
                                                    data-echo="{{ $productDetails->product_thumbnail_url }}" />
                                            </a>
                                        </div>
                                        @foreach ($productDetails->product_images as $product_image)
                                        <div class="item">
                                            <a class="horizontal-thumb" data-target="#owl-single-product"
                                                data-slide="{{ $loop->index+1 }}" href="#slide{{ $loop->index+1 }}">
                                                <img class="img-responsive" width="85" alt=""
                                                    src="{{ asset('frontend') }}/images/blank.gif"
                                                    data-echo="{{ $product_image->image_url }}" />
                                            </a>
                                        </div>
                                        @endforeach
                                    </div><!-- /#owl-single-product-thumbnails -->
                                </div><!-- /.gallery-thumbs -->
                            </div><!-- /.single-product-gallery -->
                        </div><!-- /.gallery-holder -->
                        <form action="{{ route('addToCart') }}" method="post">
                            @csrf
                            <div class='col-sm-6 col-md-7 product-info-block'>
                                <div class="product-info">
                                    <h1 class="name">{{ $productDetails->name }}</h1>
                                    <input type="hidden" name="name" value="{{ $productDetails->name }}">
                                    {{-- <div class="rating-reviews m-t-20">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="rating rateit-small"></div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="reviews">
                                                    <a href="#" class="lnk">(13 Reviews)</a>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.rating-reviews --> --}}
                                    <div class="stock-container info-container m-t-10">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="stock-box">
                                                    <span class="label">Availability :</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="stock-box">
                                                    <span
                                                        class="value">{{ $productDetails->qty !== '0' ? 'In Stock ('.$productDetails->qty.')' : 'Out of Stock' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.stock-container -->
                                    <div class="description-container m-t-20">
                                        {{ $productDetails->short_description }}
                                    </div><!-- /.description-container -->
                                    <div class="price-container info-container m-t-20">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="price-box">
                                                    <span
                                                        class="price">${{ $productDetails->discount_price !== null ? ($productDetails->price - $productDetails->discount_price) : $productDetails->price  ?? $productDetails->price }}</span>
                                                    @if($productDetails->discount_price !== null)
                                                    <span class="price-strike">$
                                                        {{ $productDetails->price }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="favorite-button m-t-10">
                                                    <a class="btn btn-primary wishlist" onclick="event.preventDefault()" data-val="{{ $productDetails->id }}" data-toggle="tooltip"
                                                        data-placement="right" title="Wishlist" href="#">
                                                        <i class="fa fa-heart"></i>
                                                    </a>
                                                    {{-- <a class="btn btn-primary" data-toggle="tooltip"
                                                        data-placement="right" title="Add to Compare" href="#">
                                                        <i class="fa fa-signal"></i>
                                                    </a>
                                                    <a class="btn btn-primary" data-toggle="tooltip"
                                                        data-placement="right" title="E-mail" href="#">
                                                        <i class="fa fa-envelope"></i>
                                                    </a> --}}
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                        <div class="row">
                                            @if(count($productDetails->all_colors) !== 0)
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="info-title control-label">Choose Color</label><br>
                                                    <select name="color" id="color"
                                                        class="from-control unicase-form-control selectpicker">
                                                        <option value="" disabled>Select Color
                                                            {{ count($productDetails->all_colors) }}</option>
                                                        @foreach ($productDetails->all_colors as $color)
                                                        <option value="{{ $color }}">{{ ucfirst($color) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @endif
                                            @if(count($productDetails->all_sizes) !== 0)
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="info-title control-label">Choose Size</label><br>
                                                    <select name="size" id="size"
                                                        class="from-control unicase-form-control selectpicker">
                                                        <option value="" disabled>Select Size</option>
                                                        @foreach ($productDetails->all_sizes as $size)
                                                        <option value="{{ $size }}">{{ strtoupper($size) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div><!-- /.price-container -->
                                    <div class="quantity-container info-container">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <span class="label">Qty :</span>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="cart-quantity">
                                                    <div class="quant-input">
                                                        {{-- <div class="arrows">
                                                        <div class="arrow plus gradient"><span class="ir"><i
                                                                    class="icon fa fa-sort-asc"></i></span></div>
                                                        <div class="arrow minus gradient"><span class="ir"><i
                                                                    class="icon fa fa-sort-desc"></i></span></div>
                                                    </div> --}}
                                                        <input type="number" name="qty"
                                                            value="{{ $productDetails->qty !== '0' ? '1' : '0' }}"
                                                            max="{{ $productDetails->qty }}" min="1"
                                                            {{ $productDetails->qty == '0' ? 'disabled' : '' }}>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="id" value="{{ $productDetails->id }}">
                                            <input type="hidden" name="page" value="details">
                                            <div class="col-sm-7">
                                                <button type="submit" class="btn btn-primary"
                                                    {{ $productDetails->qty == '0' ? 'disabled' : '' }}>
                                                    <i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART
                                                </button>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.quantity-container -->
                                </div><!-- /.product-info -->
                            </div><!-- /.col-sm-7 -->
                        </form>
                    </div><!-- /.row -->
                </div>

                <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                    <div class="row">
                        <div class="col-sm-3">
                            <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                                {{-- <li><a data-toggle="tab" href="#review">REVIEW</a></li>
                                <li><a data-toggle="tab" href="#tags">TAGS</a></li> --}}
                            </ul><!-- /.nav-tabs #product-tabs -->
                        </div>
                        <div class="col-sm-9">

                            <div class="tab-content">

                                <div id="description" class="tab-pane in active">
                                    <div class="product-tab">
                                        <p class="text">{!! nl2br($productDetails->long_description) ??
                                            $productDetails->short_description !!}</p>
                                    </div>
                                </div><!-- /.tab-pane -->
{{-- 
                                <div id="review" class="tab-pane">
                                    <div class="product-tab">

                                        <div class="product-reviews">
                                            <h4 class="title">Customer Reviews</h4>

                                            <div class="reviews">
                                                <div class="review">
                                                    <div class="review-title"><span class="summary">We love this
                                                            product</span><span class="date"><i
                                                                class="fa fa-calendar"></i><span>1 days
                                                                ago</span></span></div>
                                                    <div class="text">"Lorem ipsum dolor sit amet, consectetur
                                                        adipiscing elit.Aliquam suscipit."</div>
                                                </div>

                                            </div><!-- /.reviews -->
                                        </div><!-- /.product-reviews -->



                                        <div class="product-add-review">
                                            <h4 class="title">Write your own review</h4>
                                            <div class="review-table">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th class="cell-label">&nbsp;</th>
                                                                <th>1 star</th>
                                                                <th>2 stars</th>
                                                                <th>3 stars</th>
                                                                <th>4 stars</th>
                                                                <th>5 stars</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="cell-label">Quality</td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                        value="1"></td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                        value="2"></td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                        value="3"></td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                        value="4"></td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                        value="5"></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="cell-label">Price</td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                        value="1"></td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                        value="2"></td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                        value="3"></td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                        value="4"></td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                        value="5"></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="cell-label">Value</td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                        value="1"></td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                        value="2"></td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                        value="3"></td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                        value="4"></td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                        value="5"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table><!-- /.table .table-bordered -->
                                                </div><!-- /.table-responsive -->
                                            </div><!-- /.review-table -->

                                            <div class="review-form">
                                                <div class="form-container">
                                                    <form role="form" class="cnt-form">

                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="exampleInputName">Your Name <span
                                                                            class="astk">*</span></label>
                                                                    <input type="text" class="form-control txt"
                                                                        id="exampleInputName" placeholder="">
                                                                </div><!-- /.form-group -->
                                                                <div class="form-group">
                                                                    <label for="exampleInputSummary">Summary <span
                                                                            class="astk">*</span></label>
                                                                    <input type="text" class="form-control txt"
                                                                        id="exampleInputSummary" placeholder="">
                                                                </div><!-- /.form-group -->
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="exampleInputReview">Review <span
                                                                            class="astk">*</span></label>
                                                                    <textarea class="form-control txt txt-review"
                                                                        id="exampleInputReview" rows="4"
                                                                        placeholder=""></textarea>
                                                                </div><!-- /.form-group -->
                                                            </div>
                                                        </div><!-- /.row -->

                                                        <div class="action text-right">
                                                            <button class="btn btn-primary btn-upper">SUBMIT
                                                                REVIEW</button>
                                                        </div><!-- /.action -->

                                                    </form><!-- /.cnt-form -->
                                                </div><!-- /.form-container -->
                                            </div><!-- /.review-form -->

                                        </div><!-- /.product-add-review -->

                                    </div><!-- /.product-tab -->
                                </div><!-- /.tab-pane -->

                                <div id="tags" class="tab-pane">
                                    <div class="product-tag">

                                        <h4 class="title">Product Tags</h4>
                                        <form role="form" class="form-inline form-cnt">
                                            <div class="form-container">

                                                <div class="form-group">
                                                    <label for="exampleInputTag">Add Your Tags: </label>
                                                    <input type="email" id="exampleInputTag" class="form-control txt">


                                                </div>

                                                <button class="btn btn-upper btn-primary" type="submit">ADD
                                                    TAGS</button>
                                            </div><!-- /.form-container -->
                                        </form><!-- /.form-cnt -->

                                        <form role="form" class="form-inline form-cnt">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <span class="text col-md-offset-3">Use spaces to separate tags. Use
                                                    single quotes (') for phrases.</span>
                                            </div>
                                        </form><!-- /.form-cnt -->

                                    </div><!-- /.product-tab -->
                                </div><!-- /.tab-pane --> --}}

                            </div><!-- /.tab-content -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.product-tabs -->

                <!-- ============================================== UPSELL PRODUCTS ============================================== -->
                <x-frontend.featuredproducts :featuredproducts=$featuredproducts />
                <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->

            </div><!-- /.col -->
            <div class="clearfix"></div>
        </div><!-- /.row -->

        <!-- ==== ================== BRANDS CAROUSEL ============================================== -->
        @include('frontend.layouts.partials.partner-brands')
        <!-- == = BRANDS CAROUSEL : END = -->
    </div><!-- /.container -->
</div><!-- /.body-content -->
@endsection
