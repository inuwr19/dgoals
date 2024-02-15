@extends('layouts.customer.index')

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Checkout</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Shop</a></li>
            <li class="breadcrumb-item"><a href="#">Cart</a></li>
            <li class="breadcrumb-item active text-white">Checkout</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Checkout Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Billing details</h1>
            <form action="{{ route('post_checkout') }}" method="POST">
                @csrf
                <div class="row g-5">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-item">
                            <label class="form-label my-3">Full Name<sup>*</sup></label>
                            <input type="text" name="fullname" class="form-control" value="{{ auth()->user()->name }}" disabled>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">WhatsApp<sup>*</sup></label>
                            <input type="number" name="whatsapp" class="form-control" value="{{ auth()->user()->phone }}" disabled>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Email Address<sup>*</sup></label>
                            <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" disabled>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Address<sup>*</sup></label>
                            <input type="text" name="address" class="form-control" value="Jalan Gading Raya II RT.005 RW.010 No.16">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Town/City<sup>*</sup></label>
                            <input type="text" name="city" class="form-control" value="Jakarta Timur">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Zip Code<sup>*</sup></label>
                            <input type="text" name="zipcode" class="form-control" value="13260">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Products</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                    <tr>
                                        <th scope="row">
                                            <div class="d-flex align-items-center mt-2">
                                                <img src="{{ url('storage/product/'.$item->product->thumbnail) }}" class="img-fluid rounded-circle" style="width: 100px; height: 100px;" alt="">
                                            </div>
                                        </th>
                                        <td class="py-5">{{ $item->product->name }}</td>
                                        <td class="py-5">{{ "Rp." .number_format($item->product->price, 2, ",", ".") }}</td>
                                        <td class="py-5">{{ $item->qty }}</td>
                                        <td class="py-5">{{ "Rp." .number_format($item->product->price*$item->qty, 2, ",", ".") }}</td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center fw-bold">Data Tidak Ditemukan!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><b>Sub Total : </b></p>
                                        <p><b>Total : </b></p>
                                    </div>
                                    <div class="col-md-8 text-end">
                                        <p><span>{{ "Rp." .number_format($total, 2, ",", ".") }}</span></p>
                                        <p><span>{{ "Rp." .number_format($total+5000, 2, ",", ".") }}</span></p>
                                    </div>
                                </div>
                                <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                                    <button type="submit" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Make Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Checkout Page End -->
@endsection

@section('js')
{{-- <script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token.
      // Also, use the embedId that you defined in the div above, here.
        window.snap.embed('{{ $snapToken }}', {
        embedId: 'snap-container'
         });
    });
  </script> --}}
@endsection
