{{-- resources/views/wishlist.blade.php --}}
<x-layout>
    <main class="container mx-auto px-4 py-6 mb-10 flex-grow">
        <!-- Tabs -->
        <div class="flex space-x-6 text-lg font-semibold border-b border-gray-300 pb-2">
            <button class="text-black">Cart</button>
            <button class="border-b-2 border-black">Wish list</button>
            <button class="text-black">Purchase History</button>
        </div>

        <!-- Wishlist Card -->
        <div class="mt-6 bg-white rounded-md shadow-md p-6">
            <div class="grid grid-cols-3 text-center font-semibold border-b border-gray-200 pb-3">
                <div>Item</div>
                <div>Unit Price</div>
                <div></div>
            </div>

            <!-- Item List -->
            @for ($i = 0; $i < 3; $i++)
                <div class="grid grid-cols-3 text-center items-center py-4 border-b border-gray-100">
                    <div>
                        <div class="font-semibold">MICHELIN TIRES</div>
                        <div class="text-sm text-gray-600">Power Gravel 700x40c</div>
                    </div>
                    <div class="text-gray-700 font-medium">₱ 1,0000.89</div>
                    <div>
                        <button class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded-md">
                            Add To Cart
                        </button>
                    </div>
                </div>
            @endfor
        </div>
    </main>
</x-layout>
