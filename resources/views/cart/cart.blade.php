<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="max-w-6xl mx-auto mt-10">
    <!-- Navigation Tabs -->
    <div class="flex space-x-6 text-lg border-b pb-2 font-semibold">
        <a href="{{ route('cart.show') }}"
           class="{{ request()->routeIs('cart.show') ? 'text-black border-b-2 border-black' : 'text-gray-500' }}">
            Cart
        </a>
        <a href="{{ route('wishlist.show') }}"
           class="{{ request()->routeIs('wishlist.show') ? 'text-black border-b-2 border-black' : 'text-gray-500' }}">
            Wish list
        </a>
        <a href="{{ route('purchase.history') }}"
           class="{{ request()->routeIs('purchase.history') ? 'text-black border-b-2 border-black' : 'text-gray-500' }}">
            Purchase History
        </a>
    </div>

    <!-- Cart Table -->
    <form action="{{ route('cart.update') }}" method="POST">
        @csrf
        <div class="mt-6 bg-white p-6 rounded-lg shadow-md">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-gray-600 border-b">
                        <th class="py-2"></th>
                        <th class="py-2">Item</th>
                        <th class="py-2">Unit Price</th>
                        <th class="py-2">Quantity</th>
                        <th class="py-2">Item Subtotal</th>
                        <th class="py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($cartItems as $index => $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-4">
                            <input type="checkbox" name="selected[]" value="{{ $item->id }}">
                        </td>
                        <td class="flex items-center gap-4 py-4">
                            <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="w-16 h-16 object-cover rounded">
                            <div>
                                <div class="font-semibold">{{ $item->name }}</div>
                                <div class="text-sm text-gray-500">{{ $item->description }}</div>
                            </div>
                        </td>
                        <td class="py-4">₱{{ number_format($item->price, 2) }}</td>
                        <td class="py-4">
                            <div class="flex items-center space-x-2">
                                <button type="button" class="bg-gray-200 px-2 py-1 rounded">-</button>
                                <input type="number" name="quantity[{{ $item->id }}]" value="{{ $item->quantity }}" min="1" class="w-12 text-center border rounded">
                                <button type="button" class="bg-gray-200 px-2 py-1 rounded">+</button>
                            </div>
                        </td>
                        <td class="py-4">₱{{ number_format($item->price * $item->quantity, 2) }}</td>
                        <td class="py-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('checkout.single', $item->id) }}" class="px-3 py-1 border border-blue-500 text-blue-500 rounded hover:bg-blue-50">Buy Now</a>
                                <a href="{{ route('cart.remove', $item->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Delete</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Bottom Actions -->
        <div class="mt-6 flex justify-between items-center bg-white p-6 rounded-lg shadow-md">
            <div class="flex items-center space-x-4">
                <input type="checkbox" id="select-all">
                <label for="select-all" class="text-sm">Select All</label>
                <button type="submit" formaction="{{ route('cart.bulkDelete') }}" class="text-red-500 underline">Delete</button>
                <a href="#" class="font-bold">ADD COUPON</a>
            </div>
            <div class="text-right">
                <p class="text-sm">Total ({{ count($cartItems) }} Items): 
                    <span class="text-blue-600 font-semibold text-lg">
                        ₱{{ number_format($cartItems->sum(fn($item) => $item->price * $item->quantity), 2) }}
                    </span>
                </p>
                <p class="text-xs text-gray-500">Saved</p>
                <a href="{{ route('checkout.show') }}" class="mt-1 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
    Check Out
</a>

            </div>
        </div>
    </form>
</div>

</body>
</html>
