<x-layout>
    <main class="container mx-auto px-4 py-3 pt-0 flex-grow h-[140vh] lg:h-auto">
        <div class="ml-4 text-[18px]">
            <a class="text-lg font-semibold mb-3 px-4 pb-1 mr-[30px] border-b border-gray-500">Cart</a>
            <a class="text-lg font-semibold mb-3 px-4 pb-1 mr-[30px]" href="{{ route('wishlist.user') }}">Wishlist</a>
            <a class="text-lg font-semibold mb-3 px-4 pb-1 mr-[30px]" href="{{ route('purchase_history.user') }}">Purchase History</a>
          </div>

        <div class="flex flex-col lg:flex-row gap-8 mt-5 lg:max-h-[500px] max-h-[800px]">
            <section class="flex-1 bg-white p-0 rounded-lg overflow-y-auto [box-shadow:0_0_10px_rgba(0,0,0,0.2)]">
            <div class="relative lg:min-h-[500px] rounded-lg">
                <table class="w-full text-sm text-left text-center text-gray-500">
                    <tr class="text-[16px] text-black font-light border-b sticky top-0 bg-white">
                        <th scope="col" class="pl-8 py-5">
                            {{-- checkbox --}}
                        </th>
                        <th scope="col" class="pl-0 px-16 py-5">
                            {{-- image --}}
                        </th>
                        <th scope="col" class="px-6 py-5">
                            <h2 class="text-base font-normal">Product</h2>
                        </th>
                        <th scope="col" class="px-6 py-5">
                            <h2 class="text-base font-normal">Quantity</h2>
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
                                @foreach ($carts as $cart)
                                    @foreach ($products as $product)
                                        @if (Auth::user()->id==$cart->account_id && $cart->product_id == $product->id)
                                            <tr class="bg-white border-b hover:bg-gray-50">
                                                <td class="px-5 py-4">
                                                    <input type="checkbox" name="selected_cart_items[]" value="{{ $cart->id }}" class="w-4 h-4 text-blue-600 bg-white border border-gray-500 rounded hover:bg-gray-100 focus:ring-blue-500">
                                                </td>
                                                <td class="py-4 ml-0 w-[110px] h-24">
                                                    @if ($cart->product_id == $product->id && $product->image_path)
                                                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-16 md:w-32 max-w-full max-h-full object-contain  inline-flex justify-center">
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bag w-16 md:w-32 max-w-full max-h-full  inline-flex justify-center" viewBox="0 0 16 16">
                                                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                                                        </svg>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 font-normal text-gray-900">
                                                    @if ($cart->product_id == $product->id)
                                                        <p class="mb-0">{{ $product->name }}</p>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 text-black">
                                                    <div class="flex justify-center items-center">
                                                        <button type="button" class="decrement-btn inline-flex items-center justify-center h-6 w-6 p-1 text-sm font-medium text-gray-500 bg-white border border-gray-500 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-2 focus:ring-gray-100" data-cart-id="{{ $cart->id }}">
                                                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                                            </svg>
                                                        </button>
                                                        <input type="number" name="quantity" value="{{ $cart->quantity }}" min="1"
                                                            class="cart-qty-input bg-white w-14 h-8 border border-gray-500 text-black text-sm rounded-lg text-center focus:outline-none hover:bg-gray-100 focus:ring-2 focus:ring-gray-100 mx-2"
                                                            data-cart-id="{{ $cart->id }}" />
                                                        <button type="button" class="increment-btn inline-flex items-center justify-center h-6 w-6 p-1 text-sm font-medium text-gray-500 bg-white border border-gray-500 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-2 focus:ring-gray-100" data-cart-id="{{ $cart->id }}">
                                                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 w-[150px] font-normal text-gray-900">
                                                    ₱ {{ number_format($product->price, 2) }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    <form action="{{ route('cart.remove', $cart) }}" method="POST">
                                                        @csrf @method('DELETE')
                                                        <button class="font-medium text-red-600 dark:text-red-500 hover:underline">Remove</button>
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

            <section class="w-full lg:w-[400px] bg-white p-6 rounded-lg shadow-md static lg:sticky lg:top-[13%] z-0 h-fit [box-shadow:0_0_10px_rgba(0,0,0,0.2)]">
                <h2 class="text-lg font-semibold mb-4">Cart Summary</h2>
            
                <div class="space-y-3 text-gray-700">
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
            
                    <div class="flex justify-between text-black text-lg font-semibold border-t pt-4 mt-4">
                        <span>Grand Total:</span>
                        <span id="cart-grandtotal">₱ 0.00</span>
                    </div>
                </div>
            
                <button id="checkout-btn" class="mt-6 w-full bg-blue-500 text-white py-3 rounded-md text-lg font-semibold hover:bg-blue-400 transition duration-200">
                    Proceed to Checkout
                </button>
            </section>
        </div>
    </main>
{{-- custom alert div for selecting an item before proceeding to checkout --}}
<div id="custom-alert" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100">
                <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Attention Needed</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">Please select at least one item to checkout.</p>
            </div>
            <div class="items-center px-4 py-3">
                <button id="alert-close" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    OK
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    // AJAX quantity update
    document.querySelectorAll('.cart-qty-input').forEach(input => {
        input.addEventListener('change', function() {
            const cartId = this.dataset.cartId;
            const quantity = this.value;

            fetch(`/cart/update-quantity/${cartId}`, {  // Changed from /checkout to /cart
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
                    updateCartTotals();  // Changed from updateCartTotals to updateSummary
                }
            })
        });
    });
    // for increment decrement button of quantity
    document.querySelectorAll('.increment-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const cartId = this.dataset.cartId;
            const input = document.querySelector(`.cart-qty-input[data-cart-id="${cartId}"]`);
            input.value = parseInt(input.value) + 1;
            input.dispatchEvent(new Event('change'));
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
    // Collect all checkboxes and listen for changes
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('input[name="selected_cart_items[]"]');
        const subtotalSpan = document.getElementById('cart-subtotal');
        const grandTotalSpan = document.getElementById('cart-grandtotal');
        const shippingSpan = document.getElementById('cart-shipping');
        const taxSpan = document.getElementById('cart-tax');
        const priceMap = {};

        // Build a map of cart id to price * quantity
        @foreach ($carts as $cart)
            @foreach ($products as $product)
                @if ($cart->product_id == $product->id)
                    priceMap[{{ $cart->id }}] = {{ $product->price }} * {{ $cart->quantity }};
                @endif
            @endforeach
        @endforeach

        function updateCartTotals() {
            let subtotal = 0;
            const checkboxes = document.querySelectorAll('input[name="selected_cart_items[]"]');
            const shipping = 45; // Fixed shipping fee
            const tax = 5; // Fixed tax

            // Calculate subtotal only for checked items
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    const row = checkbox.closest('tr');
                    const quantity = parseInt(row.querySelector('.cart-qty-input').value || 0);
                    const priceText = row.querySelector('td:nth-last-child(2)').textContent;
                    const price = parseFloat(priceText.replace('₱', '').replace(',', '').trim());
                    
                    if (!isNaN(quantity) && !isNaN(price)) {
                        subtotal += quantity * price;
                    }
                }
            });

            // Only add shipping and tax if there are items selected
            const finalShipping = subtotal > 0 ? shipping : 0;
            const finalTax = subtotal > 0 ? tax : 0;
            const grandTotal = subtotal + finalShipping + finalTax;

            // Update display with proper formatting
            const formatter = new Intl.NumberFormat('en-PH', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            document.getElementById('cart-subtotal').textContent = '₱ ' + formatter.format(subtotal);
            document.getElementById('cart-shipping').textContent = '₱ ' + formatter.format(finalShipping);
            document.getElementById('cart-tax').textContent = '₱ ' + formatter.format(finalTax);
            document.getElementById('cart-grandtotal').textContent = '₱ ' + formatter.format(grandTotal);
        }

        // Add event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Update totals when checkboxes change
            document.querySelectorAll('input[name="selected_cart_items[]"]').forEach(checkbox => {
                checkbox.addEventListener('change', updateCartTotals);
            });

            // Update totals when quantity changes
            document.querySelectorAll('.cart-qty-input').forEach(input => {
                input.addEventListener('change', updateCartTotals);
            });

            // Initial calculation
            updateCartTotals();
        });

        // for only checked items it will show the price
        checkboxes.forEach(cb => cb.addEventListener('change', updateCartTotals));
        // Call updateCartTotals initially and after any quantity change
        updateCartTotals();
        document.querySelectorAll('.cart-qty-input').forEach(input => {
            input.addEventListener('change', updateCartTotals);
        });

        // On checkout, get only checked items
        document.getElementById('checkout-btn').addEventListener('click', function (e) {
            const selected = Array.from(checkboxes).filter(cb => cb.checked).map(cb => cb.value);
            if (selected.length === 0) {
                e.preventDefault();
                document.getElementById('custom-alert').classList.remove('hidden');
                return;
            }

            // Create a form to submit selected IDs to the checkout route
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('checkout') }}"; // Make sure you have a named route 'checkout'
            
            // Add CSRF token for Laravel
            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';
            form.appendChild(csrf);

            // Add selected cart item IDs
            selected.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'selected_cart_items[]';
                input.value = id;
                form.appendChild(input);
            });

            document.body.appendChild(form);
            form.submit();
        });
        document.getElementById('alert-close').addEventListener('click', function() {
        document.getElementById('custom-alert').classList.add('hidden');
    });
    });
</script>
</x-layout>