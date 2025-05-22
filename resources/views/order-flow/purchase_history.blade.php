<x-layout>
    <main class="container mx-auto px-4 py-3 pt-0 flex-grow h-[140vh] lg:h-auto">
        <div class="ml-4 text-[18px]">
            <a class="text-lg font-semibold mb-3 px-4 pb-1 mr-[30px]" href="{{ route('cart.user') }}">Cart</a>
            <a class="text-lg font-semibold mb-3 px-4 pb-1 mr-[30px]" href="{{ route('wishlist.user') }}">Wishlist</a>
            <a class="text-lg font-semibold mb-3 px-4 pb-1 mr-[30px] border-b border-gray-500">Purchase History</a>
          </div>

        <!-- Purchase History Card -->
        <div class="mt-6 bg-white rounded-md shadow-md p-6">
            <div class="grid grid-cols-4 font-semibold text-center border-b border-gray-200 pb-3">
                <div>Item</div>
                <div>Unit Price</div>
                <div>Order Status</div>
                <div></div>
            </div>

            <!-- Item Rows -->
            @php
                $statuses = ['Completed', 'Completed', 'To Receive'];
            @endphp

            @foreach ($statuses as $status)
                <div class="grid grid-cols-4 items-center text-center py-4 border-b border-gray-100">
                    <div>
                        <div class="font-semibold">MICHELIN TIRES</div>
                        <div class="text-sm text-gray-600">Power Gravel 700x40c</div>
                    </div>
                    <div class="text-gray-700 font-medium">₱ 1,0000.89</div>
                    <div class="text-gray-600">{{ $status }}</div>
                    <div class="flex space-x-2 justify-center">
                        @if ($status === 'To Receive')
                            <button class="border border-blue-400 text-blue-500 px-4 py-1 rounded-md">Cancel</button>
                            <button class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-1 rounded-md">Add to Cart</button>
                        @else
                            <button class="border border-blue-400 text-blue-500 px-4 py-1 rounded-md">Refund</button>
                            <button class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-1 rounded-md">Buy Again</button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </main>
</x-layout>