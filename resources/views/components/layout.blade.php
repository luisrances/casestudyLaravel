<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Go Pedal PH</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon" />
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <style>
        .no-scroll {
            overflow: hidden;
        }
    </style>
</head>

<body>
    <x-nav-bar />

    <!-- Success Alert -->
    <div id="success-alert"
        class="fixed left-[70%] top-8 transform -translate-x-1/2 z-[9999] w-full max-w-xs md:max-w-md"
        style="display: none;">
        <div id="alert-container" class="bg-teal-50 border-t-2 border-teal-500 rounded-lg p-4 shadow-lg" role="alert" tabindex="-1">
            <div class="flex">
                <div class="shrink-0">
                    <span id="alert-icon-wrapper" class="inline-flex justify-center items-center size-8 rounded-full border-4 border-teal-100 bg-teal-200 text-teal-800">
                        <svg id="alert-icon" class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
                            <path d="m9 12 2 2 4-4"></path>
                        </svg>
                    </span>
                </div>
                <div class="ms-3">
                    <h3 id="success-alert-title" class="text-gray-800 font-semibold text-base">Successfully updated.</h3>
                    <p id="success-alert-message" class="text-sm text-gray-700">You have successfully updated your email preferences.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- End Success Alert -->

    <div class="pt-[100px] max-w-screen-xl mx-auto">
        {{ $slot }}
    </div>

    <x-Footer />

    @vite('resources/js/app.js')

<!-- Product Modal - Compact Version -->
<div id="product-modal" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center px-4 sm:px-6 lg:px-8 overflow-y-auto" style="display: none;">
    <div class="relative bg-white rounded-2xl shadow-lg w-full max-w-4xl mx-auto my-12 overflow-hidden">
        <!-- Close Button - Outside Content -->
        <button onclick="closeProductModal()"
            class="absolute top-4 right-4 z-10 bg-white/90 backdrop-blur-sm hover:bg-white text-gray-600 hover:text-gray-800 w-8 h-8 rounded-full flex items-center justify-center text-xl font-bold shadow-md transition-all">
            &times;
        </button>

        <div class="flex flex-col md:flex-row p-6 md:p-8 gap-5 min-h-[450px]">
            <!-- Left: Image -->
            <div class="w-full md:w-1/2 flex flex-col space-y-3">
                <!-- Image Container with Overlay Wishlist -->
                <div class="relative bg-gray-50 rounded-2xl overflow-hidden flex-1 min-h-[300px]">
                    <img id="modal-product-image" 
                        src="https://via.placeholder.com/500x650?text=No+Image" 
                        alt="Product Image"
                        class="w-full h-full object-cover" />
                    
                    <!-- Wishlist Button Overlay -->
                    <div class="absolute top-3 left-3">
                        <form id="addToWishlistForm" onsubmit="handleAddToWishlist(event)">
                            @csrf
                            <input type="hidden" name="product_id" id="wishlist_product_id">
                            <button type="submit" class="flex items-center justify-center bg-white/70 backdrop-blur-sm hover:bg-white text-red-600 p-2 rounded-full shadow-lg transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 6 4 4 6.5 4c1.74 0 3.41 1.01 4.22 2.61C11.09 5.01 12.76 4 14.5 4 17 4 19 6 19 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right: Details and Buttons -->
            <div class="w-full md:w-1/2 flex flex-col space-y-4 overflow-hidden pr-4">
                <!-- Title Section -->
                <div>
                    <h2 id="modal-product-name" class="text-2xl font-bold text-gray-800 leading-tight pr-8">Product Name</h2>
                </div>

                <!-- Description Section -->
                <div class="flex-grow">
                    <div id="modal-product-description-container" class="h-[160px] overflow-y-auto text-sm text-gray-600 pr-2">
                        <p id="modal-product-description" class="leading-relaxed">
                            Lorem ipsum dolor sit amet...
                        </p>
                    </div>
                    <p class="hidden" id="modal-product-id">0</p>
                </div>

                <!-- Product Info and Actions -->
                <div class="space-y-4 flex-shrink-0">
                    <!-- Product Info Container -->
                    <div class="bg-gradient-to-r from-blue-50 to-green-50 border border-gray-200 rounded-xl p-4">
                        <div class="flex justify-between items-center">
                            <!-- Price (Left) -->
                            <div>
                                <p class="text-gray-600 font-medium text-sm mb-1">Price:</p>
                                <p id="modal-product-price" class="text-2xl font-bold text-blue-600">₱0.00</p>
                            </div>
                            
                            <!-- Stock (Right) -->
                            <div class="inline-flex items-center px-3 py-2 bg-white/80 backdrop-blur-sm rounded-full border">
                                <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                <p id="modal-product-stock" class="text-green-700 font-medium text-sm">Stock: 0</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3">
                        <button class="flex-1 bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-xl transition-colors font-medium text-sm shadow-md hover:shadow-lg">
                            Buy
                        </button>
                        
                        <form id="addToCartForm" onsubmit="handleAddToCart(event)" class="flex-1">
                            @csrf
                            <input type="hidden" name="product_id" id="product_id">
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-xl transition-colors font-medium text-sm shadow-md hover:shadow-lg">
                                Add
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

  {{-- alert when cart is clicked but not logged in yet --}}
  <div id="login-alert" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100">
                <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Authentication Required</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">Please login to access your cart.</p>
            </div>
            <div class="items-center px-4 py-3">
                <button onclick="redirectToLogin()" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    Login
                </button>
                <button onclick="closeLoginAlert()" class="mt-3 px-4 py-2 bg-gray-100 text-gray-700 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
