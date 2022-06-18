@extends('frontend.layouts.app')

@section('title')
All Products
@endsection
@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class='active'>Products</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row'>
            <div class='col-md-3 sidebar'>
                <!-- ================================== TOP NAVIGATION ================================== -->
                <x-frontend.category-side-bar :categories=$categories />
                <!-- /.side-menu -->
                <!-- ================================== TOP NAVIGATION : END ================================== -->
                <div class="sidebar-module-container">
                    <div class="sidebar-filter">
                        <!-- ============================================== SIDEBAR CATEGORY ============================================== -->
                        {{-- <div class="sidebar-widget wow fadeInUp">
                            <h3 class="section-title">shop by</h3>
                            <div class="widget-header">
                                <h4 class="widget-title">Category</h4>
                            </div>
                            <div class="sidebar-widget-body">
                                <div class="accordion">
                                    <div class="accordion-group">
                                        <div class="accordion-heading"> <a href="#collapseOne" data-toggle="collapse"
                                                class="accordion-toggle collapsed"> Camera </a> </div>
                                        <!-- /.accordion-heading -->
                                        <div class="accordion-body collapse" id="collapseOne" style="height: 0px;">
                                            <div class="accordion-inner">
                                                <ul>
                                                    <li><a href="#">gaming</a></li>
                                                    <li><a href="#">office</a></li>
                                                    <li><a href="#">kids</a></li>
                                                    <li><a href="#">for women</a></li>
                                                </ul>
                                            </div>
                                            <!-- /.accordion-inner -->
                                        </div>
                                        <!-- /.accordion-body -->
                                    </div>
                                    <!-- /.accordion-group -->

                                    <div class="accordion-group">
                                        <div class="accordion-heading"> <a href="#collapseTwo" data-toggle="collapse"
                                                class="accordion-toggle collapsed"> Desktops </a> </div>
                                        <!-- /.accordion-heading -->
                                        <div class="accordion-body collapse" id="collapseTwo" style="height: 0px;">
                                            <div class="accordion-inner">
                                                <ul>
                                                    <li><a href="#">gaming</a></li>
                                                    <li><a href="#">office</a></li>
                                                    <li><a href="#">kids</a></li>
                                                    <li><a href="#">for women</a></li>
                                                </ul>
                                            </div>
                                            <!-- /.accordion-inner -->
                                        </div>
                                        <!-- /.accordion-body -->
                                    </div>
                                    <!-- /.accordion-group -->

                                    <div class="accordion-group">
                                        <div class="accordion-heading"> <a href="#collapseThree" data-toggle="collapse"
                                                class="accordion-toggle collapsed"> Pants </a> </div>
                                        <!-- /.accordion-heading -->
                                        <div class="accordion-body collapse" id="collapseThree" style="height: 0px;">
                                            <div class="accordion-inner">
                                                <ul>
                                                    <li><a href="#">gaming</a></li>
                                                    <li><a href="#">office</a></li>
                                                    <li><a href="#">kids</a></li>
                                                    <li><a href="#">for women</a></li>
                                                </ul>
                                            </div>
                                            <!-- /.accordion-inner -->
                                        </div>
                                        <!-- /.accordion-body -->
                                    </div>
                                    <!-- /.accordion-group -->

                                    <div class="accordion-group">
                                        <div class="accordion-heading"> <a href="#collapseFour" data-toggle="collapse"
                                                class="accordion-toggle collapsed"> Bags </a> </div>
                                        <!-- /.accordion-heading -->
                                        <div class="accordion-body collapse" id="collapseFour" style="height: 0px;">
                                            <div class="accordion-inner">
                                                <ul>
                                                    <li><a href="#">gaming</a></li>
                                                    <li><a href="#">office</a></li>
                                                    <li><a href="#">kids</a></li>
                                                    <li><a href="#">for women</a></li>
                                                </ul>
                                            </div>
                                            <!-- /.accordion-inner -->
                                        </div>
                                        <!-- /.accordion-body -->
                                    </div>
                                    <!-- /.accordion-group -->

                                    <div class="accordion-group">
                                        <div class="accordion-heading"> <a href="#collapseFive" data-toggle="collapse"
                                                class="accordion-toggle collapsed"> Hats </a> </div>
                                        <!-- /.accordion-heading -->
                                        <div class="accordion-body collapse" id="collapseFive" style="height: 0px;">
                                            <div class="accordion-inner">
                                                <ul>
                                                    <li><a href="#">gaming</a></li>
                                                    <li><a href="#">office</a></li>
                                                    <li><a href="#">kids</a></li>
                                                    <li><a href="#">for women</a></li>
                                                </ul>
                                            </div>
                                            <!-- /.accordion-inner -->
                                        </div>
                                        <!-- /.accordion-body -->
                                    </div>
                                    <!-- /.accordion-group -->

                                    <div class="accordion-group">
                                        <div class="accordion-heading"> <a href="#collapseSix" data-toggle="collapse"
                                                class="accordion-toggle collapsed"> Accessories </a> </div>
                                        <!-- /.accordion-heading -->
                                        <div class="accordion-body collapse" id="collapseSix" style="height: 0px;">
                                            <div class="accordion-inner">
                                                <ul>
                                                    <li><a href="#">gaming</a></li>
                                                    <li><a href="#">office</a></li>
                                                    <li><a href="#">kids</a></li>
                                                    <li><a href="#">for women</a></li>
                                                </ul>
                                            </div>
                                            <!-- /.accordion-inner -->
                                        </div>
                                        <!-- /.accordion-body -->
                                    </div>
                                    <!-- /.accordion-group -->

                                </div>
                                <!-- /.accordion -->
                            </div>
                            <!-- /.sidebar-widget-body -->
                        </div> --}}
                        <!-- /.sidebar-widget -->
                        <!-- ============================================== SIDEBAR CATEGORY : END ============================================== -->

                        <!-- ============================================== PRICE SILDER============================================== -->
                        {{-- <div class="sidebar-widget wow fadeInUp">
                            <div class="widget-header">
                                <h4 class="widget-title">Price Slider</h4>
                            </div>
                            <div class="sidebar-widget-body m-t-10">
                                <div class="price-range-holder"> <span class="min-max"> <span
                                            class="pull-left">$200.00</span> <span class="pull-right">$800.00</span>
                                    </span>
                                    <input type="text" id="amount"
                                        style="border:0; color:#666666; font-weight:bold;text-align:center;">
                                    <input type="text" class="price-slider" value="">
                                </div>
                                <!-- /.price-range-holder -->
                                <a href="#" class="lnk btn btn-primary">Show Now</a>
                            </div>
                            <!-- /.sidebar-widget-body -->
                        </div> --}}
                        <!-- /.sidebar-widget -->
                        <!-- ============================================== PRICE SILDER : END ============================================== -->
                        <!-- ============================================== Brands ============================================== -->
                        <div class="sidebar-widget wow fadeInUp">
                            <div class="widget-header">
                                <h4 class="widget-title">Brands</h4>
                            </div>
                            <div class="sidebar-widget-body">
                                <ul class="list">
                                    @foreach ($brands as $brand)
                                    <li><a href="{{ route('showProducts', 'brand='.$brand->id) }}">{{ $brand->name }}</a></li>
                                    @endforeach
                                </ul>
                                <!--<a href="#" class="lnk btn btn-primary">Show Now</a>-->
                            </div>
                            <!-- /.sidebar-widget-body -->
                        </div>
                        <!-- /.sidebar-widget -->
                        <!-- ============================================== Brands : END ============================================== -->
                        <!-- ============================================== COLOR============================================== -->
                        @if(count($colors) !== 0)
                        <div class="sidebar-widget wow fadeInUp">
                            <div class="widget-header">
                                <h4 class="widget-title">Colors</h4>
                            </div>
                            <div class="sidebar-widget-body">
                                <ul class="list">
                                    @foreach ($colors as $color)
                                    <li><a href="{{ route('showProducts', 'color='.$color) }}">{{ $color }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- /.sidebar-widget-body -->
                        </div>
                        @endif
                        <!-- /.sidebar-widget -->
                        <!-- ============================================== COLOR: END ============================================== -->
                        <!-- ============================================== COMPARE============================================== -->
                        {{-- <div class="sidebar-widget wow fadeInUp outer-top-vs">
                            <h3 class="section-title">Compare products</h3>
                            <div class="sidebar-widget-body">
                                <div class="compare-report">
                                    <p>You have no <span>item(s)</span> to compare</p>
                                </div>
                                <!-- /.compare-report -->
                            </div>
                            <!-- /.sidebar-widget-body -->
                        </div> --}}
                        <!-- /.sidebar-widget -->
                        <!-- ============================================== COMPARE: END ============================================== -->
                        <!-- ============================================== PRODUCT TAGS ============================================== -->
                        <x-frontend.sidebar.tags :tags=$tags />
                        <!-- /.sidebar-widget -->
                        <!----------- Testimonials------------->
                        {{-- <div class="sidebar-widget  wow fadeInUp outer-top-vs ">
                            <div id="advertisement" class="advertisement">
                                <div class="item">
                                    <div class="avatar"><img src="assets/images/testimonials/member1.png" alt="Image">
                                    </div>
                                    <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port
                                        mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                                    <div class="clients_author">John Doe <span>Abc Company</span> </div>
                                    <!-- /.container-fluid -->
                                </div>
                                <!-- /.item -->

                                <div class="item">
                                    <div class="avatar"><img src="assets/images/testimonials/member3.png" alt="Image">
                                    </div>
                                    <div class="testimonials"><em>"</em>Vtae sodales aliq uam morbi non sem lacus port
                                        mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                                    <div class="clients_author">Stephen Doe <span>Xperia Designs</span> </div>
                                </div>
                                <!-- /.item -->

                                <div class="item">
                                    <div class="avatar"><img src="assets/images/testimonials/member2.png" alt="Image">
                                    </div>
                                    <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port
                                        mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                                    <div class="clients_author">Saraha Smith <span>Datsun &amp; Co</span> </div>
                                    <!-- /.container-fluid -->
                                </div>
                                <!-- /.item -->

                            </div>
                            <!-- /.owl-carousel -->
                        </div> --}}

                        <!-- ============================================== Testimonials: END ============================================== -->

                        {{-- <div class="home-banner"> <img src="assets/images/banners/LHS-banner.jpg" alt="Image"> </div> --}}
                    </div>
                    <!-- /.sidebar-filter -->
                </div>
                <!-- /.sidebar-module-container -->
            </div>
            <!-- /.sidebar -->
            <div class='col-md-9'>
                <!-- ========================================== SECTION – HERO ========================================= -->

                {{-- <div id="category" class="category-carousel hidden-xs">
                    <div class="item">
                        <div class="image"> <img src="{{ asset('frontend/images/banners/cat-banner-1.jpg') }}" alt=""
                class="img-responsive"> </div>
            <div class="container-fluid">
                <div class="caption vertical-top text-left">
                    <div class="big-text"> Big Sale </div>
                    <div class="excerpt hidden-sm hidden-md"> Save up to 49% off </div>
                    <div class="excerpt-normal hidden-sm hidden-md"> Lorem ipsum dolor sit amet, consectetur
                        adipiscing elit </div>
                </div>
                <!-- /.caption -->
            </div>
            <!-- /.container-fluid -->
        </div>
    </div> --}}

    <div class="clearfix filters-container m-t-10">
        <div class="row">
            <div class="col col-sm-6 col-md-2">
                <div class="filter-tabs">
                    <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                        <li class="active"> <a data-toggle="tab" href="#grid-container"><i
                                    class="icon fa fa-th-large"></i>Grid</a> </li>
                        <li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i>List</a></li>
                    </ul>
                </div>
                <!-- /.filter-tabs -->
            </div>
            <!-- /.col -->
            <div class="col col-sm-12 col-md-6">
                {{-- <div class="col col-sm-3 col-md-6 no-padding">
                    <div class="lbl-cnt"> <span class="lbl">Sort by</span>
                        <div class="fld inline">
                            <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                <button data-toggle="dropdown" type="button" class="btn dropdown-toggle">
                                    Position <span class="caret"></span> </button>
                                <ul role="menu" class="dropdown-menu">
                                    <li role="presentation"><a href="#">position</a></li>
                                    <li role="presentation"><a href="#">Price:Lowest first</a></li>
                                    <li role="presentation"><a href="#">Price:HIghest first</a></li>
                                    <li role="presentation"><a href="#">Product Name:A to Z</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.fld -->
                    </div>
                    <!-- /.lbl-cnt -->
                </div>
                <!-- /.col -->
                <div class="col col-sm-3 col-md-6 no-padding">
                    <div class="lbl-cnt"> <span class="lbl">Show</span>
                        <div class="fld inline">
                            <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> 1
                                    <span class="caret"></span> </button>
                                <ul role="menu" class="dropdown-menu">
                                    <li role="presentation"><a href="#">1</a></li>
                                    <li role="presentation"><a href="#">2</a></li>
                                    <li role="presentation"><a href="#">3</a></li>
                                    <li role="presentation"><a href="#">4</a></li>
                                    <li role="presentation"><a href="#">5</a></li>
                                    <li role="presentation"><a href="#">6</a></li>
                                    <li role="presentation"><a href="#">7</a></li>
                                    <li role="presentation"><a href="#">8</a></li>
                                    <li role="presentation"><a href="#">9</a></li>
                                    <li role="presentation"><a href="#">10</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.fld -->
                    </div>
                    <!-- /.lbl-cnt -->
                </div> --}}
                <!-- /.col -->
            </div>
            <!-- /.col -->
            <div class="col col-sm-6 col-md-4 text-right">
                {{ $products->links('vendor.pagination.frontend') }}
                <!-- /.pagination-container -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <div class="search-result-container ">
        <div id="myTabContent" class="tab-content category-list">
            <div class="tab-pane active " id="grid-container">
                <div class="category-product">
                    <div class="row">
                        @forelse ($products as $product)
                        <div class="col-sm-6 col-md-4 wow fadeInUp">
                            <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image"> <a href="{{ route('showProduct', $product->slug) }}"><img
                                                    src="{{ $product->product_thumbnail_url }}" alt=""></a> </div>
                                        <!-- /.image -->
                                        @if($product->discount_price !== null)
                                        <div class="tag sale">
                                            <span>{{ round(($product->discount_price/$product->price)*100) }}%</span>
                                        </div>
                                        @else
                                        @if($product->hot_deals == 1)
                                        <div class="tag hot"><span>hot</span></div>
                                        @elseif($product->featured == 1)
                                        <div class="tag sale"><span>Sale</span></div>
                                        @else
                                        <div class="tag new"><span>new</span></div>
                                        @endif
                                        @endif
                                    </div>
                                    <!-- /.product-image -->

                                    <div class="product-info text-left">
                                        <h3 class="name"><a
                                                href="{{ route('showProduct', $product->slug) }}">{{ $product->name }}</a>
                                        </h3>
                                        {{-- <div class="rating rateit-small"></div> --}}
                                        <div class="description"></div>
                                        <div class="product-price"> <span class="price">
                                                ${{ $product->discount_price !== null ? ($product->price - $product->discount_price) : $product->price  ?? $product->price }}
                                            </span>
                                            @if($product->discount_price !== null)
                                            <span class="price-before-discount">$
                                                {{ $product->price }}</span>
                                            @endif </div>
                                        <!-- /.product-price -->

                                    </div>
                                    <!-- /.product-info -->
                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            <ul class="list-unstyled">
                                                <li class="add-cart-button btn-group">
                                                    <button class="btn btn-primary icon" type="button" title="Add Cart"
                                                        data-toggle="modal" data-target="#addToCart" id="{{ $product->id }}" onclick="productView({{ $product->id }})"> <i
                                                            class="fa fa-shopping-cart"></i> </button>
                                                    <button class="btn btn-primary cart-btn" type="button">Add to
                                                        cart</button>
                                                </li>
                                                <li class="lnk wishlist" data-val="{{ $product->id }}"> <a class="add-to-cart" onclick="event.preventDefault()" href=""
                                                        title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                                {{-- <li class="lnk"> <a class="add-to-cart" href=""
                                                        title="Compare"> <i class="fa fa-signal"></i> </a>
                                                </li> --}}
                                            </ul>
                                        </div>
                                        <!-- /.action -->
                                    </div>
                                    <!-- /.cart -->
                                </div>
                                <!-- /.product -->

                            </div>
                            <!-- /.products -->
                        </div>
                        @empty
                        No Products...
                        @endforelse
                        <!-- /.item -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.category-product -->

            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane " id="list-container">
                <div class="category-product">
                    @forelse ($products as $product)
                    <div class="category-product-inner wow fadeInUp">
                        <div class="products">
                            <div class="product-list product">
                                <div class="row product-list-row">
                                    <div class="col col-sm-4 col-lg-4">
                                        <div class="product-image">
                                            <div class="image"> <img src="{{ $product->product_thumbnail_url }}" alt="">
                                            </div>
                                        </div>
                                        <!-- /.product-image -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col col-sm-8 col-lg-8">
                                        <div class="product-info">
                                            <h3 class="name"><a
                                                    href="{{ route('showProduct', $product->slug) }}">{{ $product->name }}</a>
                                            </h3>
                                            {{-- <div class="rating rateit-small"></div> --}}
                                            <div class="product-price"> <span class="price">
                                                    ${{ $product->discount_price !== null ? ($product->price - $product->discount_price) : $product->price  ?? $product->price }}
                                                </span>
                                                @if($product->discount_price !== null)
                                                <span class="price-before-discount">$
                                                    {{ $product->price }}</span>
                                                @endif </div>
                                            <!-- /.product-price -->
                                            <div class="description m-t-10">{{ $product->short_description }}</div>
                                            <div class="cart clearfix animate-effect">
                                                <div class="action">
                                                    <ul class="list-unstyled">
                                                        <li class="add-cart-button btn-group">
                                                            <button class="btn btn-primary icon" type="button"
                                                                title="Add Cart" data-toggle="modal"
                                                                data-target="#addToCart" id="{{ $product->id }}" onclick="productView({{ $product->id }})"> <i
                                                                    class="fa fa-shopping-cart"></i> </button>
                                                            <button class="btn btn-primary cart-btn" type="button" title="Add Cart" data-toggle="modal"
                                                            data-target="#addToCart" id="{{ $product->id }}" onclick="productView({{ $product->id }})">Add
                                                                to cart</button>
                                                        </li>
                                                        <li class="lnk wishlist" data-val="{{ $product->id }}"> <a class="add-to-cart"
                                                            onclick="event.preventDefault()" href="" title="Wishlist"> <i
                                                                    class="icon fa fa-heart"></i> </a> </li>
                                                        {{-- <li class="lnk"> <a class="add-to-cart" href=""
                                                                title="Compare"> <i class="fa fa-signal"></i> </a> </li> --}}
                                                    </ul>
                                                </div>
                                                <!-- /.action -->
                                            </div>
                                            <!-- /.cart -->
                                        </div>
                                        <!-- /.product-info -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.product-list-row -->
                                @if($product->discount_price !== null)
                                <div class="tag sale">
                                    <span>{{ round(($product->discount_price/$product->price)*100) }}%</span>
                                </div>
                                @else
                                @if($product->hot_deals == 1)
                                <div class="tag hot"><span>hot</span></div>
                                @elseif($product->featured == 1)
                                <div class="tag sale"><span>Sale</span></div>
                                @else
                                <div class="tag new"><span>new</span></div>
                                @endif
                                @endif
                            </div>
                            <!-- /.product-list -->
                        </div>
                        <!-- /.products -->
                    </div>
                    @empty
                    No Products
                    @endforelse
                    <!-- /.category-product-inner -->

                </div>
                <!-- /.category-product -->
            </div>
            <!-- /.tab-pane #list-container -->
        </div>
        <!-- /.tab-content -->
        <div class="clearfix filters-container">
            <div class="text-right">
                {{ $products->links('vendor.pagination.frontend') }}
                <!-- /.pagination-container -->
            </div>
            <!-- /.text-right -->

        </div>
        <!-- /.filters-container -->

    </div>
    <!-- /.search-result-container -->

</div>
<!-- /.col -->
</div>
<!-- /.row -->
<!-- ============================================== BRANDS CAROUSEL ============================================== -->
@include('frontend.layouts.partials.partner-brands')
<!-- /.logo-slider -->
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
</div>
<!-- /.container -->

</div>
@endsection
