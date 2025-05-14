@extends('admin.admin')

@section('title', 'Dashboard')

@section('content')
<div class="tab-pane fade {{ request()->is('admin/dashboard*') ? 'show active' : '' }}" id="dashboard">
    <div class="p-4 pt-0 main">
        <h1 class="mt-4">Dashboard</h1>

        <div class="container submain mb-0" style="max-height: 78vh !important;">
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Revenue</div>
                                    <div class="h2 mb-0 font-weight-bold text-gray-800">$ {{ $totalRevenue }} </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Total Orders
                                    </div>
                                    <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $totalOrders }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Total Products</div>
                                    <div class="h2 mb-0 font-weight-bold text-gray-800">{{$totalProducts}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-box-open fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Total Customers</div>
                                    <div class="h2 mb-0 font-weight-bold text-gray-800">{{$totalUsers}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6 col-md-12 mb-4" style="height:fit-content; max-height:365px;">
                    <div class="card border-left-info shadow h-100 py-2 mb-0">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Monthly Revenue</div>
                                </div>
                            </div>
                            <canvas id="monthlyRevenueChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-12 mb-4" style="max-height:fit-content; height:365px;">
                    <div class="card border-left-info shadow h-100 py-2 pb-0 mb-4 mb-md-0">
                        <div class="card-body" style="max-width:85vw;">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pending Orders</div>
                                </div>
                            </div>

                            <div class="table-responsive mb-0" style="max-width:85vw; max-height: 300px; overflow: auto;">
                                <table id="modern_datatable" class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product</th>
                                            <th>Customer</th>
                                            <th>Quantity</th>
                                            <th>Order Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pendings as $pending)
                                            <tr style="cursor: pointer;">
                                                <td class="name-cell">{{ $pending->id }}</td>
                                                <td>
                                                    @foreach ($products as $product)
                                                        @if ($pending->product_id == $product->id)
                                                            <p class="mb-0">{{ $product->name }}</p>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($accounts as $account)
                                                        @if ($pending->account_id == $account->id)
                                                            <p class="mb-0">{{ $account->first_name }} {{ $account->last_name }}</p>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>{{ $pending->quantity }}</td>
                                                <td>{{ ucfirst($pending->order_status) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- Add more content here, like tables for recent orders, charts, etc. --}}

    </div>
{{-- chart --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('monthlyRevenueChart').getContext('2d');
    const monthlyRevenueChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($monthlyRevenue->pluck('month')) !!},
            datasets: [{
                label: 'Revenue ($)',
                data: {!! json_encode($monthlyRevenue->pluck('revenue')) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                tension: 0.3,
                fill: true,
                pointRadius: 3
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: false,
                }
            }
        }
    });
</script>
{{-- pending table --}}
<script>
    $(document).ready(function() {
        $('#modern_datatable').DataTable({
            // Remove the l (length) and f (filter/search) controls
            dom: 'rtip',
            // lengthMenu: [[5, 10, 25, -1], [5, 10, 25, "All"]],
            pageLength: 3,
            ordering: true,
            responsive: true
        });
    });
</script>


@endsection