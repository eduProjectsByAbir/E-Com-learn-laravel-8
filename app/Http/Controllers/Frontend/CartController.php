<?php

namespace App\Http\Controllers\Frontend;

use App\Events\ProductPurchaseEvent;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        Session::forget('coupon');
        $product = Product::findOrFail($request->id);
        $price = $product->price_discount == null ? $product->price :  $product->price - $product->price_discount;
        $cart = Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $price,
            'weight' => 1,
            'options' => [
                'image' => $product->product_thumbnail_url,
                'slug' => $product->slug,
                'color' => $request->color,
                'size' => $request->size
            ],
        ]);

        $username = 'Someone';

        if (auth()->check()) {
            $username = auth()->user()->name;
        }
        $message = $product->name . ' added to cart by ' . $username;

        event(new ProductPurchaseEvent($message));

        if ($cart && $request->page !== null && request()->has('page') && request('page') == 'details') {
            flashSuccess('Product added to cart!');
            return back();
        }

        return $cart ? response()->json([
            'success' => 'Successfully added to cart',
            'cartCount' => Cart::count(),
        ]) : response()->json([
            'error' => 'Something went wrong!',
            'cartCount' => Cart::count(),
        ]);
    }

    public function navCart()
    {
        $data = [];
        $data['carts'] = Cart::content();
        $data['cartQty'] = Cart::count();
        $data['cartsTotal'] = round(Cart::total());
        $data['cartsTax'] = Cart::tax();

        return response()->json($data);
    }

    public function cartRemoveProduct(Request $request)
    {
        Session::forget('coupon');
        $cart = Cart::remove(request('id'));
        flashSuccess('Product Removed.');
        return  response()->json([
            'success' => 'Product Removed!',
            'cartCount' => Cart::count(),
        ]);
    }

    public function myCart()
    {
        $data = [];
        $data['carts'] = Cart::content();
        $data['cartQty'] = Cart::count();
        $data['cartsTotal'] = round(Cart::total());
        $data['cartsTax'] = round(Cart::tax());
        $data['cartsPriceTotal'] = round(Cart::priceTotal());
        $data['cartsSubTotal'] = round(Cart::subtotal());
        $data['cartsDiscount'] = round(Cart::discount());
        // return $data;
        return view('frontend.pages.my-cart', $data);
    }

    public function updateCart(Request $request)
    {
        Session::forget('coupon');
        $product = Cart::get($request->id);
        if ($request->do == 'plus') {
            $cartUpdate = Cart::update($request->id, $product->qty + 1);
        }

        if ($request->do == 'minus') {
            $cartUpdate = Cart::update($request->id, $product->qty - 1);
        }

        if ($cartUpdate) {
            return  response()->json([
                'success' => 'Product Updated!',
                'cartData' => $product = Cart::get($request->id),
                'cartTax' => round(Cart::tax()),
                'cartDiscount' => round(Cart::discount()),
                'cartsSubTotal' => round(Cart::subtotal()),
                'cartsTotal' => round(Cart::total()),
            ]);
        }

        return  response()->json([
            'error' => 'Something went wrong!',
            'cartCount' => Cart::count(),
        ]);
    }

    public function applyCoupon(Request $request)
    {
        $coupon = Coupon::where('coupon_code', strtoupper($request->code))->first();

        if ($coupon) {
            if ($coupon->expired) {
                return  response()->json([
                    'error' => 'Coupon Expired!',
                ]);
            }

            if (!$coupon->has_limit) {
                return  response()->json([
                    'error' => 'Coupon Limit Over!',
                ]);
            }

            if (!$coupon->validity) {
                return  response()->json([
                    'error' => 'Invalid Coupon!',
                ]);
            }

            Session::forget('coupon');
            Session::put('coupon', [
                'coupon_code' => $coupon->coupon_code,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100)
            ]);

            return response()->json([
                'success' => 'Coupon Applied!',
                'validity' => true,
                'subtotal' => Cart::total(),
                'coupon_code' => session()->get('coupon')['coupon_code'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ]);
        }

        return  response()->json([
            'error' => 'Coupon not found!',
        ]);
    }

    public function removeCoupon()
    {
        Session::forget('coupon');
        flashSuccess('Coupon Removed!');
        return back();
    }
}
