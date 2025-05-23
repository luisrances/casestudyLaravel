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
        <div class="bg-teal-50 border-t-2 border-teal-500 rounded-lg p-4 shadow-lg" role="alert" tabindex="-1">
            <div class="flex">
                <div class="shrink-0">
                    <span class="inline-flex justify-center items-center size-8 rounded-full border-4 border-teal-100 bg-teal-200 text-teal-800">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
                            <path d="m9 12 2 2 4-4"></path>
                        </svg>
                    </span>
                </div>
                <div class="ms-3">
                    <h3 id="success-alert-title" class="text-gray-800 font-semibold text-base">
                        Successfully updated.
                    </h3>
                    <p class="text-sm text-gray-700" id="success-alert-message">
                        You have successfully updated your email preferences.
                    </p>
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

    <!-- Product Modal -->
    <div id="product-modal" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center px-4 sm:px-6 lg:px-8 overflow-y-auto" style="display: none;">
        <div class="relative bg-white rounded-2xl shadow-lg w-full max-w-4xl mx-auto my-12 overflow-hidden">
            <!-- Close Button -->
            <button onclick="closeProductModal()"
                class="absolute top-5 right-5 text-gray-400 hover:text-gray-600 text-2xl font-bold z-10">
                &times;
            </button>

            <div class="flex flex-col md:flex-row p-6 md:p-8 gap-5 h-[500px]">
                <!-- Left: Image and Price -->
                <div class="w-full md:w-1/2 flex flex-col space-y-3">
                    <!-- Image Container with Overlay Wishlist -->
                    <div class="relative bg-gray-50 rounded-2xl overflow-hidden flex-1">
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
                <div class="w-full md:w-1/2 flex flex-col justify-between space-y-2 overflow-hidden">
                    <div>
                        <h2 id="modal-product-name" class="text-2xl font-bold text-gray-800 mb-2">Product Name</h2>
                        <div id="modal-product-description-container" class="h-[220px] overflow-y-auto text-sm text-gray-600 mb-4 pr-1">
                            <p id="modal-product-description">
                                Lorem ipsum dolor sit amet...
                            </p>
                        </div>
                        <p class="hidden" id="modal-product-id">0</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-3">
                        <!-- Product Info Container - Small -->
                        <div class="bg-white border border-gray-200 rounded-lg p-3 mb-4">
                            <div class="flex justify-between items-center">
                                <!-- Price (Left) -->
                                <div>
                                    <p class="text-gray-600 font-medium text-xs mb-0.5">Price:</p>
                                    <p id="modal-product-price" class="text-xl font-bold text-blue-400">₱0.00</p>
                                </div>
                                
                                <!-- Stock (Right) -->
                                <div class="inline-flex items-center px-2 py-1 bg-green-50 rounded-full">
                                    <div class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></div>
                                    <p id="modal-product-stock" class="text-green-700 font-medium text-xs">Stock: 0</p>
                                </div>
                            </div>
                        </div>
                        <!-- Buy Now and Add to Cart - Side by Side -->
                        <div class="flex gap-3">
                            <button class="flex-1 bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-xl transition font-medium">
                                Buy Now
                            </button>
                            
                            <form id="addToCartForm" onsubmit="handleAddToCart(event)" class="flex-1">
                                @csrf
                                <input type="hidden" name="product_id" id="product_id">
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-xl transition font-medium">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function openProductModal(name, description, stock, price, imageUrl = '', id) {
            document.getElementById('modal-product-name').innerText = name;

            // Remove lines starting with #
            const cleanedDescription = description.replace(/^#.*$\n?/gm, '').trim();
            document.getElementById('modal-product-description').innerText = cleanedDescription;

            document.getElementById('modal-product-stock').innerText = 'Stock: ' + stock;
            document.getElementById('modal-product-price').innerText = '₱' + parseFloat(price).toFixed(2);
            document.getElementById('product_id').value = id;
            document.getElementById('wishlist_product_id').value = id;
            document.getElementById('modal-product-image').src = imageUrl || 'https://via.placeholder.com/500x650?text=No+Image';
            document.getElementById('product-modal').style.display = 'flex';

            document.body.classList.add('no-scroll');
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

        
// Account setting handler
function handleAccountSetting(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAccountSuccess('Profile Updated', data.message);
        } else {
            showAccountSuccess('Error', 'Failed to update profile. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAccountSuccess('Error', 'An unexpected error occurred.');
    });
}

function showAccountSuccess(title, message) {
    document.getElementById('success-alert-title').innerText = title;
    document.getElementById('success-alert-message').innerText = message;
    const alert = document.getElementById('success-alert');
    alert.style.display = 'block';
    setTimeout(() => {
        alert.style.display = 'none';
    }, 2000);
}
    </script>
</body>

</html>
