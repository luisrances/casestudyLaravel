<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Purchase History</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
</head>
<body class="bg-gray-100">

<div class="max-w-6xl mx-auto mt-10">
    <!-- Navigation Tabs -->
    <div class="flex space-x-6 text-lg border-b pb-2 font-semibold">
        <a href="{{ route('cart.show') }}"
           class="{{ request()->routeIs('cart.show') ? 'text-black border-b-2 border-black' : 'text-gray-500 hover:text-black' }}">
            Cart
        </a>
        <a href="{{ route('wishlist.show') }}"
           class="{{ request()->routeIs('wishlist.show') ? 'text-black border-b-2 border-black' : 'text-gray-500 hover:text-black' }}">
            Wish list
        </a>
        <a href="{{ route('purchase.history') }}"
           class="{{ request()->routeIs('purchase.history') ? 'text-black border-b-2 border-black' : 'text-gray-500 hover:text-black' }}">
            Purchase History
        </a>
    </div>

    <!-- Purchase History Table -->
    <div class="mt-6 bg-white p-6 rounded-lg shadow-md">
        <table class="w-full text-left">
            <thead>
                <tr class="text-gray-600 border-b">
                    <th class="py-3">Item</th>
                    <th class="py-3">Unit Price</th>
                    <th class="py-3">Quantity</th>
                    <th class="py-3">Total Price</th>
                    <th class="py-3">Date Purchased</th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchaseHistory as $purchase)
                <tr class="border-b hover:bg-gray-50">
                    <td class="flex items-center gap-4 py-4">
                        <img src="{{ $purchase->image_url }}" alt="{{ $purchase->name }}" class="w-16 h-16 object-cover rounded" />
                        <div>
                            <div class="font-semibold text-base">{{ $purchase->name }}</div>
                            <div class="text-sm text-gray-500">{{ $purchase->description }}</div>
                        </div>
                    </td>
                    <td class="py-4 text-base">₱{{ number_format($purchase->price, 2) }}</td>
                    <td class="py-4 text-base">{{ $purchase->quantity }}</td>
                    <td class="py-4 text-base font-semibold">₱{{ number_format($purchase->price * $purchase->quantity, 2) }}</td>
                    <td class="py-4 text-base">{{ \Carbon\Carbon::parse($purchase->purchased_at)->format('M d, Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
