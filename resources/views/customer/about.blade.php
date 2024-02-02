@extends('layouts.customer.index')

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">About Us</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active text-white">About Us</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- About Us Start -->
    <div class="container-fluid contact py-5">
        <div class="container py-5">
            <div class="p-5 bg-light rounded">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="text-center mx-auto" style="max-width: 700px;">
                            <h1 class="text-primary">About Us</h1>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="text-center mx-auto mb-5">
                            <img src="{{ asset('customer') }}/img/logo.png" alt="">
                        </div>
                        <h4 class="mb-3 text-secondary">Passion Meets Performance</h4>
                        <p>Di D'Goals, kami memahami bahwa sepatu bukan hanya alat olahraga atau aksesori, tetapi juga merupakan pernyataan gaya hidup yang mendalam. Didirikan dengan visi untuk menginspirasi dan memperlengkapi individu dalam setiap langkahnya, D'Goals hadir sebagai teman setia para pecinta olahraga dan pencinta fashion.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About Us End -->
@endsection
