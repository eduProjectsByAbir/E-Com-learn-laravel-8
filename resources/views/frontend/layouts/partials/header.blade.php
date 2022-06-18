<header class="header-style-1">
    <!-- ============================================== TOP MENU ============================================== -->
    <div class="top-bar animate-dropdown">
        <div class="container">
            <div class="header-top-inner">
                <div class="cnt-account">
                    <ul class="list-unstyled">
                        <li><a href="{{ route('user.wishlist') }}"><i class="icon fa fa-heart"></i>Wishlist</a></li>
                        <li><a href="{{ auth()->check() ? route('user.mycart') : route('myCart') }}"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
                        <li><a href="{{ route('checkout') }}"><i class="icon fa fa-check"></i>Checkout</a></li>
                        @auth('web')
                        <li><a href="{{ route('user.dashboard') }}"><i class="icon fa fa-user"></i>My Account</a></li>
                        <li><a href="{{ route('logout') }}" id="logoutButton"><i
                                    class="icon fa fa-power-off"></i>Logout</a></li>
                        <form method="POST" action="{{ route('logout') }}" id="logout">
                            @csrf
                        </form>
                        @else
                        <li><a href="{{ route('login') }}"><i class="icon fa fa-lock"></i>Login</a></li>
                        @endauth
                        @auth('admin')
                        <li><a href="{{ route('admin.dashboard') }}"><i class="icon fa fa-cog"></i>Admin Panel</a></li>
                        @endauth
                    </ul>
                </div>
                <!-- /.cnt-account -->

                {{-- <div class="cnt-block">
                    <ul class="list-unstyled list-inline">
                        <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown"
                                data-toggle="dropdown"><span class="value">USD </span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">USD</a></li>
                                <li><a href="#">INR</a></li>
                                <li><a href="#">GBP</a></li>
                            </ul>
                        </li>
                    </ul>
                    <!-- /.list-unstyled -->
                </div> --}}
                <!-- /.cnt-cart -->
                <div class="clearfix"></div>
            </div>
            <!-- /.header-top-inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.header-top -->
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                    <!-- ============================================================= LOGO ============================================================= -->
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('frontend') }}/images/logo.png" alt="logo">
                        </a>
                    </div>
                    <!-- /.logo -->
                    <!-- ============================================================= LOGO : END ============================================================= -->
                </div>
                <!-- /.logo-holder -->

                <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
                    <!-- /.contact-row -->
                    <!-- ============================================================= SEARCH AREA ============================================================= -->
                    <div class="search-area">
                        <form action="{{ route('showProducts') }}" method="get" id="searchForm">
                            <div class="control-group">
                                <ul class="categories-filter animate-dropdown">
                                    <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown"
                                            href="{{ route('showProducts') }}">Categories <b class="caret"></b></a>
                                        <ul class="dropdown-menu" role="menu">
                                            @foreach ($categories as $category)
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('showProducts', 'category='.$category->id) }}">-
                                                    {{ $category->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                                <input class="search-field" name="keyword" placeholder="Search here..."/>
                                <a class="search-button" href="#" onclick="form.submit();" id="searchButton"></a>
                            </div>
                        </form>
                    </div>
                    <!-- /.search-area -->
                    <!-- ============================================================= SEARCH AREA : END ============================================================= -->
                </div>
                <!-- /.top-search-holder -->

                <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
                    <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
                    <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart"
                            data-toggle="dropdown" onclick="navCartShow()">
                            <div class="items-cart-inner">
                                <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
                                <div class="basket-item-count"><span class="count"
                                        id="headerCartCount">{{ Cart::count() }}</span></div>
                                <div class="total-price-basket"> <span class="lbl">cart -</span> <span
                                        class="total-price"> <span class="sign">$</span><span
                                            class="value" id="headerCartTotalShow">{{ Cart::total() }}</span> </span> </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div id="headerCartList">
                                </div>
                                <!-- /.cart-item -->
                                <div class="clearfix"></div>
                                <hr>
                                <div class="clearfix cart-total">
                                    <div class="pull-right"> <span class="text">Total Tax :</span>$<span class='price'
                                            id="headerCartTotalTax">00</span> </div>
                                    <div class="pull-right"> <span class="text">Sub Total :</span>$<span class='price'
                                            id="headerCartTotal">00</span> </div>
                                    <div class="clearfix"></div>
                                    <a href="{{ route('myCart') }}"
                                        class="btn btn-upper btn-primary btn-block m-t-20" id="navCheckoutButton">Checkout</a>
                                </div>
                                <!-- /.cart-total-->

                            </li>
                        </ul>
                        <!-- /.dropdown-menu-->
                    </div>
                    <!-- /.dropdown-cart -->

                    <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->
                </div>
                <!-- /.top-cart-row -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->

    </div>
    <!-- /.main-header -->

    <!-- ============================================== NAVBAR ============================================== -->
    <x-frontend.header.category-nav :categories=$categories />
    <!-- /.header-nav -->
    <!-- ============================================== NAVBAR : END ============================================== -->
</header>
