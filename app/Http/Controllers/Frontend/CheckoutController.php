<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\AddressCountry;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Library\SslCommerz\SslCommerzNotification;

class CheckoutController extends Controller
{
    public function checkout()
    {
        if (auth()->check()) {
            if (Cart::total() <= 0) {
                flashWarning('Please add product and then checkout...');
                return redirect(route('showProducts'));
            }
            $data = [];
            $data['carts'] = Cart::content();
            $data['cartQty'] = Cart::count();
            $data['cartsTotal'] = round(Cart::total());
            $data['cartsTax'] = round(Cart::tax());
            $data['cartsPriceTotal'] = round(Cart::priceTotal());
            $data['cartsSubTotal'] = round(Cart::subtotal());
            $data['cartsDiscount'] = round(Cart::discount());
            $data['countries'] = AddressCountry::all();

            return view('frontend.pages.checkout', $data);
        }

        flashWarning('Please login or register to checkout...');
        return redirect(route('login'));
    }

    public function OrderStore(Request $request)
    {
        $data = [];
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['post_code'] = $request->post_code;
        $data['country_id'] = $request->country_id;
        $data['division_id'] = $request->division_id;
        $data['district_id'] = $request->district_id;
        $data['city_id'] = $request->city_id;
        $data['notes'] = $request->notes;
        $data['payment_method'] = $request->payment_method;


        $data['cartQty'] = Cart::count();
        $data['cartsTotal'] = round(Cart::total());
        $data['cartsTax'] = round(Cart::tax());
        $data['cartsPriceTotal'] = round(Cart::priceTotal());
        $data['cartsSubTotal'] = round(Cart::subtotal());
        $data['cartsDiscount'] = round(Cart::discount());

        if ($request->payment_method == "stripe") {
            return view('frontend.pages.stripe-payment', $data);
        }

        if ($request->payment_method == "sslcommerz") {
            return view('frontend.pages.sslcommerz-payment', $data);
        }

        if ($request->payment_method == "card") {
            flashError('Sorry, no card payment available!');
            return back();
        }

        if ($request->payment_method == "cod") {
            return view('frontend.pages.cod-payment', $data);
        }
    }

    public function OrderStoreStripe(Request $request)
    {
        \Stripe\Stripe::setApiKey('sk_test_51LAmtZH4ZaGAIPGs6UC2qaBqJoD8m3eUyU7wrpg9aaloH1Fbt1hjW9kXoQKPuYub27RDcryRf8JJAKrldTKyq24J002i7QNo9d');

        $token = $_POST['stripeToken'];

        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = round(Cart::total());
        }

        $charge = \Stripe\Charge::create([
            "amount" => $total_amount * 100,
            "currency" => "usd",
            "description" => "Abir - Ecommerce Shop",
            "source" => $token,
            "metadata" => ['order_id' => uniqid()]
        ]);

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'address_country_id' => $request->country_id,
            'address_division_id' => $request->division_id,
            'address_district_id' => $request->district_id,
            'address_city_id' => $request->city_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'post_code' => $request->post_code,
            'notes' => $request->notes,

            'payment_type' => 'Stripe',
            'payment_method' => 'Stripe',
            'payment_type' => $charge->payment_method,
            'transaction_id' => $charge->balance_transaction,
            'currency' => $charge->currency,
            'amount' => $total_amount,
            'order_number' => $charge->metadata->order_id,

            'invoice_no' => 'AZEC' . mt_rand(10000000, 99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'pending',
            'created_at' => Carbon::now(),

        ]);

        $invoice = Order::findOrFail($order_id);
        $data = [
            'invoice_no' => $invoice->invoice_no,
            'amount' => $total_amount,
            'name' => $invoice->name,
            'email' => $invoice->email,
        ];


        $carts = Cart::content();
        foreach ($carts as $cart) {
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),

            ]);
        }


        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        Cart::destroy();
        Mail::to($request->email)->send(new OrderMail($data));

        flashSuccess('Order Placed Succesfully!');
        return redirect()->route('user.myorders');
    }

    public function OrderStoreCOD(Request $request)
    {
        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = round(Cart::total());
        }

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'address_country_id' => $request->country_id,
            'address_division_id' => $request->division_id,
            'address_district_id' => $request->district_id,
            'address_city_id' => $request->city_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'post_code' => $request->post_code,
            'notes' => $request->notes,

            'payment_type' => 'COD',
            'payment_method' => 'COD',
            'currency' => 'USD',
            'amount' => $total_amount,
            'order_number' => uniqid(),

            'invoice_no' => 'AZEC' . mt_rand(10000000, 99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'pending',
            'created_at' => Carbon::now(),

        ]);

        $invoice = Order::findOrFail($order_id);
        $data = [
            'invoice_no' => $invoice->invoice_no,
            'amount' => $total_amount,
            'name' => $invoice->name,
            'email' => $invoice->email,
        ];


        $carts = Cart::content();
        foreach ($carts as $cart) {
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),

            ]);
        }

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        Cart::destroy();
        Mail::to($request->email)->send(new OrderMail($data));

        flashSuccess('Order Placed Succesfully!');
        return redirect()->route('user.myorders');
    }

    public function OrderStoreSSLCommerz(Request $request)
    {
        $requestData = json_decode($request->cart_json);


        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = round(Cart::total());
        }

        $orderid = uniqid();
        $tran_id = uniqid();

        $post_data = array();
        $post_data['total_amount'] = $total_amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = $tran_id; // tran_id must be unique
        // $post_data['order_number'] = $orderid; // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $requestData->name;
        $post_data['cus_email'] = $requestData->email;
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = $requestData->country_id;
        $post_data['cus_phone'] = $requestData->phone;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        // ['order_id' => uniqid()]
        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'address_country_id' => $requestData->country_id,
            'address_division_id' => $requestData->division_id,
            'address_district_id' => $requestData->district_id,
            'address_city_id' => $requestData->city_id,
            'name' => $requestData->name,
            'email' => $requestData->email,
            'phone' => $requestData->phone,
            'post_code' => $requestData->post_code,
            'notes' => $requestData->notes,

            'payment_type' => 'sslcommerz',
            'payment_method' => 'sslcommerz',
            'payment_type' => 'sslcommerz',
            'transaction_id' => $tran_id,
            'currency' => 'BDT',
            'amount' => $total_amount,
            'order_number' => $orderid,

            'invoice_no' => 'AZEC' . mt_rand(10000000, 99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'pending',
            'created_at' => Carbon::now(),

        ]);

        $invoice = Order::findOrFail($order_id);
        $data = [
            'invoice_no' => $invoice->invoice_no,
            'amount' => $total_amount,
            'name' => $invoice->name,
            'email' => $invoice->email,
        ];


        $carts = Cart::content();
        foreach ($carts as $cart) {
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),
            ]);
        }

        Mail::to($requestData->email)->send(new OrderMail($data));

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        Cart::destroy();

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }
}
