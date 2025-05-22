<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shop</title>
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

    <!-- Success Alert (center top, global) -->
    <div id="success-alert"
        class="fixed left-[70%] top-8 transform -translate-x-1/2 z-[9999] w-full max-w-xs md:max-w-md"
        style="display: none;">
        <div class="bg-teal-50 border-t-2 border-teal-500 rounded-lg p-4 shadow-lg" role="alert" tabindex="-1" aria-labelledby="hs-bordered-success-style-label">
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
    <div class="fixed inset-0 bg-black bg-opacity-20 flex items-center justify-center z-50" id="product-modal" style="display: none;">
        <div class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-4xl max-h-screen overflow-y-auto relative flex flex-col md:flex-row">

            <!-- Close Button -->
            <button onclick="closeProductModal()"
                class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-2xl font-bold">
                &times;
            </button>

            <!-- Left Side: Product Details -->
            <div class="flex flex-col justify-between w-1/2 p-2">
                <div>
                    <h2 class="text-[22px] font-bold mb-4" id="modal-product-name">Product Name</h2>
                    <div id="modal-product-description-container" class="overflow-y-auto max-h-40 mb-4">
                        <p id="modal-product-description" class="text-[14px] text-gray-700">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua...
                        </p>
                    </div>
                    <p class="text-[20px] text-green-600 font-semibold mb-2" id="modal-product-stock">Stock: 0</p>
                    <p class="text-[22px] text-gray-800 font-medium">Price:</p>
                    <p class="text-[28px] text-blue-700 font-bold mb-6" id="modal-product-price">₱0.00</p>
                    <p class="hidden" id="modal-product-id">0</p>
                </div>

                <div class="flex items-center space-x-6 mt-auto">
                    <form id="addToWishlistForm" onsubmit="handleAddToWishlist(event)">
                        @csrf
                        <input type="hidden" name="product_id" id="wishlist_product_id"> <!-- Changed ID to avoid conflict -->
                        <button type="submit" class="bg-sky-300 p-3 rounded-xl flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 6 4 4 6.5 4c1.74 0 3.41 1.01 4.22 2.61C11.09 5.01 12.76 4 14.5 4 17 4 19 6 19 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                            </svg>
                        </button>
                    </form>
                    <form id="addToCartForm" onsubmit="handleAddToCart(event)">
                        @csrf
                        <input type="hidden" name="product_id" id="product_id">
                        <button type="submit" class="bg-sky-300 text-black text-base font-medium px-6 py-3 rounded-xl w-40 hover:bg-sky-400 transition">
                            Add to Cart
                        </button>
                    </form>

                    <button class="bg-sky-300 text-black text-base font-medium px-6 py-3 rounded-xl w-40 hover:bg-sky-400 transition">
                        Buy Now
                    </button>
                </div>
            </div>

            <!-- Right Side: Product Image -->
            <div class="w-1/2 flex justify-center items-center">
                <img src="" alt="Product Image" id="modal-product-image"
                    class="w-full max-h-80 md:max-h-[300px] rounded-xl object-contain" />
            </div>
        </div>
    </div>

    <script>
        function openProductModal(name, description, stock, price, imageUrl = '', id) {
            document.getElementById('modal-product-name').innerText = name;
            document.getElementById('modal-product-description').innerText = description;
            document.getElementById('modal-product-stock').innerText = 'Stock: ' + stock;
            document.getElementById('modal-product-price').innerText = '₱' + parseFloat(price).toFixed(2);
            document.getElementById('product_id').value = id;
            document.getElementById('wishlist_product_id').value = id;
            document.getElementById('modal-product-image').src = imageUrl || 'https://via.placeholder.com/500x650?text=No+Image';
            document.getElementById('product-modal').style.display = 'flex';

            // 🚫 Disable background scroll
            document.body.classList.add('no-scroll');
        }

        function closeProductModal() {
            document.getElementById('product-modal').style.display = 'none';

            // ✅ Re-enable background scroll
            document.body.classList.remove('no-scroll');
        }

        function showSuccess(title, message) {
            closeProductModal(); // Close modal first
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
        function showSuccess_cart(title, message,  productId = null) {
            closeProductModal();
            fetch('{{ route('cart.add') }}', {
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
        function showSuccess_wishlist(title, message,  productId = null) {
            closeProductModal(); // Close modal first
            fetch('{{ route('wishlist.add') }}', {
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
