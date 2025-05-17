<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="max-w-7xl mx-auto mt-10 px-4">
    <div class="flex flex-col md:flex-row gap-6">

        <!-- Left: Cart Items -->
        <div class="flex-1 bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4">Checkout</h2>

            @foreach($cartItems as $item)
            <div class="flex items-center border-b py-4">
                <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="w-20 h-20 object-cover rounded mr-4">
                <div class="flex-1">
                    <div class="font-semibold">{{ $item->name }}</div>
                    <div class="text-sm text-gray-500">{{ $item->description }}</div>
                </div>
                <div class="text-right w-32">
                    <p>₱{{ number_format($item->price, 2) }}</p>
                </div>
                <div class="w-28 mx-4">
                    <div class="flex items-center border rounded px-2 py-1">
                        <button class="text-gray-600">−</button>
                        <input type="number" class="w-10 text-center border-0 focus:ring-0" value="{{ $item->quantity }}">
                        <button class="text-gray-600">+</button>
                    </div>
                </div>
                <div class="text-right w-32 font-semibold">
                    ₱{{ number_format($item->price * $item->quantity, 2) }}
                </div>
            </div>
            @endforeach
        </div>

        <!-- Right: Order Summary -->
        <div class="w-full md:w-96 bg-white p-6 rounded-lg shadow space-y-6">
            <!-- Shipping -->
            <div>
                <div class="flex justify-between items-center">
                    <h3 class="font-semibold">Shipping details</h3>
                    <a href="#" class="text-sm text-blue-600">Edit</a>
                </div>
                <p class="mt-2 text-sm"><span class="font-medium">Name:</span> {{ $user->name }}</p>
                <p class="text-sm"><span class="font-medium">Address:</span> {{ $user->address }}</p>
                <p class="text-sm"><span class="font-medium">Contact:</span> {{ $user->contact }}</p>
            </div>

            <!-- Payment -->
            <div>
                <h3 class="font-semibold mb-2">Payment details</h3>
                <div class="space-y-2">
                    <div class="flex items-center space-x-2">
                        <input type="radio" name="payment_method" value="ewallet" id="ewallet" class="accent-blue-600">
                        <label for="ewallet" class="text-sm">Digital Wallets/E-Wallets</label>
                    </div>
                    <div class="flex items-center space-x-2">
                        <input type="radio" name="payment_method" value="bank" id="bank" class="accent-blue-600" checked>
                        <label for="bank" class="text-sm">Bank Transfer</label>
                    </div>
                    <div class="flex items-center space-x-2">
                        <input type="radio" name="payment_method" value="cod" id="cod" class="accent-blue-600">
                        <label for="cod" class="text-sm">Cash on Delivery</label>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="text-sm">
                <div class="flex justify-between mb-1">
                    <span>Sub Total:</span>
                    <span>₱{{ number_format($subtotal, 2) }}</span>
                </div>
                <div class="flex justify-between mb-1">
                    <span>Sales Tax:</span>
                    <span>₱{{ number_format($tax, 2) }}</span>
                </div>
                <div class="flex justify-between items-center mb-1">
                    <span>Coupon Code:</span>
                    <a href="#" class="text-blue-600 text-xs">ADD COUPON</a>
                </div>
                <div class="flex justify-between font-bold text-lg border-t pt-2">
                    <span>Grand Total:</span>
                    <span>₱{{ number_format($total, 2) }}</span>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-between">
                <button class="px-4 py-2 border rounded text-gray-600 hover:bg-gray-100">Cancel</button>
                <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Buy Now!</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>
