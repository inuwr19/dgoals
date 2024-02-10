<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class frontendController extends Controller
{
    public function index() {
        return view('customer.index');
    }
    public function about() {
        return view('customer.about');
    }
    public function shop() {
        $data['product'] = Product::all();
        return view('customer.shop',$data);
    }
    public function shopDetail($id) {
        $data['item'] = Product::find($id);
        return view('customer.shopDetail',$data);
    }
    public function contact() {
        return view('customer.contact');
    }
    public function cart() {
        $data['total']  = 0;
        $data['cart']   = Cart::with('product')->where('customer_id', Auth::user()->id)->orderBy('id','DESC')->get();
        foreach ($data['cart'] as $item){
            $data['total'] += $item->product->price*$item->qty;
        }
        // dd($data);
        return view('customer.cart', $data);
    }

    public function post_cart(Request $request)
    {
        $data = Cart::where('customer_id', Auth::user()->id)->where('product_id', $request->product_id)->first();
        $new = false;
        $product = Product::find($request->product_id);
        if (!$data){
            $data = new Cart();
            $new = true;
        }

        $qty = $request->qty == 1 ? 1 : $request->qty;

        if ($new) {
            $data->qty = $qty;
            $data->product_id = $request->product_id;
            $data->total_price = $product->price*$qty;
            $data->customer_id = Auth::user()->id;
        }else{
            $data->qty = $data->qty + $qty;
        }
        $data->save();
        return view('customer.cart');
    }

    public function checkout() {
        return view('customer.checkout');
    }
}
