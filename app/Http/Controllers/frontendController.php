<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index() {
        return view('customer.index');
    }

    public function about() {
        return view('customer.about');
    }

    public function contact() {
        return view('customer.contact');
    }

    public function shop() {
        $data['product'] = Product::all();
        return view('customer.shop',$data);
    }

    public function shopDetail($id) {
        $data['item'] = Product::find($id);
        return view('customer.shopDetail',$data);
    }

    public function cart() {
        $data['total']  = 0;
        $data['cart']   = Cart::with('product')->where('customer_id', Auth::user()->id)->orderBy('id','DESC')->get();
        foreach ($data['cart'] as $item){
            $data['total'] += $item->product->price*$item->qty;
        }
        return view('customer.cart', $data);
    }

    public function post_cart(Request $request)
    {
        $data = Cart::where('customer_id', Auth::user()->id)->where('product_id', $request->product_id)->first();
        $new  = false;
        $product = Product::find($request->product_id);
        if (!$data){
            $data = new Cart();
            $new  = true;
        }

        $qty = $request->qty <= 1 ? 1 : $request->qty;

        if ($new) {
            $data->qty         = $qty;
            $data->customer_id = Auth::user()->id;
        }else{
            $data->qty = $data->qty + $qty;
        }

        $data->product_id  = $request->product_id;
        $data->total_price = $product->price*$data->qty;
        $data->save();
        return redirect()->back();
    }

    public function plus_cart(Request $request)
    {
        $data               = Cart::where('customer_id', Auth::user()->id)->where('id', $request->id)->first();
        $product            = Product::find($request->product_id);
        $data->qty          = $data->qty + 1;
        $data->total_price  = $data->qty * $product->price;
        $data->save();
        return back();
    }

    public function minus_cart(Request $request)
    {
        $data               = Cart::where('customer_id', Auth::user()->id)->where('id', $request->id)->first();
        $product            = Product::find($request->product_id);
        $data->qty          = $data->qty - 1;
        $data->total_price  = $data->qty * $product->price;
        $data->save();
        return back();
    }

    public function delete_cart(Request $request)
    {
        $data = Cart::where('customer_id', Auth::user()->id)->where('id', $request->id)->first();
        $data->delete();
        return back();
    }

    public function checkout() {
        $data['total']  = 0;
        $data['data']   = Cart::with('product')->where('customer_id', Auth::user()->id)->orderBy('id','DESC')->get();
        foreach ($data['data'] as $item){
            $data['total'] += $item->product->price*$item->qty;
        }
        return view('customer.checkout', $data);
    }

    public function post_checkout(Request $request)
    {
        // dd($request->all());
        $order      = new Order;
        $orderProd  = new OrderProduct;
        $total      = 0;
        $cart       = Cart::with('product')->where('customer_id', Auth::user()->id)->get();

        // calculate total price
        foreach ($cart as $item){
            $total  += $item->product->price*$item->qty;
        }
        $total_price = $total+5000;

        // insert to table order
        $order->code_order  = 'TRX-'.mt_rand(1000,9999).time();
        $order->customer_id = Auth::user()->id;
        $order->total       = (int)$total_price;
        $order->status      = Str::lower('paid');
        $order->city        = Str::ucfirst($request->city);
        $order->address     = Str::ucfirst($request->address);
        $order->zipcode     = (int)$request->zipcode;
        $order->save();

        // insert to table order product
        foreach ($cart as $item){
            $orderProd->order_id    = $order->id;
            $orderProd->product_id  = $item->id;
            $orderProd->qty         = $item->qty;
            $orderProd->total_price = $item->total_price;
            $orderProd->save();
        }

        return redirect()->route('payment',$order->id);
    }

    public function payment(Request $request, $id)
    {
        $data['order']      = Order::where('id',$id)->where('customer_id', Auth::user()->id)->first();
        $data['orderProd']  = OrderProduct::where('order_id',$data['order']->id)->get();
        dd($data['order'],$data['orderProd']);
        return view('customer.payment', $data);
    }
}
