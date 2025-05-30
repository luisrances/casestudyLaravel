
            <!-- PURCHASES -->
            <div id="purchases" class="section hidden px-4">
                <h2 class="text-2xl font-bold mb-4">MY PURCHASES</h2>

                <!-- Tabs -->
                <div class="flex border-b mb-4 space-x-4 text-sm font-semibold">
                    <button class="purchase-tab text-gray-600 border-b-2 border-blue-600 py-2" data-tab="to-ship">TO SHIP</button>
                    <button class="purchase-tab text-gray-600 py-2" data-tab="to-receive">TO RECEIVE</button>
                    <button class="purchase-tab text-gray-600 py-2" data-tab="completed">COMPLETED</button>
                    <button class="purchase-tab text-gray-600 py-2" data-tab="return-refund">RETURN/REFUND</button>
                    <button class="purchase-tab text-gray-600 py-2" data-tab="canceled">CANCELED</button>
                </div>

                <!-- Tab Content Wrapper -->
                <div id="purchase-contents" class="space-y-6">

                    <!-- TO PAY -->
                    @foreach ($orders as $order)
                        @foreach ($products as $product)
                   

                    <!-- TO SHIP -->
                            @if (Auth::user()->id==$order->account_id && $order->product_id == $product->id)
                                @if ($order->order_status == 'To ship')
                                <div class="purchase-pane" data-content="to-ship">
                                    <div class="flex items-start justify-between border rounded p-4 bg-white shadow-sm mb-2 max-h-[155px]">
                                        <div class="flex items-start gap-4">
                                            <div class="min-w-[100px] h-[120px] object-cover rounded">
                                                @if ($order->product_id == $product->id && $product->image_path)
                                                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-16 md:w-32 max-w-full max-h-full object-contain  inline-flex justify-center">
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="my-10 w-16 md:w-32 max-w-full max-h-full  inline-flex justify-center" viewBox="0 0 16 16">
                                                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                                                    </svg>
                                                @endif
                                            </div>
                                            <div class="w-[500px]">
                                                <h3 class="font-semibold text-lg">{{ $product->name }}</h3> 
                                                <p class="text-sm text-gray-500">{{ \Illuminate\Support\Str::limit($product->description, 150, '...') }}</p>
                                                <p class="text-sm">Qty:{{ $order->quantity }}</p>
                                                <p class="font-bold text-lg mt-1">₱ {{ number_format($product->price, 2) }}</p>
                                            </div>
                                        </div>
                                        <div class="inline-flex align-center space-x-3 px-2 py-11">
                                            <form onsubmit="handleCancelOrderSetting(event, {{ $product->id }})" class="cancel-form">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="min-w-[max-content] font-medium text-red-600 dark:text-red-500 hover:underline">
                                                    Cancel
                                                </button>
                                            </form>
                                            @if ($product->stock > 0)
                                                <form onsubmit="handleBuyAgainPurchaseHistory(event, {{ $product->id }})" class="buy-again-form">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <button type="submit" class="min-w-[max-content] font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                        Buy Again
                                                    </button>
                                                </form>
                                            @else
                                                <button onclick="showOutOfStockAlert()" class="min-w-[max-content] font-medium text-gray-600 dark:text-gray-500 hover:underline cursor-not-allowed">
                                                    Out of Stock
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endif

                    <!-- TO RECEIVE -->
                            @if (Auth::user()->id==$order->account_id && $order->product_id == $product->id)
                                @if ($order->order_status == 'To receive')
                                <div class="purchase-pane hidden" data-content="to-receive">
                                    <div class="flex items-start justify-between border rounded p-4 bg-white shadow-sm mb-2 max-h-[155px]">
                                        <div class="flex items-start gap-4">
                                            <div class="min-w-[100px] h-[120px] object-cover rounded">
                                                @if ($order->product_id == $product->id && $product->image_path)
                                                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-16 md:w-32 max-w-full max-h-full object-contain  inline-flex justify-center">
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="my-10 w-16 md:w-32 max-w-full max-h-full inline-flex justify-center" viewBox="0 0 16 16">
                                                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                                                    </svg>
                                                @endif
                                            </div>
                                            <div class="w-[500px]">
                                                <h3 class="font-semibold text-lg">{{ $product->name }}</h3> 
                                                <p class="text-sm text-gray-500">{{ \Illuminate\Support\Str::limit($product->description, 150, '...') }}</p>
                                                <p class="text-sm">Qty:{{ $order->quantity }}</p>
                                                <p class="font-bold text-lg mt-1">₱ {{ number_format($product->price, 2) }}</p>
                                            </div>
                                        </div>
                                        <div class="inline-flex align-center space-x-3 px-2 py-11">
                                            <form onsubmit="handleCancelOrderSetting(event, {{ $product->id }})" class="cancel-form">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="min-w-[max-content] font-medium text-red-600 dark:text-red-500 hover:underline">
                                                    Cancel
                                                </button>
                                            </form>
                                            @if ($product->stock > 0)
                                                <form onsubmit="handleBuyAgainPurchaseHistory(event, {{ $product->id }})" class="buy-again-form">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <button type="submit" class="min-w-[max-content] font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                        Buy Again
                                                    </button>
                                                </form>
                                            @else
                                                <button onclick="showOutOfStockAlert()" class="min-w-[max-content] font-medium text-gray-600 dark:text-gray-500 hover:underline cursor-not-allowed">
                                                    Out of Stock
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endif

                    <!-- COMPLETED -->
                            @if (Auth::user()->id==$order->account_id && $order->product_id == $product->id)
                                @if ($order->order_status == 'Completed')
                                <div class="purchase-pane hidden" data-content="completed">
                                    <div class="flex items-start justify-between border rounded p-4 bg-white shadow-sm mb-2 max-h-[155px]">
                                        <div class="flex items-start gap-4">
                                            <div class="min-w-[100px] h-[120px] object-cover rounded">
                                                @if ($order->product_id == $product->id && $product->image_path)
                                                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-16 md:w-32 max-w-full max-h-full object-contain  inline-flex justify-center">
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="my-10 w-16 md:w-32 max-w-full max-h-full  inline-flex justify-center" viewBox="0 0 16 16">
                                                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                                                    </svg>
                                                @endif
                                            </div>
                                            <div class="w-[500px]">
                                                <h3 class="font-semibold text-lg">{{ $product->name }}</h3> 
                                                <p class="text-sm text-gray-500">{{ \Illuminate\Support\Str::limit($product->description, 150, '...') }}</p>
                                                <p class="text-sm">Qty:{{ $order->quantity }}</p>
                                                <p class="font-bold text-lg mt-1">₱ {{ number_format($product->price, 2) }}</p>
                                            </div>
                                        </div>
                                        <div class="inline-flex align-center space-x-3 px-2 py-11">
                                            <form onsubmit="handleReturnOrderSetting(event, {{ $product->id }})" class="cancel-form">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="min-w-[max-content] font-medium text-red-600 dark:text-red-500 hover:underline">
                                                    Return
                                                </button>
                                            </form>
                                            @if ($product->stock > 0)
                                                <form onsubmit="handleBuyAgainPurchaseHistory(event, {{ $product->id }})" class="buy-again-form">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <button type="submit" class="min-w-[max-content] font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                        Buy Again
                                                    </button>
                                                </form>
                                            @else
                                                <button onclick="showOutOfStockAlert()" class="min-w-[max-content] font-medium text-gray-600 dark:text-gray-500 hover:underline cursor-not-allowed">
                                                    Out of Stock
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endif

                    <!-- RETURN/REFUND -->
                            @if (Auth::user()->id==$order->account_id && $order->product_id == $product->id)
                                @if ($order->order_status == 'Refunded')
                                <div class="purchase-pane hidden" data-content="return-refund">
                                    <div class="flex items-start justify-between border rounded p-4 bg-white shadow-sm mb-2 max-h-[155px]">
                                        <div class="flex items-start gap-4">
                                            <div class="min-w-[100px] h-[120px] object-cover rounded">
                                                @if ($order->product_id == $product->id && $product->image_path)
                                                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-16 md:w-32 max-w-full max-h-full object-contain  inline-flex justify-center">
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="my-10 w-16 md:w-32 max-w-full max-h-full  inline-flex justify-center" viewBox="0 0 16 16">
                                                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                                                    </svg>
                                                @endif
                                            </div>
                                            <div class="w-[500px]">
                                                <h3 class="font-semibold text-lg">{{ $product->name }}</h3> 
                                                <p class="text-sm text-gray-500">{{ \Illuminate\Support\Str::limit($product->description, 150, '...') }}</p>
                                                <p class="text-sm">Qty:{{ $order->quantity }}</p>
                                                <p class="font-bold text-lg mt-1">₱ {{ number_format($product->price, 2) }}</p>
                                            </div>
                                        </div>
                                        <div class="inline-flex align-center space-x-3 px-2 mx-10 py-11">
                                            @if ($product->stock > 0)
                                                <form onsubmit="handleBuyAgainPurchaseHistory(event, {{ $product->id }})" class="buy-again-form">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <button type="submit" class="min-w-[max-content] font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                        Buy Again
                                                    </button>
                                                </form>
                                            @else
                                                <button onclick="showOutOfStockAlert()" class="min-w-[max-content] font-medium text-gray-600 dark:text-gray-500 hover:underline cursor-not-allowed">
                                                    Out of Stock
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endif

                    <!-- CANCELED -->
                            @if (Auth::user()->id==$order->account_id && $order->product_id == $product->id)
                                @if ($order->order_status == 'Cancelled')
                                <div class="purchase-pane hidden" data-content="canceled">
                                    <div class="flex items-start justify-between border rounded p-4 bg-white shadow-sm mb-2 max-h-[155px]">
                                        <div class="flex items-start gap-4">
                                            <div class="min-w-[100px] h-[120px] object-cover rounded">
                                                @if ($order->product_id == $product->id && $product->image_path)
                                                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-16 md:w-32 max-w-full max-h-full object-contain  inline-flex justify-center">
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="my-10 w-16 md:w-32 max-w-full max-h-full  inline-flex justify-center" viewBox="0 0 16 16">
                                                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                                                    </svg>
                                                @endif
                                            </div>
                                            <div class="w-[500px]">
                                                <h3 class="font-semibold text-lg">{{ $product->name }}</h3> 
                                                <p class="text-sm text-gray-500">{{ \Illuminate\Support\Str::limit($product->description, 150, '...') }}</p>
                                                <p class="text-sm">Qty:{{ $order->quantity }}</p>
                                                <p class="font-bold text-lg mt-1">₱ {{ number_format($product->price, 2) }}</p>
                                            </div>
                                        </div>
                                        <div class="inline-flex align-center space-x-3 px-2 mx-10 py-11">
                                            @if ($product->stock > 0)
                                                <form onsubmit="handleBuyAgainPurchaseHistory(event, {{ $product->id }})" class="buy-again-form">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <button type="submit" class="min-w-[max-content] font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                        Buy Again
                                                    </button>
                                                </form>
                                            @else
                                                <button onclick="showOutOfStockAlert()" class="min-w-[max-content] font-medium text-gray-600 dark:text-gray-500 hover:underline cursor-not-allowed">
                                                    Out of Stock
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>


