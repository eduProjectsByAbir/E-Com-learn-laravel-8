<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <title>@yield('title', 'Abir-Ecommerce') - Abir's E-Commerce</title>

    @include('frontend.layouts.partials.styles')
    @yield('styles')
</head>

<body class="cnt-home">
    <!-- ============================================== HEADER ============================================== -->
    @include('frontend.layouts.partials.header')


    <!-- ============================================== HEADER : END ============================================== -->

    @yield('content')

    <!-- /.container -->
    <!-- /#top-banner-and-menu -->

    <!-- ============================================================= FOOTER ============================================================= -->
    @include('frontend.layouts.partials.footer')
    <!-- ============================================================= FOOTER : END============================================================= -->

    <!-- For demo purposes – can be removed on production -->

    <!-- For demo purposes – can be removed on production : End -->
    @include('frontend.layouts.partials.scripts')
    @yield('scripts')

    <!-- Add to Cart Product Modal -->
    <div class="modal fade" id="addToCart" tabindex="-1" aria-labelledby="addToCartLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="m_name">title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                                <img src="..." class="card-img-top" id="m_image" alt="...">
                            </div>
                        </div>
                        <!-- // end col md -->
                        <div class="col-md-4">
                            <ul class="list-group">
                                <li class="list-group-item">Price: <b id="m_price"></b></li>
                                <li class="list-group-item">Code: <b id="m_code"></b></li>
                                <li class="list-group-item">Category: <b id="m_category"></b></li>
                                <li class="list-group-item">Brand: <b id="m_brand"></b></li>
                                <li class="list-group-item">Stock: <b id="m_stock"></b></li>
                            </ul>
                        </div><!-- // end col md -->
                        <div class="col-md-4">
                            <div class="form-group" id="m_color_form">
                                <label for="m_color">Choose Color</label>
                                <select class="form-control" id="m_color">
                                    <option value="">Select Color</option>
                                </select>
                            </div> <!-- // end form group -->

                            <div class="form-group" id="m_size_form">
                                <label for="m_size">Choose Size</label>
                                <select class="form-control" id="m_size">
                                    <option value="">Select Size</option>
                                </select>
                            </div> <!-- // end form group -->

                            <div class="form-group">
                                <label for="m_qty">Quantity</label>
                                <input type="number" class="form-control" id="m_qty" value="1" min="1">
                            </div> <!-- // end form group -->
                            <input type="hidden" id="m_product_id">
                            <button type="submit" class="btn btn-primary mb-2" onclick="addToCart()">Add to
                                Cart</button>
                        </div><!-- // end col md -->
                    </div> <!-- // end row -->
                </div> <!-- // end modal Body -->
            </div>
        </div>
    </div>
    <!-- End Add to Cart Product Modal -->

    <script>
        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
        // product view function
        function productView(id) {
            $.ajax({
                type: 'GET',
                url: '/product/json/' + id,
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function (data) {
                    $('#m_image').attr('src', data.product_thumbnail_url).attr('width', '150px');
                    $('#m_name').text(data.name);
                    if (data.discount_price) {
                        var price = data.price - data.discount_price;
                        $('#m_price').text('$ ' + price);
                    } else {
                        $('#m_price').text('$ ' + data.price);
                    }
                    $('#m_code').text(data.code);
                    $('#m_category').text(data.category.name);
                    $('#m_brand').text(data.brand.name);
                    $('#m_stock').text(data.qty);
                    $('#m_product_id').val(data.id);
                    $('#m_qty').val(1);
                    $('#m_qty').attr('max', data.qty);
                    $('#m_stock').attr('max', data.qty);
                    $('#m_size').empty();
                    $('#m_size').append("<option value='' disabled>Select Size</option>");
                    $('#m_color').empty();
                    $('#m_color').append("<option value='' disabled>Select Color</option>");
                    if (data.all_sizes == "") {
                        $('#m_size_form').hide();
                    } else {
                        $('#m_size_form').show();
                        $.each(data.all_sizes, function (key, value) {
                            $('#m_size').append("<option value='" + value + "'>" + value
                                .toUpperCase() +
                                "</option>");
                        });
                    }
                    if (data.all_colors == "") {
                        $('#m_color_form').hide();
                    } else {
                        $('#m_color_form').show();
                        $.each(data.all_colors, function (key, value) {
                            $('#m_color').append("<option value='" + value + "'>" +
                                capitalizeFirstLetter(value) +
                                "</option>");
                        });
                    }
                }
            });
        }
        // cart add
        function addToCart() {
            var id = $('#m_product_id').val();
            var name = $('#m_name').text();
            var color = $('#m_color option:selected').val();
            var size = $('#m_size option:selected').val();
            var qty = $('#m_qty').val();
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                    name: name,
                    color: color,
                    size: size,
                    qty: qty,
                },
                url: '{{ route('addToCart') }}',
                success: function (data) {
                    $('#closeModal').click();
                    if (data.success) {
                        navCartShow();
                        // $('#headerCartCount').empty().text(data.cartCount);
                        toastr.success(data.success, 'Success!');
                    } else {
                        toastr.error(data.error, 'Error!');
                    }
                }
            })
        }
    </script>
    <script type="text/javascript">
        function navCartShow() {
            $.ajax({
                type: 'GET',
                url: '{{ route('navCart') }}',
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function (data) {
                    var product = "";
                    $.each(data.carts, function (key, value) {
                        product += `
                        <div class="cart-item product-summary">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="image"> <a href="/product/${value.options.slug}"><img
                                                src="${value.options.image}" alt=""></a>
                                    </div>
                                </div>
                                <div class="col-xs-7">
                                    <h3 class="name"><a href="/product/${value.options.slug}">${value.name}</a></h3>
                                    <div class="price">$${value.price} * ${value.qty}</div>
                                </div>
                                <div class="col-xs-1 action"> <a id="${value.rowId}" class="removeProductButton" onclick="cartRemoveProduct(this.id);"><i class="fa fa-trash"></i></a>
                                </div>
                            </div>
                        </div>
                        `;
                        $('#headerCartList').html(product);
                        product += `<hr>`;
                    });
                    $('#headerCartTotal').empty().text(data.cartsTotal);
                    $('#headerCartTotalShow').empty().text(data.cartsTotal);
                    $('#headerCartCount').empty().text(data.cartQty);
                    $('#headerCartTotalTax').empty().text(data.cartsTax);
                    if (data.cartQty == 0) {
                        $('#headerCartList').empty().text('No Product in cart!');
                        $('#navCheckoutButton').attr('disabled', true);
                    }
                }
            });
        }
    </script>
    <script type="text/javascript">
        function cartRemoveProduct(id) {
            $.ajax({
                type: 'GET',
                url: '{{ route('cartRemoveProduct') }}',
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function (data) {
                    if (data.success) {
                        navCartShow();
                        toastr.success(data.success, 'Success!');
                    } else {
                        toastr.error(data.error, 'Error!');
                    }
                    if (data.cartCount == 0) {
                        $('#headerCartList').empty().text('No Product in cart!');
                    }
                }
            });
        }
    </script>
    <script>
        $('.wishlist').click(function (e) {
            e.preventDefault();
            var id = $(this).data('val');
            addToWishList(id);
        });
        function addToWishList(id) {
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                },
                url: '{{ route('addToWishlist') }}',
                success: function (data) {
                    if (data.success) {
                        toastr.success(data.success, 'Success!');
                    } else {
                        toastr.error(data.error, 'Error!');
                    }
                }
            })
        }
    </script>
    <script>
        $('#searchButton').click(function (e) {
            e.preventDefault();
            $('#searchForm').submit();
        });
    </script>

    @yield('jsscript')
</body>

</html>
