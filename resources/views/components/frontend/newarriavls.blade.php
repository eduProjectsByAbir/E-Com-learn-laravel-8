@props([
    'latestproducts' => $latestproducts,
])

<section class="section wow fadeInUp new-arriavls">
    <h3 class="section-title">New Arrivals</h3>
    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
        @foreach ($latestproducts as $product)
        <div class="item item-carousel">
            <div class="products">
                <div class="product">
                    <div class="product-image">
                        <div class="image"> <a href="{{ route('showProduct', $product->slug)  }}"><img
                                    src="{{ $product->product_thumbnail_url }}" alt=""></a> </div>
                        <!-- /.image -->
                        @if($product->discount_price !== null)
                        <div class="tag hot">
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
                        <h3 class="name"><a href="{{ route('showProduct', $product->slug)  }}">{{ $product->name }}</a>
                        </h3>
                        <div class="rating rateit-small"></div>
                        <div class="description"></div>
                        <div class="product-price"> <span class="price">
                                ${{ $product->discount_price !== null ? ($product->price - $product->discount_price) : $product->price  ?? $product->price }}
                            </span>
                            @if($product->discount_price !== null)
                            <span class="price-before-discount">$ {{ $product->price }}</span>
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
                                <li class="lnk wishlist"  data-val="{{ $product->id }}"> <a onclick="event.preventDefault()" data-toggle="tooltip" class="add-to-cart"
                                        href="{{ route('showProduct', $product->slug)  }}" title="Wishlist"> <i
                                            class="icon fa fa-heart"></i>
                                    </a> </li>
                                {{-- <li class="lnk"> <a data-toggle="tooltip" class="add-to-cart"
                                        href="{{ route('showProduct', $product->slug)  }}" title="Compare"> <i class="fa fa-signal"
                                            aria-hidden="true"></i> </a> </li> --}}
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
        <!-- /.item -->
        @endforeach
    </div>
    <!-- /.home-owl-carousel -->
</section>