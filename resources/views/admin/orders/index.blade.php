@extends('admin.admin')

@section('title', 'Orders')

@section('content')
<div class="tab-pane fade {{ request()->is('admin/orders*') ? 'show active' : '' }}" id="orders">
    <div class="container px-4 main">
        <h1 class="text-right mb-4 px-1">Orders</h1>

        <div class="row justify-content-md-between mb-3">
            <div class="col-12 col-md-5 col-lg-3 mb-2 mb-md-0">
                <a href="{{ route('orders.create') }}" class="btn w-100" style="background: #82C3EC;">Add Order</a>
            </div>
            <div class="col-12 col-md-5 col-lg-3">
                <form method="GET" action="{{ route('orders.index') }}">
                    <input type="text" name="search" class="form-control w-100 text-black border-black border-2" placeholder="Search..." value="{{ request('search') }}">
                </form>
            </div>
        </div>

        <table class="text-center desktop-content" style="width: 99.5%; margin: 0 10px;">
            <tr>
                <td style="width: 5%;">ID</td>
                <td style="width: 15%;">Product</td>
                <td style="width: 15%;">Customer</td>
                <td style="width: 10%;">Quantity</td>
                <td style="width: 15%;">Order Status</td>
                <td style="width: 30%;">Action</td>
            </tr>
        </table>

        <div class="submain">
            <div class="d-flex justify-content-center flex-column custom-scroll">
                @foreach ($orders as $order)
                    <div class="desktop-content" style="width: 100%; margin-bottom: 10px; border-radius: 10px; border: 1px solid #000000;">
                        <table class="text-center desktop-content" style="width: 100%; height: 70px;">
                            <thead>
                                <tr style="vertical-align: middle;">
                                    <td style="width: 5%; vertical-align: middle;">{{ $order->id }}</td>
                                    <td style="width: 15%; vertical-align: middle;">
                                        @foreach ($products as $product)
                                            @if ($order->product_id == $product->id)
                                                <p class="mb-0">{{ $product->name }}</p>
                                            @endif
                                        @endforeach
                                        {{-- <p class="mb-0">{{ $order->product_id }}</p> --}}
                                    </td>
                                    <td style="width: 15%; vertical-align: middle;">
                                        @foreach ($customers as $customer)
                                            @if ($order->customer_id == $customer->id)
                                                <p class="mb-0">{{ $customer->name }}</p>
                                            @endif
                                        @endforeach
                                        {{-- <p class="mb-0">{{ $order->customer_id }}</p> --}}
                                    </td>
                                    <td style="width: 10%; vertical-align: middle;">
                                        <p class="mb-0">{{ $order->quantity }}</p>
                                    </td>
                                    <td style="width: 15%; vertical-align: middle;">
                                        <p class="mb-0">{{ ucfirst($order->order_status) }}</p>
                                    </td>
                                    <td style="width: 30%; vertical-align: middle;">
                                        <div class="row d-flex justify-content-evenly d-flex align-items-center gx-0">
                                            <div class="col-3">
                                                <a href="{{ route('orders.show', $order) }}" class="btn btn-sm my-1 w-100" style="background: #82C3EC;">View</a>
                                            </div>
                                            <div class="col-3">
                                                <a href="{{ route('orders.edit', $order) }}" class="btn btn-sm w-100" style="background: #82C3EC;">Edit</a>
                                            </div>
                                            <div class="col-3">
                                                <form action="{{ route('orders.destroy', $order) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm w-100" style="background: #82C3EC;">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="card p-1 mb-3 align-self-center px-2 shadow w-100 mobile-content" style="max-width: 590px;">
                        <div class="row align-items-center gx-1 my-0">
                            <div class="col-sm-6">
                                <div class="card-body pt-1 pb-0 px-2 lh-1">
                                    <p class="fw-medium" style="margin-bottom: 0.5rem; font-size: 1.25rem;">Order #{{ $order->id }}</p>
                                    <p class="fw-normal" style="margin-bottom: 0.5rem; font-size: .9rem;">Product: {{ $order->product_id }}</p>
                                    <p class="fw-normal" style="margin-bottom: 0.5rem; font-size: .9rem;">Customer: {{ $order->customer_id }}</p>
                                    <p class="fw-normal" style="margin-bottom: 0.5rem; font-size: 1rem;">Quantity: {{ $order->quantity }}</p>
                                    <p class="fw-normal" style="margin-bottom: 0.5rem; font-size: 1rem;">Order Status: {{ ucfirst($order->order_status) }}</p>
                                </div>
                            </div>
                            <div class="col-sm-2 d-flex flex-column">
                                <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-info my-1 w-100">View</a>
                                <a href="{{ route('orders.edit', $order) }}" class="btn btn-sm btn-warning my-1 w-100">Edit</a>
                                <form action="{{ route('orders.destroy', $order) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger my-1 w-100">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</div>

<style>
    .submain {
        max-height: 65vh;
        margin: 10px;
        overflow-x: hidden;
        overflow-y: auto;
        margin-right: -2px;
        scrollbar-width: thin;
        scrollbar-color: rgba(0,0,0,0.2) transparent;
    }
    .custom-scroll {
        position: relative;
        border-radius: 10px;
    }
    @media (max-width: 767px) {
        .main{
            min-width: 90vw !important;
            min-height: 20vh !important;
            max-height: calc(100vh - 100px) !important;
            margin: 0px !important;
            overflow: hidden;
        }.submain{
            min-height: 10vh !important;
            max-height: calc(75vh - 130px) !important;
            overflow-y: scroll !important;
            margin: 0px !important;
            font-size:inherit;
        }
    }

    .mobile-content {
        display: none;
    }.desktop-content {
            display: auto;
        }
    @media (max-width: 1024px) {
        .desktop-content {
            display: none;
        }

        .mobile-content {
            display: block;
        }
    }
</style>

@endsection