<script>
    function showOutOfStockAlert() {
    document.getElementById('success-alert-title').innerText = 'Out of Stock';
    document.getElementById('success-alert-message').innerText = 'This product is currently out of stock.';
    const alert = document.getElementById('success-alert');
    alert.style.display = 'block';
    setTimeout(() => {
        alert.style.display = 'none';
    }, 2000);
}
</script>

<script>
    function handleBuyAgainPurchaseHistory(event, productId) {
        event.preventDefault();
        
        // Create a form and submit it instead of using fetch
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route('checkout.buyAgain') }}';
        
        // Add CSRF token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = document.querySelector('meta[name="csrf-token"]').content;
        form.appendChild(csrfToken);
        
        // Add product_id
        const productIdInput = document.createElement('input');
        productIdInput.type = 'hidden';
        productIdInput.name = 'product_id';
        productIdInput.value = productId;
        form.appendChild(productIdInput);
        
        // Add form to document and submit
        document.body.appendChild(form);
        form.submit();
    }
</script>

<script>
    function handleCancelOrderSetting(event, productId) {
        event.preventDefault();
        
        if (!confirm('Are you sure you want to cancel this order?')) {
            return;
        }

        fetch('{{ route('setting.purchase.cancel') }}', {
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

<script>
    function handleReturnOrderSetting(event, productId) {
        event.preventDefault();
        
        if (!confirm('Are you sure you want to return this order?')) {
            return;
        }

        fetch('{{ route('setting.purchase.refund') }}', {
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
                document.getElementById('success-alert-title').innerText = 'Order Refunded';
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