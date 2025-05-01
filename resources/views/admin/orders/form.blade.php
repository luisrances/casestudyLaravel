@extends('admin')

@section('content')
<div class="container container-fluid main" style="max-height: 100%;">
    <h1 class="text-right mb-2 px-3">Add Order</h1>
    <form action="{{ route('admin.orders.store') }}" method="POST">
        @csrf
        <div class="card shadow p-3 custom-scroll submain">
            <!-- Product Selection -->
            <div class="mb-3">
                <label for="product_id" class="form-label">Product</label>
                <select class="form-control form-control-md" id="product_id" name="product_id" required>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                             (ID: {{ $product->id }}) {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Customer ID -->
{{-- <div class="mb-3">
    <label for="customer_id" class="form-label">Customer</label>
    <select class="form-control form-control-md" id="customer_select">
        @foreach($customers as $customer)
            <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                 (ID: {{ $customer->id }}) {{ $customer->name }}
            </option>
        @endforeach
    </select>
</div> --}}

<div class="mb-3">
    <label for="customer_id" class="form-label">Customer</label>
    <input type="text" class="form-control form-control-md" id="customer_id" name="customer_id" placeholder="Enter customer_id">
</div>

            <!-- Quantity -->
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control form-control-md" id="quantity" name="quantity" value="{{ old('quantity') }}" placeholder="Enter quantity" required>
            </div>

            <!-- Order Status -->
            <div class="mb-3">
                <label for="order_status" class="form-label">Order Status</label>
                <select class="form-control form-control-md" id="order_status" name="order_status">
                    <option value="to_pay" {{ old('order_status') == 'to_pay' ? 'selected' : '' }}>To Pay</option>
                    <option value="to_ship" {{ old('order_status') == 'to_ship' ? 'selected' : '' }}>To Ship</option>
                    <option value="to_receive" {{ old('order_status') == 'to_receive' ? 'selected' : '' }}>To Receive</option>
                    <option value="completed" {{ old('order_status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="refund" {{ old('order_status') == 'refund' ? 'selected' : '' }}>Refund</option>
                    <option value="cancelled" {{ old('order_status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-3 column-gap-3">
            <button class="btn btn-success" style="width: 200px">Save</button>
            <a href="{{ url()->previous() }}" class="btn bg-danger text-white me-2" style="width: 200px">Cancel</a>
        </div>
    </form>
</div>

<style>
    @media (max-width: 767px) {
        .main{
            min-height: 20vh !important;
            max-height: calc(100vh - 100px) !important;
            margin: 0px !important;
            overflow: hidden;
            justify-content: center; 
            align-items: center;
            overflow-y: hidden; 
        }
    }
</style>
@endsection
