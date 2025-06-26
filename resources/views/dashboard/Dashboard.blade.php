@extends('layouts.app')
@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        @if(Auth::user()->role == 1) <!-- for users view -->
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
               
                    <div>
                        Analytics Dashboard
                     
                    </div>
                </div>
                {{-- <div class="page-title-actions">
                    <button type="button" data-toggle="tooltip" title="Example Tooltip" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                        <i class="fa fa-star"></i>
                    </button>
                    <div class="d-inline-block dropdown">
                        <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-shadow dropdown-toggle btn btn-info">
                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                <i class="fa fa-business-time fa-w-20"></i>
                            </span>
                            Buttons
                        </button>
                    </div>
                </div> --}}
            </div>
            
        </div>
         
        <div class="d-flex col-md-12"  style="align-items: stretch;">
            <style>
            .custom-widget-card {
                background-color: #f8f9fa; /* light gray background */
                border-radius: 10px;
                padding: 20px;
                margin: 10px;
                box-shadow: 0 0 10px rgba(0,0,0,0.05);
                transition: 0.3s ease;
            }

            .custom-widget-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            }

            .custom-widget-icon {
                font-size: 2rem;
                margin-bottom: 10px;
            }

            .custom-widget-numbers {
                font-size: 1.8rem;
                font-weight: bold;
            }

            .custom-widget-description {
                font-size: 1rem;
                color: #6c757d;
            }
        </style>
             <div class="col-md-6 col-lg-6 col-xl-4 mb-2">
                <div class="mb-3 card flex-fill" style="min-height: 100%;">
           
                    <div class="p-0 card-body">
                        <div class="dropdown-menu-header mt-0 mb-0">
                            <div class="dropdown-menu-header-inner bg-heavy-rain">
                                <div class="menu-header-image opacity-1" style="background-image: url('assets/images/dropdown-header/city3.jpg');"></div>
                                <div class="menu-header-content text-dark">
                                    <h5 class="menu-header-title">Best Seller</h5>
                                    <h6 class="menu-header-subtitle">
                                       Top 10 Best Selling Products
                                    </h6>
                                </div>
                            </div>
                        </div>

                        {{-- Product list --}}
                        <div class="table-responsive p-3">
                            <table class="table table-striped table-bordered mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Product Name</th>
                                        <th class="text-center">Total Ordered</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $bestSellers = DB::table('orders')
                                            ->join('products', 'orders.food_id', '=', 'products.id')
                                            ->select('products.product_name', DB::raw('SUM(orders.quantity) as total_ordered'))
                                            ->groupBy('orders.food_id', 'products.product_name')
                                            ->orderByDesc('total_ordered')
                                            ->limit(10)
                                            ->get();
                                    @endphp

                                    @forelse($bestSellers as $item)
                                        <tr>
                                            <td>{{ $item->product_name }}</td>
                                            <td class="text-center">
                                                <span class="badge badge-success">{{ $item->total_ordered }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center text-muted">No orders found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="custom-widget-card bg-secondary text-white">
                        <div class="text-center">
                            <div class="icon-wrapper rounded-circle bg-primary text-white mx-auto custom-widget-icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="custom-widget-numbers">{{ $totalB = App\Models\User::where('role',0)->count(); }}</div>
                            <div class="custom-widget-description text-white">Total Customer</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="custom-widget-card bg-primary text-white">
                        <div class="text-center">
                            <div class="icon-wrapper rounded-circle bg-success text-white mx-auto  custom-widget-icon">
                               
                                 <i class="fa fa-shopping-cart"></i>
                            </div>
                            <div class="custom-widget-numbers">{{ $totalO = App\Models\Order::count(); }}</div>
                            <div class="custom-widget-description text-white">Total Orders</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="custom-widget-card bg-info text-white">
                        <div class="text-center">
                            <div class="icon-wrapper rounded-circle bg-danger text-white mx-auto p-3 custom-widget-icon">
                                <i class="fa fa-clipboard-list"></i>
                            </div>
                            <div class="custom-widget-numbers text-white">{{ $totalC = App\Models\Product::count(); }}</div>
                            <div class="custom-widget-description text-white">Total Dish</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="custom-widget-card bg-warning">
                        <div class="text-center">
                            <div class="icon-wrapper rounded-circle bg-primary text-white mx-auto p-3 custom-widget-icon">
                                <i class="fa fa-layer-group"></i>
                            </div>
                            <div class="custom-widget-numbers text-white">{{ $totalCat = App\Models\Category::count(); }}</div>
                            <div class="custom-widget-description text-white">Total Categories</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="custom-widget-card bg-success text-white">
                        <div class="text-center">
                            <div class="icon-wrapper rounded-circle bg-info text-white mx-auto p-3 custom-widget-icon">
                                <i class="fa fa-check"></i>
                            </div>
                            <div class="custom-widget-numbers text-white">{{ $totalpaid= App\Models\Order::where('payment_status',0)->count(); }}</div>
                            <div class="custom-widget-description text-white">Total Paid</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="custom-widget-card bg-danger">
                        <div class="text-center">
                            <div class="icon-wrapper rounded-circle bg-warning text-white mx-auto p-3 custom-widget-icon">
                                <i class="fa fa-exclamation"></i>
                            </div>
                            <div class="custom-widget-numbers text-white">{{ $totalnp = App\Models\Order::where('payment_status',1)->count(); }}</div>
                            <div class="custom-widget-description text-white">Total Not Paid</div>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                @keyframes pulse {
                    0% {
                        transform: scale(1);
                        opacity: 1;
                    }
                    50% {
                        transform: scale(1.3);
                        opacity: 0.7;
                    }
                    100% {
                        transform: scale(1);
                        opacity: 1;
                    }
                    }

                   .low-stock-alert {
                        position: relative;
                        display: inline-block;
                        margin-left: 1%;
                        margin-top: -35%;
                        color: red;
                        font-weight: bold;
                        font-size: 6rem; 
                        animation: pulse 1.5s infinite;
                        z-index: 9999;
                        line-height: 1;
                        vertical-align: middle;
                        }


            </style>
       

        </div>
         <div class="row  mt-2 mb-2">
            <div class="card col-md-12">
                <canvas id="monthlySalesChart" width="400" height="200"></canvas>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
        fetch('/monthly-sales-data')
            .then(response => response.json())
            .then(data => {
                const labels = data.map(item => item.month_name);
                const totals = data.map(item => parseFloat(item.total_sales).toFixed(2)); // format here

                const ctx = document.getElementById('monthlySalesChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total Sales (₱)',
                            data: totals,
                           
                             backgroundColor: 'rgba(54, 162, 235, 0.7)',  // brighter blue with transparency
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                            borderRadius: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        // Format Y axis ticks with ₱ and 2 decimals
                                        return '₱' + Number(value).toFixed(2);
                                    }
                                }
                            }
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: 'Monthly Sales Report (₱)'
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        // Format tooltip with ₱ and 2 decimals
                                        return '₱' + Number(context.parsed.y).toFixed(2);
                                    }
                                }
                            }
                        }
                    }
                });
            });

        </script>
        @elseif(Auth::user()->role == 0) 

        @elseif(Auth::user()->role == 2)

        @elseif(Auth::user()->role == 3)


        @elseif(Auth::user()->role == 4)


        @else


        @endif

    </div>
   


@endsection