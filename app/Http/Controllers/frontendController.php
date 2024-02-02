<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class frontendController extends Controller
{
    public function index() {
        return view('customer.index');
    }
    public function about() {
        return view('customer.about');
    }
    public function shop() {
        return view('customer.shop');
    }
    public function shopDetail() {
        return view('customer.shopDetail');
    }
    public function contact() {
        return view('customer.contact');
    }
    public function cart() {
        return view('customer.cart');
    }
    public function checkout() {
        return view('customer.checkout');
    }
}