<script>
  function showLoginAlert() {
      document.getElementById('login-alert').classList.remove('hidden');
  }

  function closeLoginAlert() {
      document.getElementById('login-alert').classList.add('hidden');
  }

  function redirectToLogin() {
      window.location.href = '{{ route("login") }}';
  }
</script>

    <script>
        function handleBuyAgain(event, productId) {
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

    <!-- Scripts -->
    <script>
        function openProductModal(name, description, stock, price, imageUrl = '', id) {
    // Create buttons based on authentication state
    const buttonsHtml = `
        @if (Route::has('login'))
            @auth
                <div class="flex gap-3 w-full">
                    <form method="POST" action="{{ route('checkout.buyAgain') }}" class="flex-1 buy-again-form">
                        @csrf
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                        <input type="hidden" name="product_id" value="${id}">
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-xl transition font-medium">
                            Buy Now
                        </button>
                    </form>      
                    <form id="addToCartForm" onsubmit="handleAddToCart(event)" class="flex-1">
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                        <input type="hidden" name="product_id" id="product_id" value="${id}">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-xl transition font-medium">
                            Add to Cart
                        </button>
                    </form>
                </div>
            @else
                <div class="flex gap-3 w-full">
                    <button onclick="showLoginAlert()" class="flex-1 bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-xl transition-colors font-medium text-sm shadow-md hover:shadow-lg">
                        Buy Now
                    </button>
                    <button onclick="showLoginAlert()" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-xl transition-colors font-medium text-sm shadow-md hover:shadow-lg">
                        Add to Cart
                    </button>
                </div>
            @endauth
        @endif
    `;

    // Find and update the button container
    const buttonContainer = document.querySelector('#product-modal .flex.gap-3');
    if (buttonContainer) {
        buttonContainer.innerHTML = buttonsHtml;
    }

    // Update modal content
    const elements = {
        name: document.getElementById('modal-product-name'),
        description: document.getElementById('modal-product-description'),
        stock: document.getElementById('modal-product-stock'),
        price: document.getElementById('modal-product-price'),
        productId: document.getElementById('product_id'),
        wishlistProductId: document.getElementById('wishlist_product_id'),
        image: document.getElementById('modal-product-image'),
        modal: document.getElementById('product-modal')
    };

    // Safely update elements if they exist
    if (elements.name) elements.name.innerText = name;
    if (elements.description) {
        const cleanedDescription = description.replace(/^#.*$\n?/gm, '').trim();
        elements.description.innerText = cleanedDescription;
    }
    if (elements.stock) elements.stock.innerText = `Stock: ${stock}`;
    if (elements.price) elements.price.innerText = `₱${parseFloat(price).toFixed(2)}`;
    if (elements.productId) elements.productId.value = id;
    if (elements.wishlistProductId) elements.wishlistProductId.value = id;
    if (elements.image) elements.image.src = imageUrl || 'https://via.placeholder.com/500x650?text=No+Image';
    
    // Show modal and disable scroll
    if (elements.modal) {
        elements.modal.style.display = 'flex';
        document.body.classList.add('no-scroll');
    }
}

        function closeProductModal() {
            document.getElementById('product-modal').style.display = 'none';
            document.body.classList.remove('no-scroll');
        }

        function showSuccess(title, message) {
            closeProductModal();
            document.getElementById('success-alert-title').innerText = title;
            document.getElementById('success-alert-message').innerText = message;
            const alert = document.getElementById('success-alert');
            alert.style.display = 'block';
            setTimeout(() => {
                alert.style.display = 'none';
            }, 2000);
        }

        function handleAddToCart(event) {
            event.preventDefault();
            const productId = document.getElementById('product_id').value;
            showSuccess_cart('Added to Cart!', 'Product has been added to your cart.', productId);
        }

        function showSuccess_cart(title, message, productId = null) {
            closeProductModal();
            fetch('{{ route('cart.add') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ product_id: productId, quantity: 1 })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('success-alert-title').innerText = title;
                    document.getElementById('success-alert-message').innerText = data.message;
                    const alert = document.getElementById('success-alert');
                    alert.style.display = 'block';
                    setTimeout(() => {
                        alert.style.display = 'none';
                    }, 2000);
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function handleAddToWishlist(event) {
            event.preventDefault();
            const productId = document.getElementById('wishlist_product_id').value;
            showSuccess_wishlist('Added to Wishlist!', 'Product has been added to your wishlist.', productId);
        }

        function showSuccess_wishlist(title, message, productId = null) {
            closeProductModal();
            fetch('{{ route('wishlist.add') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('success-alert-title').innerText = title;
                    document.getElementById('success-alert-message').innerText = data.message;
                    const alert = document.getElementById('success-alert');
                    alert.style.display = 'block';
                    setTimeout(() => {
                        alert.style.display = 'none';
                    }, 2000);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>

</html>
