
            <!-- PURCHASES -->
            <div id="purchases" class="section hidden px-4">
                <h2 class="text-2xl font-bold mb-4">MY PURCHASES</h2>

                <!-- Tabs -->
                <div class="flex border-b mb-4 space-x-4 text-sm font-semibold">
                    <button class="purchase-tab text-blue-600 border-b-2 border-blue-600 py-2" data-tab="to-pay">TO PAY</button>
                    <button class="purchase-tab text-gray-600 py-2" data-tab="to-ship">TO SHIP</button>
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
                            @if (Auth::user()->id==$order->account_id && $order->product_id == $product->id)
                                @if ($order->order_status == 'To pay')
                                    <div class="purchase-pane hidden" data-content="to-pay"> 
                                        <div class="flex items-start justify-between border rounded p-4 bg-white shadow-sm mb-2">
                                            <div class="flex items-start gap-4">
                                                <img src="https://i.imgur.com/UXX45qK.jpg" class="w-20 h-20 object-cover rounded">
                                                <div>
                                                    <h3 class="font-semibold text-lg">{{ $product->name }}</h3>
                                                    <p class="text-sm text-gray-500">{{ $product->description }}</p>
                                                    <p class="text-sm">Qty: <strong>{{ $product->quantity }}</strong></p>
                                                    <p class="font-bold text-lg mt-1">{{ $product->price }}</p>
                                                </div>
                                            </div>
                                            <div>
                                                <form onsubmit="handleCancelOrderSetting(event, {{ $product->id }})" class="cancel-form">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <button type="submit" class="min-w-[max-content] font-normal text-black bg-red-200 px-6 py-2 rounded-lg">
                                                        Cancel
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                   

                    <!-- TO SHIP -->
                            @if (Auth::user()->id==$order->account_id && $order->product_id == $product->id)
                                @if ($order->order_status == 'To ship')
                                <div class="purchase-pane hidden" data-content="to-ship">
                                    <div class="flex items-start justify-between border rounded p-4 bg-white shadow-sm mb-2">
                                        <div class="flex items-start gap-4">
                                            <img src="https://i.imgur.com/UXX45qK.jpg" class="w-20 h-20 object-cover rounded">
                                            <div>
                                                <h3 class="font-semibold text-lg">{{ $product->name }}</h3>
                                                <p class="text-sm text-gray-500">{{ $product->description }}</p>
                                                <p class="text-sm">Qty: <strong>{{ $product->quantity }}</strong></p>
                                                <p class="font-bold text-lg mt-1">{{ $product->price }}</p>
                                            </div>
                                        </div>
                                        <div>
                                            <form onsubmit="handleCancelOrderSetting(event, {{ $product->id }})" class="cancel-form">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="min-w-[max-content] font-normal text-black bg-red-200 px-6 py-2 rounded-lg">
                                                    Cancel
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endif

                    <!-- TO RECEIVE -->
                            @if (Auth::user()->id==$order->account_id && $order->product_id == $product->id)
                                @if ($order->order_status == 'To receive')
                                <div class="purchase-pane hidden" data-content="to-receive">
                                    <div class="flex items-start justify-between border rounded p-4 bg-white shadow-sm mb-2">
                                        <div class="flex items-start gap-4">
                                            <img src="https://i.imgur.com/UXX45qK.jpg" class="w-20 h-20 object-cover rounded">
                                            <div>
                                                <h3 class="font-semibold text-lg">{{ $product->name }}</h3>
                                                <p class="text-sm text-gray-500">{{ $product->description }}</p>
                                                <p class="text-sm">Qty: <strong>{{ $product->quantity }}</strong></p>
                                                <p class="font-bold text-lg mt-1">{{ $product->price }}</p>
                                            </div>
                                        </div>
                                        <div>
                                            <form onsubmit="handleCancelOrderSetting(event, {{ $product->id }})" class="cancel-form">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="min-w-[max-content] font-normal text-black bg-red-200 px-6 py-2 rounded-lg">
                                                    Cancel
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endif

                    <!-- COMPLETED -->
                            @if (Auth::user()->id==$order->account_id && $order->product_id == $product->id)
                                @if ($order->order_status == 'Completed')
                                <div class="purchase-pane hidden" data-content="completed">
                                    <div class="flex items-start justify-between border rounded p-4 bg-white shadow-sm mb-2">
                                        <div class="flex items-start gap-4">
                                            <img src="https://i.imgur.com/UXX45qK.jpg" class="w-20 h-20 object-cover rounded">
                                            <div>
                                                <h3 class="font-semibold text-lg">{{ $product->name }}</h3>
                                                <p class="text-sm text-gray-500">{{ $product->description }}</p>
                                                <p class="text-sm">Qty: <strong>{{ $product->quantity }}</strong></p>
                                                <p class="font-bold text-lg mt-1">{{ $product->price }}</p>
                                            </div>
                                        </div>
                                        <div>
                                            <form onsubmit="handleCancelOrderSetting(event, {{ $product->id }})" class="cancel-form">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="min-w-[max-content] font-normal text-black bg-red-200 px-6 py-2 rounded-lg">
                                                    Cancel
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endif

                    <!-- RETURN/REFUND -->
                            @if (Auth::user()->id==$order->account_id && $order->product_id == $product->id)
                                @if ($order->order_status == 'Refunded')
                                <div class="purchase-pane hidden" data-content="return-refund">
                                    <div class="flex items-start justify-between border rounded p-4 bg-white shadow-sm mb-2">
                                        <div class="flex items-start gap-4">
                                            <img src="https://i.imgur.com/UXX45qK.jpg" class="w-20 h-20 object-cover rounded">
                                            <div>
                                                <h3 class="font-semibold text-lg">{{ $product->name }}</h3>
                                                <p class="text-sm text-gray-500">{{ $product->description }}</p>
                                                <p class="text-sm">Qty: <strong>{{ $product->quantity }}</strong></p>
                                                <p class="font-bold text-lg mt-1">{{ $product->price }}</p>
                                            </div>
                                        </div>
                                        <div>
                                            <form onsubmit="handleCancelOrderSetting(event, {{ $product->id }})" class="cancel-form">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="min-w-[max-content] font-normal text-black bg-red-200 px-6 py-2 rounded-lg">
                                                    Cancel
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endif

                    <!-- CANCELED -->
                            @if (Auth::user()->id==$order->account_id && $order->product_id == $product->id)
                                @if ($order->order_status == 'Cancelled')
                                <div class="purchase-pane" data-content="canceled">
                                    <div class="flex items-start justify-between border rounded p-4 bg-white shadow-sm mb-2">
                                        <div class="flex items-start gap-4">
                                            <img src="https://i.imgur.com/UXX45qK.jpg" class="w-20 h-20 object-cover rounded">
                                            <div>
                                                <h3 class="font-semibold text-lg">{{ $product->name }}</h3>
                                                <p class="text-sm text-gray-500">{{ $product->description }}</p>
                                                <p class="text-sm">Qty: <strong>{{ $product->quantity }}</strong></p>
                                                <p class="font-bold text-lg mt-1">{{ $product->price }}</p>
                                            </div>
                                        </div>
                                        <div>
                                            <form onsubmit="handleCancelOrderSetting(event, {{ $product->id }})" class="cancel-form">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="min-w-[max-content] font-normal text-black bg-red-200 px-6 py-2 rounded-lg">
                                                    Cancel
                                                </button>
                                            </form>
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