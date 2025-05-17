@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Cart</h2>
    <form method="POST" action="{{ route('cart.update') }}">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>Item</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Item Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $index => $item)
                <tr>
                    <td><input type="checkbox" name="selected_items[]" value="{{ $index }}"></td>
                    <td>
                        <img src="{{ $item['image'] }}" width="70"><br>
                        <strong>{{ $item['name'] }}</strong><br>
                        {{ $item['description'] }}
                    </td>
                    <td>₱{{ number_format($item['price'], 2) }}</td>
                    <td>
                        <input type="number" name="quantities[{{ $index }}]" value="{{ $item['quantity'] }}" min="1" class="form-control" style="width: 80px;">
                    </td>
                    <td>₱{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                    <td>
                        <a href="{{ route('cart.buy', ['id' => $index]) }}" class="btn btn-primary btn-sm">Buy Now</a>
                        <a href="{{ route('cart.delete', ['id' => $index]) }}" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-between">
            <div>
                <button type="submit" class="btn btn-outline-secondary">Update Cart</button>
            </div>
            <div>
                <h5>Total ({{ count($cartItems) }} Items): ₱{{ number_format($total, 2) }}</h5>
                <a href="{{ route('checkout') }}" class="btn btn-success">Check Out</a>
            </div>
        </div>
    </form>
</div>

<script>
    document.getElementById('select-all').onclick = function() {
        let checkboxes = document.getElementsByName('selected_items[]');
        for (let checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    }
</script>
@endsection
