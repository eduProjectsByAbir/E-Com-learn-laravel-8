<div class="header-nav animate-dropdown">
    <div class="container">
        <div class="yamm navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse"
                    class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                        class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
            <div class="nav-bg-class">
                <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                    <div class="nav-outer">
                        <ul class="nav navbar-nav">
                            <li class="active dropdown yamm-fw"> <a href="{{ route('home') }}" data-hover="dropdown"
                                    class="dropdown-toggle" data-toggle="dropdown">Home</a>
                            </li>
                            @foreach ($categories as $category)
                            <li class="dropdown yamm mega-menu"> <a
                                    href="{{ route('showProducts', 'category='.$category->id) }}" data-hover="dropdown"
                                    class="dropdown-toggle" data-toggle="dropdown">{{ $category->name }}</a>
                                <ul class="dropdown-menu container">
                                    <li>
                                        <div class="yamm-content ">
                                            <div class="row">
                                                @foreach ($category->subcategories as $subcategory)
                                                <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                                                    <a
                                                        href="{{ route('showProducts', 'subcategory='.$subcategory->id) }}">
                                                        <h2 class="title">{{ $subcategory->name }}</h2>
                                                    </a>
                                                    <ul class="links">
                                                        @foreach ($subcategory->subSubcategories as $subSubcategory)
                                                        <li><a
                                                                href="{{ route('showProducts', 'subsubcat='.$subSubcategory->id) }}">{{ $subSubcategory->name }}</a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                @endforeach
                                                <!-- /.col -->
                                                <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image">
                                                    <a href="{{ route('showProducts', 'category='.$category->id) }}">
                                                        <img class="img-responsive" src="{{ $category->image_url }}"
                                                            alt=""></a>
                                                </div>
                                                <!-- /.yamm-content -->
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            @if($loop->index == 5)
                            @break;
                            @endif
                            @endforeach
                            {{-- <li class="dropdown"> <a href="#" class="dropdown-toggle" data-hover="dropdown"
                                    data-toggle="dropdown">Pages</a>
                                <ul class="dropdown-menu pages">
                                    <li>
                                        <div class="yamm-content">
                                            <div class="row">
                                                <div class="col-xs-12 col-menu">
                                                    <ul class="links">
                                                        <li><a href="home.html">Home</a></li>
                                                        <li><a href="category.html">Category</a></li>
                                                        <li><a href="detail.html">Detail</a></li>
                                                        <li><a href="shopping-cart.html">Shopping Cart
                                                                Summary</a></li>
                                                        <li><a href="checkout.html">Checkout</a></li>
                                                        <li><a href="blog.html">Blog</a></li>
                                                        <li><a href="blog-details.html">Blog Detail</a></li>
                                                        <li><a href="contact.html">Contact</a></li>
                                                        <li><a href="sign-in.html">Sign In</a></li>
                                                        <li><a href="my-wishlist.html">Wishlist</a></li>
                                                        <li><a href="terms-conditions.html">Terms and
                                                                Condition</a></li>
                                                        <li><a href="track-orders.html">Track Orders</a></li>
                                                        <li><a href="product-comparison.html">Product-Comparison</a>
                                                        </li>
                                                        <li><a href="faq.html">FAQ</a></li>
                                                        <li><a href="404.html">404</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li> --}}
                            {{-- <li class="dropdown  navbar-right special-menu"> <a href="#">Todays offer</a> </li> --}}
                        </ul>
                        <!-- /.navbar-nav -->
                        <div class="clearfix"></div>
                    </div>
                    <!-- /.nav-outer -->
                </div>
                <!-- /.navbar-collapse -->

            </div>
            <!-- /.nav-bg-class -->
        </div>
        <!-- /.navbar-default -->
    </div>
    <!-- /.container-class -->

</div>
