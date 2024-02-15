<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Midtrans\Config;
use Illuminate\Support\Str;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Helper\SettingHelper;

class FrontendController extends Controller
{
    public function index() {
        return view('customer.index');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        // Google user object dari google
        $userFromGoogle = Socialite::driver('google')->user();

        // Ambil user dari database berdasarkan google user id
        $userFromDatabase = User::where('google_id', $userFromGoogle->getId())->first();

        // Jika tidak ada user, maka buat user baru
        if (!$userFromDatabase) {
            $newUser = new User([
                'google_id' => $userFromGoogle->getId(),
                'name' => $userFromGoogle->getName(),
                'email' => $userFromGoogle->getEmail(),
                'password' => Hash::make('password'),
            ]);

            $newUser->save();

            $newUserId = User::latest()->first();
            $newUserId->syncRoles([2]);

            // Login user yang baru dibuat
            auth('web')->login($newUser);
            session()->regenerate();

            return redirect('/');
        }

        // Jika ada user langsung login saja
        auth('web')->login($userFromDatabase);
        session()->regenerate();

        return redirect('/');
    }

    public function logout(Request $request)
    {
        auth('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
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
        $order->status      = Str::lower('unpaid');
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

            Cart::destroy($item->id);
        }

        return redirect()->route('payment',$order->id);
    }

    public function payment(Request $request, $id)
    {
        $trx = Order::find($id);
        $orders = OrderProduct::where('order_id',$trx->id)->get();
        $user = $trx->user;
        // $data['order']      = Order::where('id',$id)->where('customer_id', Auth::user()->id)->first();
        // $data['orderProd']  = OrderProduct::where('order_id',$data['order']->id)->get();
        // Set your Merchant Server Key
        Config::$serverKey = SettingHelper::midtrans_api();
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
        // dd($trx,$orders,$user);

        $trx_details = array(
            'transaction_details' => array(
                'order_id' => $trx->code_order,
                'gross_amount' => round($trx->total_price),
            )
        );

        $item_details = [];
        foreach($orders as $order) {
            $data = $order->product;
            $item = array(
                'id' => $data->id,
                'price' => $data->price,
                'quantity' => 1,
                'name' => $data->name,
            );
            array_push($item_details, $item);
        }

        $user_details = array(
            'first_name'    => $user->name,
            'last_name'     => '',
            'email'         => $user->email,
            'phone'         => $user->phone,
        );

        $params = [
            'transaction_details' => $trx_details,
            'item_details' => $item_details,
            'customer_details' => $user_details,
        ];
        
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        dd($snapToken);
        return view('customer.payment', $data);
    }
}
