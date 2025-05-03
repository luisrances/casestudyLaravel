<div class="card shadow p-3 custom-scroll submain">
    <div class="mb-3">
        <label for="product_id" class="form-label">Product</label>
        <select class="form-control form-control-md" id="product_id" name="product_id" required>
            @foreach ($products as $product)
                <option value={{ $product->id }} {{ old('product_id', $product->id ?? '') == $product->id ? 'selected' : '' }}>
                        [ID: {{ $product->id }}] {{ $product->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="customer_id" class="form-label">Customer</label>
        <select class="form-control form-control-md" id="customer_id" name="customer_id" required>
            @foreach($customers as $customer)
                <option value={{ $customer->id }} {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                    [ID: {{ $customer->id }}] {{ $customer->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="number" class="form-control form-control-md" id="quantity" name="quantity" value="{{ old('quantity', $order->quantity ?? '') }}" placeholder="Enter quantity" required>
    </div>

    <div class="mb-3">
        <label for="order_status" class="form-label">Order Status</label>
        <select class="form-control form-control-md" id="order_status" name="order_status">
            {{-- <option value="to pay" {{ old('order_status', $order->order_status ?? '') == 'to pay' ? 'selected' : '' }}>To Pay</option> --}}
            <option value="to ship" {{ old('order_status', $order->order_status ?? '') == 'to ship' ? 'selected' : '' }}>To Ship</option>
            <option value="to receive" {{ old('order_status', $order->order_status ?? '') == 'to receive' ? 'selected' : '' }}>To Receive</option>
            <option value="completed" {{ old('order_status', $order->order_status ?? '') == 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="refunded" {{ old('order_status', $order->order_status ?? '') == 'refund' ? 'selected' : '' }}>Refund</option>
            <option value="cancelled" {{ old('order_status', $order->order_status ?? '') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
    </div>
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
