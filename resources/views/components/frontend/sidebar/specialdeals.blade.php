@props([
    'specialdeals' => $specialdeals = [],
])

@if(count($specialdeals) !== 0)
<div class="sidebar-widget outer-bottom-small wow fadeInUp">
    <h3 class="section-title">Special Deals</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
            <div class="item">
                <div class="products special-product">
                    @foreach ($specialdeals as $specialdeal)
                    <div class="product">
                        <div class="product-micro">
                            <div class="row product-micro-row">
                                <div class="col col-xs-5">
                                    <div class="product-image">
                                        <div class="image"> <a href="{{ route('showProduct', $specialdeal->slug)  }}"> <img
                                                    src="{{ $specialdeal->product_thumbnail_url }}"
                                                    alt=""> </a> </div>
                                        <!-- /.image -->

                                    </div>
                                    <!-- /.product-image -->
                                </div>
                                <!-- /.col -->
                                <div class="col col-xs-7">
                                    <div class="product-info">
                                        <h3 class="name"><a href="{{ route('showProduct', $specialdeal->slug)  }}">{{ $specialdeal->name }}</a></h3>
                                        <div class="rating rateit-small"></div>
                                        <div class="product-price"> <span class="price"> ${{ $specialdeal->discount_price !== null ? ($specialdeal->price - $specialdeal->discount_price) : $specialdeal->price  ?? $specialdeal->price }} </span>
                                            @if($specialdeal->discount_price !== null)
                                            <span class="price-before-discount">$ {{ $specialdeal->price }}</span>
                                            @endif </div>
                                        <!-- /.product-price -->

                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.product-micro-row -->
                        </div>
                        <!-- /.product-micro -->

                    </div>
                    @if($loop->index == 2)
                    @break;
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- /.sidebar-widget-body -->
</div>
@endif