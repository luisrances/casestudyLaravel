<x-layout>
    <main class="container mx-auto px-4 py-3 pt-0 flex-grow h-[140vh] lg:h-auto">
        <div class="ml-4 text-[18px]">
            <a class="text-lg font-semibold mb-3 px-4 pb-1 mr-[30px]" href="{{ route('cart.user') }}">Cart</a>
            <a class="text-lg font-semibold mb-3 px-4 pb-1 mr-[30px]" href="{{ route('wishlist.user') }}">Wishlist</a>
            <a class="text-lg font-semibold mb-3 px-4 pb-1 mr-[30px] border-b border-gray-500">Purchase History</a>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 mt-5 lg:max-h-[500px] max-h-[800px]">
            <section class="flex-1 bg-white p-0 rounded-lg overflow-y-auto [box-shadow:0_0_10px_rgba(0,0,0,0.2)]">
            <div class="relative lg:min-h-[500px] rounded-lg flex items-start justify-center">
                <table class="w-[90%] text-sm text-left text-center text-gray-500">
                    <tr class="text-[16px] text-black font-light border-b sticky top-0 bg-white">
                        <th scope="col" class="pl-[50px] px-16 py-5">
                            {{-- image --}}
                        </th>
                        <th scope="col" class="px-6 py-5">
                            <h2 class="text-base font-normal">Product</h2>
                        </th>
                        <th scope="col" class="px-6 py-5">
                            <h2 class="text-base font-normal">Price</h2>
                        </th>
                        <th scope="col" class="px-6 py-5">
                            <h2 class="text-base font-normal">Order Status</h2>
                        </th>
                        <th scope="col" class="px-6 py-5">
                            <h2 class="text-base font-normal">Action</h2>
                        </th>
                    </tr>
                    <tbody>
                        @if (Route::has('login'))
                            @auth
                                @foreach ($orders as $order)
                                    @foreach ($products as $product)
                                        @if (Auth::user()->id==$order->account_id && $order->product_id == $product->id)
                                            <tr class="bg-white border-b hover:bg-gray-50">
                                                <td class="pl-[10px] py-4 ml-0 w-[150px] h-24">
                                                    @if ($order->product_id == $product->id && $product->image_path)
                                                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-16 md:w-32 max-w-full max-h-full object-contain  inline-flex justify-center">
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bag w-16 md:w-32 max-w-full max-h-full  inline-flex justify-center" viewBox="0 0 16 16">
                                                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                                                        </svg>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 font-normal text-gray-900">
                                                    @if ($order->product_id == $product->id)
                                                        <p class="mb-0">{{ $product->name }}</p>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 font-normal text-gray-900">
                                                    ₱ {{ number_format($product->price, 2) }}
                                                </td>
                                                <td class="px-6 py-4 font-normal text-gray-900">
                                                    {{ $order->order_status }}
                                                </td>
                                                <td class="flex justify-center space-x-4 px-2 py-10 h-24">
                                                    @if ($order->order_status == 'Completed')
                                                        <form onsubmit="handleRefund(event, {{ $product->id }})" class="refund-form">
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                            <button type="submit" class="min-w-[max-content] font-medium text-red-600 dark:text-red-500 hover:underline">
                                                                Refund
                                                            </button>
                                                        </form>
                                                    @elseif ($order->order_status == 'Refunded' || $order->order_status == 'Cancelled')
                                                    @else
                                                        <form onsubmit="handleCancelOrder(event, {{ $product->id }})" class="cancel-form">
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                            <button type="submit" class="min-w-[max-content] font-medium text-red-600 dark:text-red-500 hover:underline">
                                                                Cancel
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <form onsubmit="handleBuyAgain(event, {{ $product->id }})" class="buy-again-form">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                        <button type="submit" class="min-w-[max-content] font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                            Buy Again
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
        </div>
    </main>
    <script>
        function handleBuyAgain(event, productId) {
            event.preventDefault();
            
            fetch('{{ route('checkout.buyAgain') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    product_id: productId,
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    document.getElementById('success-alert-title').innerText = 'Added to Cart!';
                    document.getElementById('success-alert-message').innerText = data.message;
                    const alert = document.getElementById('success-alert');
                    alert.style.display = 'block';
                    
                    // Redirect to cart page after showing message
                    setTimeout(() => {
                        alert.style.display = 'none';
                        window.location.href = '{{ route('cart.user') }}';
                    }, 2000);
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function handleRefund(event, productId) {
            event.preventDefault();
            
            if (!confirm('Are you sure you want to refund this order?')) {
                return;
            }

            fetch('{{ route('purchase_history.refund') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    product_id: productId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    document.getElementById('success-alert-title').innerText = 'Refund Requested';
                    document.getElementById('success-alert-message').innerText = data.message;
                    const alert = document.getElementById('success-alert');
                    alert.style.display = 'block';
                    
                    // Refresh the page after showing message
                    setTimeout(() => {
                        alert.style.display = 'none';
                        window.location.reload();
                    }, 2000);
                }
            })
            .catch(error => console.error('Error:', error));
        }
        function handleCancelOrder(event, productId) {
            event.preventDefault();
            
            if (!confirm('Are you sure you want to cancel this order?')) {
                return;
            }

            fetch('{{ route('purchase_history.cancel') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    product_id: productId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    document.getElementById('success-alert-title').innerText = 'Order Cancelled';
                    document.getElementById('success-alert-message').innerText = data.message;
                    const alert = document.getElementById('success-alert');
                    alert.style.display = 'block';
                    
                    // Refresh the page after showing message
                    setTimeout(() => {
                        alert.style.display = 'none';
                        window.location.reload();
                    }, 2000);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</x-layout>