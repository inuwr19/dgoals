@extends('layouts.admin.index')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-body">
            <!-- Chart -->
            <h1 class="mt-3">Daily Sales Overview</h1>
            <div id="chart-container" style="width: 50%; margin: auto;" class="mt-5">
                <canvas id="dailySalesChart"></canvas>
            </div>

            <script>
                var ctx = document.getElementById('dailySalesChart').getContext('2d');
                var chartData = @json($chartData);

                var dailySalesChart = new Chart(ctx, {
                    type: 'line', // Set chart type to 'line'
                    data: chartData,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
            <!-- Chart -->

            <!-- Statistics -->
            <div class="row match-height mt-5">
                <div class="col-xl-12 col-lg-12">
                    <!-- Table head options start -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Table Transaksi</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">

                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Code Order</th>
                                                    <th scope="col">Name Product</th>
                                                    <th scope="col">Quantity Product</th>
                                                    <th scope="col">Full Name</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Phone</th>
                                                    <th scope="col">Address</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order as $item)
                                                <tr>
                                                    <th scope="row">{{ $item->id }}</th>
                                                    <td>{{ $item->code_order }}</td>
                                                    <td>{{ $item->order_product[0]->product->name }}</td>
                                                    <td>{{ $item->order_product[0]->qty }}</td>
                                                    <td>{{ $item->user->name }}</td>
                                                    <td>{{ $item->user->email }}</td>
                                                    <td>{{ $item->user->phone }}</td>
                                                    <td>{{ $item->address }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Table head options end -->
                </div>
            </div>
            <!--/ Statistics -->
        </div>
    </div>
</div>
@endsection
