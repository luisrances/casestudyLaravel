<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Wish List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
</head>
<body class="bg-gray-100">

<div class="max-w-6xl mx-auto mt-10">
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

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

    <!-- Wishlist Table -->
    <div class="mt-6 bg-white p-6 rounded-lg shadow-md">
        <table class="w-full text-left">
            <thead>
                <tr class="text-gray-600 border-b">
                    <th class="py-3">Item</th>
                    <th class="py-3">Unit Price</th>
                    <th class="py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($wishlistItems as $item)
                <tr class="border-b hover:bg-gray-50">
                    <td class="flex items-center gap-4 py-4">
                        <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="w-16 h-16 object-cover rounded" />
                        <div>
                            <div class="font-semibold text-base">{{ $item->name }}</div>
                            <div class="text-sm text-gray-500">{{ $item->description }}</div>
                        </div>
                    </td>
                    <td class="py-4 text-base">₱{{ number_format($item->price, 2) }}</td>
                    <td class="py-4">
                        <form action="{{ route('cart.add', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-blue-500 rounded text-white hover:bg-blue-600 transition">
                                Add To Cart
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
