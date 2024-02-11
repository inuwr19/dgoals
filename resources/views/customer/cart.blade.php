@extends('layouts.customer.index')

@section('content')
<form action="{{ route('post_checkout') }}" method="POST" class="h-100">
    @csrf
    <input type="hidden" name="total_price" value="{{ $total }}">
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Cart</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shop') }}">Shop</a></li>
            <li class="breadcrumb-item active text-white">Cart</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cart as $item)
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ url('storage/product/'.$item->product->thumbnail) }}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{ $item->product->name }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">{{ "Rp." .number_format($item->product->price, 2, ",", ".") }}</p>
                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <a href="{{ route('minus_cart') }}" class="btn btn-sm btn-minus rounded-circle bg-light border" onclick="event.preventDefault(); document.getElementById('minus_cart_form-{{ $item->id }}').submit();">
                                                <i class="fa fa-minus"></i>
                                            </a>
                                        </div>
                                        <form id="minus_cart_form-{{ $item->id }}" class="d-none" action="{{ route('minus_cart') }}" method="POST">
                                            @csrf

                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                            <input type="hidden" name="qty" value="{{ $item->qty }}">
                                        </form>
                                        <input type="text" class="form-control form-control-sm text-center border-0" value="{{ $item->qty }}">
                                        <div class="input-group-btn">
                                            <a href="{{ route('plus_cart') }}" class="btn btn-sm btn-plus rounded-circle bg-light border" onclick="event.preventDefault(); document.getElementById('plus_cart_form-{{ $item->id }}').submit();">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                        <form id="plus_cart_form-{{ $item->id }}" class="d-none" action="{{ route('plus_cart') }}" method="POST">
                                            @csrf

                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                            <input type="hidden" name="qty" value="{{ $item->qty }}">
                                        </form>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">{{ "Rp." .number_format($item->product->price*$item->qty, 2, ",", ".") }}</p>
                                </td>
                                <td>
                                    <a href="{{ route('delete_cart') }}" class="btn btn-md rounded-circle bg-light border mt-4" onclick="event.preventDefault(); document.getElementById('del_cart_form-{{ $item->id }}').submit();">
                                        <i class="fa fa-times text-danger"></i>
                                    </a>
                                    <form id="del_cart_form-{{ $item->id }}" class="d-none" action="{{ route('delete_cart') }}" method="POST">
                                        @method('DELETE')
                                        @csrf

                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center fw-bold">Data Tidak Ditemukan!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="row g-4 justify-content-end">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <p class="mb-0">{{ "Rp." .number_format($total, 2, ",", ".") }}</p>
                            </div>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Maintenance Fee:</h5>
                                <p class="mb-0">Rp.5.000</p>
                            </div>
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p class="mb-0 pe-4">{{ "Rp." .number_format($total+5000, 2, ",", ".") }}</p>
                        </div>
                        <div class="text-center">
                            <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button" onclick="window.location='{{ route('checkout') }}'" @if ($total == 0) disabled @endif >
                                Proceed Checkout
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Cart Page End -->
@endsection
