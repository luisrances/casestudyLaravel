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
        <label for="account_id" class="form-label">Customer</label>
        <select class="form-control form-control-md" id="account_id" name="account_id" required>
            @foreach($accounts as $account)
                <option value={{ $account->id }} {{ old('account_id') == $account->id ? 'selected' : '' }}>
                    [ID: {{ $account->id }}] {{ $account->first_name }} {{ $account->last_name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="number" class="form-control form-control-md" id="quantity" name="quantity" value="{{ old('quantity', $cart->quantity ?? '') }}" placeholder="Enter quantity" required>
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
