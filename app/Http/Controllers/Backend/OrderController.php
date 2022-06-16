<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::latest()->paginate(12);
        return view('admin.order.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [];
        $data['order'] = Order::where([
            'id' => $id,
        ])->first();
        $data['orderItem'] = OrderItem::with('product')->where('order_id', $id)->latest('id')->get();
        return view('admin.order.show', $data);
    }

    public function invoice($id)
    {
        $data = [];
        $data['order'] = Order::where([
            'id' => $id
        ])->first();
        $data['orderItem'] = OrderItem::with('product')->where('order_id', $id)->latest('id')->get();

        $pdf = PDF::loadView('frontend.template.invoice', $data);
        return $pdf->download('invoice.pdf');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id)->delete();

        if($order){
            flashSuccess('Order Deleted!');
            return back();
        }
    }

    public function statusChange(Request $request, $id){
        $order = Order::findOrFail($id);

        if($request->status == "confirmed"){
            if($order->confirmed_date == null){
                $OrderItem = OrderItem::where('order_id', $order->id)->get();
                foreach($OrderItem as $item){
                    $product = Product::findOrFail($item->product_id);
                    if($product->qty !== 0){
                        $qty = $product->qty-$item->qty;
                        $product->qty = $qty;
                        $product->save();
                    } else {
                        flashWarning('Product Limit Over!');
                        return back();
                    }
                }
            }

            $order->status = "confirmed";
            $order->confirmed_date = Carbon::now()->format('d F Y');
            flashSuccess("Order Confirmed!");
        }

        if($request->status == "processing"){
            $order->status = "processing";
            $order->processing_date = Carbon::now()->format('d F Y');
            flashSuccess("Order processing...!");
        }

        if($request->status == "picked"){
            $order->status = "picked";
            $order->picked_date = Carbon::now()->format('d F Y');
            flashSuccess("Order picked...!");
        }

        if($request->status == "shipped"){
            $order->status = "shipped";
            $order->shipped_date = Carbon::now()->format('d F Y');
            flashSuccess("Order shipped...!");
        }

        if($request->status == "delivered"){
            $order->status = "delivered";
            $order->delivered_date = Carbon::now()->format('d F Y');
            flashSuccess("Order delivered...!");
        }

        if($request->status == "cancel"){
            $order->status = "cancel";
            $order->cancel_date = Carbon::now()->format('d F Y');
            flashSuccess("Order cancel...!");
        }

        if($request->status == "return"){
            $order->status = "return";
            $order->return_date = Carbon::now()->format('d F Y');
            flashSuccess("Order return...!");
        }

        $order->save();
        return back();
    }
}
