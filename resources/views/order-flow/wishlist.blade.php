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
    <main class="container mx-auto px-4 py-3 pt-0 flex-grow h-[140vh] lg:h-auto">
        <div class="ml-4 text-[18px]">
            <a class="text-lg font-semibold mb-3 px-4 pb-1 mr-[30px]" href="{{ route('cart.user') }}">Cart</a>
            <a class="text-lg font-semibold mb-3 px-4 pb-1 mr-[30px] border-b border-gray-500">Wishlist</a>
            <a class="text-lg font-semibold mb-3 px-4 pb-1 mr-[30px]" href="{{ route('purchase_history.user') }}">Purchase History</a>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 mt-5 lg:max-h-[500px] max-h-[800px]">
            <section class="flex-1 bg-white p-0 rounded-lg overflow-y-auto [box-shadow:0_0_10px_rgba(0,0,0,0.2)]">
            <div class="relative lg:min-h-[500px] rounded-lg flex items-start justify-center">
                <table class="w-[90%] text-sm text-left text-center text-gray-500">
                    <tr class="text-[16px] text-black font-light border-b sticky top-0 bg-white">
                        <th scope="col" class="pl-[100px] px-16 py-5">
                            {{-- image --}}
                        </th>
                        <th scope="col" class="px-6 py-5">
                            <h2 class="text-base font-normal">Product</h2>
                        </th>
                        <th scope="col" class="px-6 py-5">
                            <h2 class="text-base font-normal">Price</h2>
                        </th>
                        <th scope="col" class="px-6 py-5">
                            <h2 class="text-base font-normal">Action</h2>
                        </th>
                    </tr>
                    <tbody>
                        @if (Route::has('login'))
                            @auth
                                @foreach ($wishlists as $wishlist)
                                    @foreach ($products as $product)
                                        @if (Auth::user()->id==$wishlist->account_id && $wishlist->product_id == $product->id)
                                            <tr class="bg-white border-b hover:bg-gray-50">
                                                <td class="pl-[50px] py-4 ml-0 w-[150px] h-24">
                                                    @if ($wishlist->product_id == $product->id && $product->image_path)
                                                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-16 md:w-32 max-w-full max-h-full object-contain  inline-flex justify-center">
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bag w-16 md:w-32 max-w-full max-h-full  inline-flex justify-center" viewBox="0 0 16 16">
                                                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                                                        </svg>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 font-normal text-gray-900">
                                                    @if ($wishlist->product_id == $product->id)
                                                        <p class="mb-0">{{ $product->name }}</p>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 min-w-[max-content] font-normal text-gray-900">
                                                    ₱ {{ number_format($product->price, 2) }}
                                                </td>
                                                <td class="flex justify-center space-x-4 px-2 py-10 h-24">
                                                    <form action="{{ route('wishlist.remove', $wishlist) }}" method="POST">
                                                        @csrf @method('DELETE')
                                                        <button class="min-w-[max-content] font-medium text-red-600 dark:text-red-500 hover:underline">Remove</button>
                                                    </form>
                                                    <form onsubmit="handleWishlistToCart(event, {{ $product->id }})" class="add-to-cart-form">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                        <button type="submit" class="min-w-[max-content] font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                            Add to Cart
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                        @else
                            {{-- if the user is not logged in --}}
                            @endauth
                        @endif

                    </tbody>
                </table>
            </div>
            </section>
        </div>
    </main>
    <div id="success-alert" class="fixed left-[70%] top-8 transform -translate-x-1/2 z-[9999] w-full max-w-xs md:max-w-md" style="display: none;">
        <div class="bg-teal-50 border-t-2 border-teal-500 rounded-lg p-4 shadow-lg">
            <h3 id="success-alert-title" class="text-lg font-medium text-teal-800"></h3>
            <p id="success-alert-message" class="text-sm text-teal-600"></p>
        </div>
    </div>
    <script>
        function handleWishlistToCart(event, productId) {
            event.preventDefault();
            
            fetch('{{ route('wishlist.cart.add') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: 1
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    document.getElementById('success-alert-title').innerText = 'Added to Cart!';
                    document.getElementById('success-alert-message').innerText = 'Product has been added to your cart.';
                    const alert = document.getElementById('success-alert');
                    alert.style.display = 'block';
            
            // Set timeout for both hiding alert and redirecting
            setTimeout(() => {
                alert.style.display = 'none';
                // Redirect to cart page after alert is hidden
                window.location.href = '{{ route('cart.user') }}';
            }, 1000);
                }
            })
            .catch(error => console.error('Error:', error));
        }
        </script>
</x-layout>