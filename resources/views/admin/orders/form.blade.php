<div class="card shadow p-3 custom-scroll submain">
    <div class="mb-3">
        <label for="product_id" class="form-label">Product<span class="text-danger"> *</span></label>
        <select class="form-control form-control-md" id="product_id" name="product_id" required>
            <option value="">Select</option>
            @foreach ($products as $product)
                <option value="{{ $product->id }}" {{ old('product_id', $order->product_id ?? '') == $product->id ? 'selected' : '' }}>
                        [ID: {{ $product->id }}] {{ $product->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="account_id" class="form-label">Customer<span class="text-danger"> *</span></label>
        <select class="form-control form-control-md" id="account_id" name="account_id" required>
            <option value="">Select</option>
            @foreach($accounts as $account)
                <option value="{{ $account->id }}" {{ old('account_id', $order->account_id ?? '') == $account->id ? 'selected' : '' }}>
                    [ID: {{ $account->id }}] {{ $account->first_name }} {{ $account->last_name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="quantity" class="form-label">Quantity<span class="text-danger"> *</span></label>
        <input type="number" class="form-control form-control-md" id="quantity" name="quantity" value="{{ old('quantity', $order->quantity ?? '') }}" placeholder="Enter quantity" required>
    </div>

    <div class="mb-3">
        <label for="order_status" class="form-label">Order Status<span class="text-danger"> *</span></label>
        <select class="form-control form-control-md" id="order_status" name="order_status" required>
            {{-- <option value="to pay" {{ old('order_status', $order->order_status ?? '') == 'to pay' ? 'selected' : '' }}>To Pay</option> --}}
            <option value="To ship" {{ old('order_status', $order->order_status ?? '') == 'To ship' ? 'selected' : '' }}>To Ship</option>
            <option value="To receive" {{ old('order_status', $order->order_status ?? '') == 'To receive' ? 'selected' : '' }}>To Receive</option>
            <option value="Completed" {{ old('order_status', $order->order_status ?? '') == 'Completed' ? 'selected' : '' }}>Completed</option>
            <option value="Refunded" {{ old('order_status', $order->order_status ?? '') == 'Refund' ? 'selected' : '' }}>Refund</option>
            <option value="Cancelled" {{ old('order_status', $order->order_status ?? '') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
    </div>
</div>

<style>
    .submain {
        min-height: 70vh;
        overflow-y: auto; 
        margin: 15px; 
        background: #ffffff ; 
        border-radius: 5px;
    } 
    
    .custom-scroll {
        max-height: 200px;
        overflow-y: scroll;
        padding-right: -8px;
        scrollbar-width: thin;
        scrollbar-color: rgba(0,0,0,0.2) transparent;
        position: relative;
        border-radius: 10px;
    }
    @media (max-width: 767px) {
        .submain{
            min-height: 10vh !important;
            max-height: calc(85vh - 130px) !important;
            overflow-y: scroll !important;
            margin: 0px !important;
        }
    }
    @media (max-height: 700px) and (max-width: 767px) {
        .submain{
            min-height: 10vh !important;
            max-height: calc(85vh - 150px) !important;
        }
    }
</style>
