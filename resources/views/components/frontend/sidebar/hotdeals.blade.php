@props([
    'hotproducts' => $hotproducts,
])

@if(count($hotproducts) !== 0)
<div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
    <h3 class="section-title">hot deals</h3>
    <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
        @foreach ($hotproducts as $hotproduct)
        <div class="item">
            <div class="products">
                <div class="hot-deal-wrapper">
                    <div class="image"> <img src="{{ $hotproduct->product_thumbnail_url }}"
                            alt=""> </div>
                            @if($hotproduct->discount_price !== null)
                            <div class="sale-offer-tag">
                                <span>{{ round(($hotproduct->discount_price/$hotproduct->price)*100) }}% <br> OFF</span>
                            </div>
                            @elseif($hotproduct->featured == 1)
                            <div class="sale-offer-tag"><span>feat<br>ured</span></div>
                            @else

                            @endif
                    {{-- <div class="timing-wrapper">
                        <div class="box-wrapper">
                            <div class="date box"> <span class="key">120</span> <span
                                    class="value">DAYS</span> </div>
                        </div>
                        <div class="box-wrapper">
                            <div class="hour box"> <span class="key">20</span> <span
                                    class="value">HRS</span> </div>
                        </div>
                        <div class="box-wrapper">
                            <div class="minutes box"> <span class="key">36</span> <span
                                    class="value">MINS</span> </div>
                        </div>
                        <div class="box-wrapper hidden-md">
                            <div class="seconds box"> <span class="key">60</span> <span
                                    class="value">SEC</span> </div>
                        </div>
                    </div> --}}
                </div>
                <!-- /.hot-deal-wrapper -->
                <div class="product-info text-left m-t-20">
                    <h3 class="name"><a href="{{ route('showProduct', $hotproduct->slug)  }}">{{ $hotproduct->name }}</a></h3>
                    <div class="rating rateit-small"></div>
                    <div class="product-price"> <span class="price"> ${{ $hotproduct->discount_price !== null ? ($hotproduct->price - $hotproduct->discount_price) : $hotproduct->price  ?? $hotproduct->price }} </span>
                        @if($hotproduct->discount_price !== null)
                        <span class="price-before-discount">$ {{ $hotproduct->price }}</span>
                        @endif </div>
                    <!-- /.product-price -->
                </div>
                <!-- /.product-info -->
                <div class="cart clearfix animate-effect">
                    <div class="action">
                        <div class="add-cart-button btn-group">
                            <button class="btn btn-primary icon" type="button" title="Add Cart"
                            data-toggle="modal" data-target="#addToCart" id="{{ $hotproduct->id }}" onclick="productView({{ $hotproduct->id }})"> <i
                                class="fa fa-shopping-cart"></i> </button>
                            <button class="btn btn-primary cart-btn" type="button" title="Add Cart"
                            data-toggle="modal" data-target="#addToCart" id="{{ $hotproduct->id }}" onclick="productView({{ $hotproduct->id }})">Add to
                                cart</button>
                        </div>
                    </div>
                    <!-- /.action -->
                </div>
                <!-- /.cart -->
            </div>
        </div>
        @endforeach
    </div>
    <!-- /.sidebar-widget -->
</div>
@endif