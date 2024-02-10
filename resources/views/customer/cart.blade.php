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
                        <tr>
                            @forelse ($cart as $item)
                            <th scope="row">
                                <div class="d-flex align-items-center">
                                    <img src="{{ url('storage/product/'.$item->product->thumbnail) }}"
                                        class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
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
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm text-center border-0"
                                        value="1">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0 mt-4">{{ "Rp." .number_format($item->product->price, 2, ",", ".") }}</p>
                            </td>
                            <td>
                                <button class="btn btn-md rounded-circle bg-light border mt-4">
                                    <i class="fa fa-times text-danger"></i>
                                </button>
                            </td>
                            @endforeach
                        </tr>
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
                            <a href="{{ route('checkout') }}">
                                <button
                                    class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4"
                                    type="button">Proceed Checkout</button>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Cart Page End -->
@endsection
