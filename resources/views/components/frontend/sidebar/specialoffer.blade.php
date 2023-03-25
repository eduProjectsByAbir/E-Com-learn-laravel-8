@props([
    'specialoffers' => $specialoffers = [],
])

@if(count($specialoffers) !== 0)
<div class="sidebar-widget outer-bottom-small wow fadeInUp">
    <h3 class="section-title">Special Offer</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
            <div class="item">
                <div class="products special-product">
                    @foreach ($specialoffers as $special_offer)
                    <div class="product">
                        <div class="product-micro">
                            <div class="row product-micro-row">
                                <div class="col col-xs-5">
                                    <div class="product-image">
                                        <div class="image"> <a href="{{ route('showProduct', $special_offer->slug)  }}"> <img
                                                    src="{{ $special_offer->product_thumbnail_url }}"
                                                    alt=""> </a> </div>
                                        <!-- /.image -->
                                    </div>
                                    <!-- /.product-image -->
                                </div>
                                <!-- /.col -->
                                <div class="col col-xs-7">
                                    <div class="product-info">
                                        <h3 class="name"><a href="{{ route('showProduct', $special_offer->slug)  }}">{{ $special_offer->name }}</a></h3>
                                        <div class="rating rateit-small"></div>
                                        <div class="product-price"> <span class="price"> ${{ $special_offer->discount_price !== null ? ($special_offer->price - $special_offer->discount_price) : $special_offer->price  ?? $special_offer->price }} </span>
                                            @if($special_offer->discount_price !== null)
                                            <span class="price-before-discount">$ {{ $special_offer->price }}</span>
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