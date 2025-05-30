{{-- usage of checkout --}}

<x-layout>
    <main class="container mx-auto px-4 py-3 mb-4 pt-0 flex-grow">
        <form method="POST" action="{{ route('checkout.process') }}" id="checkout-form">
            @csrf
            <div class="text-[18px]">
                <a class="text-lg font-semibold px-2">Checkout</a>
            </div>
            @foreach($cartItems as $item)
                <input type="hidden" name="selected_cart_items[]" value="{{ $item->id }}">
            @endforeach

            <div class="flex flex-col lg:flex-row gap-8 mt-5 h-fit">
                <section class="flex-1 bg-white p-0 rounded-lg overflow-y-auto lg:h-[520px] [box-shadow:0_0_10px_rgba(0,0,0,0.2)]">
                    <div class="relative lg:min-h-[500px] rounded-lg">
                        <table class="w-full text-sm text-left text-center text-gray-500">
                            <tr class="text-[16px] text-black font-light border-b sticky top-0 bg-white">
                                <th scope="col" class="w-[170px] py-5"></th>
                                <th scope="col" class="px-6 py-5">
                                    <h2 class="text-base font-normal">Product</h2>
                                </th>
                                <th scope="col" class="px-6 py-5">
                                    <h2 class="text-base font-normal">Quantity</h2>
                                </th>
                                <th scope="col" class="px-6 py-5">
                                    <h2 class="text-base font-normal">Price</h2>
                                </th>
                            </tr>
                            <tbody>
                                @foreach ($cartItems as $item)
                                    @php
                                        $product = $products->firstWhere('id', $item->product_id);
                                    @endphp
                                    @if ($product)
                                        <tr class="bg-white border-b hover:bg-gray-50">
                                            <td class="py-4 w-[170px] h-24">
                                                @if ($product->image_path)
                                                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-16 md:w-32 max-w-full max-h-full object-contain inline-flex justify-center">
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bag w-16 md:w-32 max-w-full max-h-full inline-flex justify-center" viewBox="0 0 16 16">
                                                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                                                    </svg>
                                                @endif
                                            </td>
                                            <td class="mr-0 px-6 py-4 font-normal text-gray-900">
                                                <p class="mb-0">{{ $product->name }}</p>
                                            </td>
                                            <td class="px-6 py-4 text-black">
                                                <div class="flex justify-center items-center">
                                                    <button type="button" class="decrement-btn inline-flex items-center justify-center h-6 w-6 p-1 text-sm font-medium text-gray-500 bg-white border border-gray-500 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-2 focus:ring-gray-100" data-cart-id="{{ $item->id }}">
                                                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                                        </svg>
                                                    </button>
                                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                                                        class="cart-qty-input bg-white w-14 h-8 border border-gray-500 text-black text-sm rounded-lg text-center focus:outline-none hover:bg-gray-100 focus:ring-2 focus:ring-gray-100 mx-2"
                                                        data-cart-id="{{ $item->id }}"
                                                        data-max-stock="{{ $product->stock }}" />
                                                    <button type="button" class="increment-btn inline-flex items-center justify-center h-6 w-6 p-1 text-sm font-medium text-gray-500 bg-white border border-gray-500 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-2 focus:ring-gray-100" data-cart-id="{{ $item->id }}">
                                                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 font-normal text-gray-900">
                                                ₱ {{ number_format($product->price, 2) }}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="w-full lg:w-[400px] bg-white p-6 rounded-lg shadow-md h-fit [box-shadow:0_0_10px_rgba(0,0,0,0.2)]">
                    <div class="flex justify-between">
                        <h2 class="text-lg font-semibold mb-2">Shipping Details</h2>
                        <span><a href="{{ route("account.setting") }}">Edit</a></span>
                    </div>
                    <div class="space-y-2 text-gray-700">
                        <div class=" w-100">
                            {{-- <span class="mr-4" >{{ $account->first_name ?? 'Guest' }} {{ $account->last_name ?? '' }}</span>     --}}
                            <select class="w-full px-4 py-2 border border-gray-300 rounded-md bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="payment_details" name="payment_details">
                                @if ($paymentDetails->isEmpty())
                                <option value="">
                                    <span class="mr-4" >Empty Shipping Details</span>
                                </option>
                                @endif
                                @foreach($paymentDetails as $detail)
                                    <option value="{{ $detail->id }}">
                                        <span class="mr-4" >( {{ $detail->recipient_name ?? 'Guest' }} )</span> {{ $detail->street }}, {{ $detail->district }}, {{ $detail->city }}, {{ $detail->region }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <h2 class="text-lg font-semibold mb-2 border-t pt-3 mt-4">Payment Method</h2>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-md bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="payment_method" name="payment_method" required>
                        <option value="cod">Cash on Delivery (COD)</option>
                        <option value="gcash">GCash</option>
                        <option value="bank_transfer">Bank Transfer</option>
                    </select>

                    <div id="gcash_details" class="hidden mt-4 p-4 bg-gray-50 rounded-md">
                        <p class="text-sm text-gray-600 mb-2">GCash Payment Details:</p>
                        <div class="space-y-2">
                            <input type="text" 
                                name="gcash_number" 
                                placeholder="Enter GCash Number"
                                class="payment-input w-full px-4 py-2 border border-gray-300 rounded-md bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                pattern="[0-9]{11}"
                                title="Please enter a valid 11-digit phone number"
                            >
                        </div>
                    </div>
                    
                    <div id="bank_details" class="hidden mt-4 p-4 bg-gray-50 rounded-md">
                        <p class="text-sm text-gray-600 mb-2">Bank Transfer Details:</p>
                        <div class="space-y-2">
                            <select name="bank_name" class="w-full px-4 py-2 border border-gray-300 rounded-md bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="BDO">BDO</option>
                                <option value="BPI">BPI</option>
                                <option value="Metrobank">Metrobank</option>
                            </select>
                            <input type="text" 
                                name="account_name" 
                                placeholder="Account Name"
                                class="payment-input w-full px-4 py-2 border border-gray-300 rounded-md bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            >
                            <input type="text" 
                                name="account_number" 
                                placeholder="Account Number"
                                class="payment-input w-full px-4 py-2 border border-gray-300 rounded-md bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                pattern="[0-9-]*"
                            >
                        </div>
                    </div>

                    <h2 class="text-lg font-semibold mb-4 border-t pt-3 mt-4">Checkout Summary</h2>
                    <div class="space-y-2 text-gray-700">
                        <div class="flex justify-between">
                            <span>Subtotal:</span>
                            <span class="font-semibold" id="cart-subtotal">₱ 0.00</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Shipping:</span>
                            <span id="cart-shipping">₱ 0.00</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Tax:</span>
                            <span id="cart-tax">₱ 0.00</span>
                        </div>
                        <div class="flex justify-between text-black text-lg font-semibold border-t pt-3 mt-4">
                            <span>Grand Total:</span>
                            <span id="cart-grandtotal">₱ 0.00</span>
                        </div>
                    </div>
                    <div class="flex gap-4 mt-6">
                        <a href="{{ route('cart.user') }}" class="flex-grow inline-flex items-center justify-center bg-white border-2 border-red-400 text-black px-6 py-3 rounded-md text-lg font-semibold hover:bg-red-400 transition duration-200">
                            Cancel
                        </a>
                        <button type="button" onclick="showSuccessModal()" class="flex-grow bg-blue-500 text-white px-6 py-3 rounded-md text-lg font-semibold hover:bg-blue-400 transition duration-200">
                            Place Order
                        </button>
                    </div>
                </section>
            </div>
            {{-- success modal after placing order --}}
            <div id="success-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                    <div class="mt-3 text-center">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Order Placed Successfully!</h3>
                        <div class="mt-2 px-7 py-3">
                            <p class="text-sm text-gray-500">Your order has been placed. You will be redirected to the shop page.</p>
                        </div>
                        <div class="items-center px-4 py-3">
                            <button id="modal-close" class="px-4 py-2 bg-green-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                                OK
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- success modal --}}
            <div id="error-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                    <div class="mt-3 text-center">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Error</h3>
                        <div class="mt-2 px-7 py-3">
                            <p class="text-sm text-gray-500" id="error-message"></p>
                        </div>
                        <div class="items-center px-4 py-3">
                            <button id="error-modal-close" class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                                OK
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- for empty shipping details modal --}}
            <div id="shipping-details-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                    <div class="mt-3 text-center">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100">
                            <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Shipping Details Required</h3>
                        <div class="mt-2 px-7 py-3">
                            <p class="text-sm text-gray-500">Please add your Shipping details before proceeding with checkout.</p>
                            <p class="text-sm text-gray-500">Visible at <strong>Address Book page</strong>.</p>
                        </div>
                        <div class="items-center px-4 py-3">
                            <button id="redirect-button" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 mr-2">
                                Add Shipping Details
                            </button>
                            <button id="cancel-button" class="px-4 py-2 bg-gray-400 text-white text-base font-medium rounded-md shadow-sm hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-300">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
    
    {{-- modal success and submits the form --}}
    <script>
        function showSuccessModal() {
            // Payment method validation
            const paymentMethod = document.getElementById('payment_method').value;
            let isValid = true;
            let errorMessage = '';

            // Clear any previous error styling
            const inputs = document.querySelectorAll('.payment-input');
            inputs.forEach(input => input.classList.remove('border-red-500'));
            
            // Check if payment details exist
            const hasPaymentDetails = @json(!empty($paymentDetails) && $paymentDetails->count() > 0);
            if (!hasPaymentDetails) {
                isValid = false;
                // Show the modal instead of alert/confirm
                const modal = document.getElementById('shipping-details-modal');
                modal.classList.remove('hidden');

                // Add event listeners for the buttons
                document.getElementById('redirect-button').addEventListener('click', function() {
                    window.location.href = '{{ route("account.setting") }}';
                });

                document.getElementById('cancel-button').addEventListener('click', function() {
                    modal.classList.add('hidden');
                });
                return;
            }
            switch(paymentMethod) {
                case 'gcash':
                    const gcashNumber = document.querySelector('input[name="gcash_number"]').value;
                    if (!gcashNumber) {
                        isValid = false;
                        errorMessage = 'Please enter your GCash number';
                        document.querySelector('input[name="gcash_number"]').classList.add('border-red-500');
                    }
                    break;

                case 'bank_transfer':
                    const accountName = document.querySelector('input[name="account_name"]').value;
                    const accountNumber = document.querySelector('input[name="account_number"]').value;
                    if (!accountName || !accountNumber) {
                        isValid = false;
                        errorMessage = 'Please complete all bank transfer details';
                        if (!accountName) document.querySelector('input[name="account_name"]').classList.add('border-red-500');
                        if (!accountNumber) document.querySelector('input[name="account_number"]').classList.add('border-red-500');
                    }
                    break;
            }

            if (!isValid) {
                e.preventDefault();
                alert(errorMessage);
            }
            // Show the success modal
            document.getElementById('success-modal').classList.remove('hidden');

            // Add click handler for OK button
            document.getElementById('modal-close').addEventListener('click', function() {
                // Submit the form
                document.getElementById('checkout-form').submit();
                window.location.href = '{{ route('Home') }}';
            });
        }

        // Prevent default form submission
        document.getElementById('checkout-form').addEventListener('submit', function(e) {
            if (!e.submitter || e.submitter.id !== 'modal-close') {
                e.preventDefault();
            }
        });
    </script>

    <script>
        // Show/hide payment details based on payment method selection
        document.getElementById('payment_method').addEventListener('change', function() {
            const bankDetails = document.getElementById('bank_details');
            const gcashDetails = document.getElementById('gcash_details');
            
            // Hide all payment details first
            bankDetails.classList.add('hidden');
            gcashDetails.classList.add('hidden');
            
            // Show the selected payment detail section
            switch(this.value) {
                case 'bank_transfer':
                    bankDetails.classList.remove('hidden');
                    break;
                case 'gcash':
                    gcashDetails.classList.remove('hidden');
                    break;
            }
        });
    </script>

    <script>
        // AJAX quantity update
        document.querySelectorAll('.cart-qty-input').forEach(input => {
            input.addEventListener('change', function() {
                const cartId = this.dataset.cartId;
                const quantity = this.value;
                const maxStock = parseInt(this.dataset.maxStock);
                if (parseInt(this.value) > maxStock) {
                    this.value = maxStock;
                    alert(`Maximum available stock is ${maxStock}`);
                }

                fetch(`/checkout/update-quantity/${cartId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ quantity })
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        // Update the quantity display
                        const qtyInput = document.querySelector(`.cart-qty-input[data-cart-id="${cartId}"]`);
                        qtyInput.value = data.quantity;
                        
                        // Recalculate totals
                        updateCartTotals();
                    }
                })
            });
        });
        // increment decrement buttons
        document.querySelectorAll('.increment-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const cartId = this.dataset.cartId;
                const input = document.querySelector(`.cart-qty-input[data-cart-id="${cartId}"]`);
                const maxStock = parseInt(input.dataset.maxStock);
                    
                    if (parseInt(input.value) < maxStock) {
                        input.value = parseInt(input.value) + 1;
                        input.dispatchEvent(new Event('change'));
                    } else {
                        alert(`Maximum available stock is ${maxStock}`);
                    }
                });
            });
        document.querySelectorAll('.decrement-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const cartId = this.dataset.cartId;
                const input = document.querySelector(`.cart-qty-input[data-cart-id="${cartId}"]`);
                if (parseInt(input.value) > 1) {
                    input.value = parseInt(input.value) - 1;
                    input.dispatchEvent(new Event('change'));
                }
            });
        });
        // calculate checkout summary
        function updateCartTotals() {
            let subtotal = 0;
            const shipping = 45; // Fixed shipping fee
            const tax = 5; // Fixed tax

            // Calculate subtotal
            document.querySelectorAll('tr.bg-white').forEach(row => {
                const quantity = parseInt(row.querySelector('.cart-qty-input')?.value || 0);
                const priceText = row.querySelector('td:last-child')?.textContent || '0';
                const price = parseFloat(priceText.replace('₱', '').replace(',', '').trim());
                
                if (!isNaN(quantity) && !isNaN(price)) {
                    subtotal += quantity * price;
                }
            });

            // Calculate grand total
            const grandTotal = subtotal + shipping + tax;

            // Update display
            document.getElementById('cart-subtotal').textContent = '₱ ' + subtotal.toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            document.getElementById('cart-shipping').textContent = '₱ ' + shipping.toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            document.getElementById('cart-tax').textContent = '₱ ' + tax.toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            document.getElementById('cart-grandtotal').textContent = '₱ ' + grandTotal.toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        // Call updateCartTotals initially and after any quantity change
        updateCartTotals();
        document.querySelectorAll('.cart-qty-input').forEach(input => {
            input.addEventListener('change', updateCartTotals);
        });
    </script>
</x-layout>