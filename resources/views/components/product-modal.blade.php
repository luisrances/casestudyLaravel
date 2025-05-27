<!-- Product Modal -->
<div class="fixed inset-0 bg-black bg-opacity-20 flex items-center justify-center z-50" id="product-modal" style="display: none;">
  <div class="bg-white rounded-2xl shadow-xl p-6 w-[1140px] h-[770px] overflow-y-auto relative">
    <!-- Close Button -->
    <button onclick="closeProductModal()"
            class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-2xl font-bold">
      &times;
    </button>

    <!-- Product Content -->
    <div class="flex flex-col justify-between h-full">
      <div>
        <h2 class="text-3xl font-bold mb-4" id="modal-product-name">Product Name</h2>
        <p class="text-gray-600 mb-4" id="modal-product-description">Product description goes here.</p>
        <div class="flex items-center space-x-8 mb-6">
          <span class="text-green-600 font-semibold" id="modal-product-stock">Stock: 0</span>
          <span class="text-xl font-bold text-blue-700" id="modal-product-price">₱0.00</span>
        </div>
      </div>

      <div class="flex space-x-4 mt-auto">
        <button class="bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 transition">Buy Now</button>
        <button class="bg-yellow-500 text-white px-6 py-3 rounded-xl hover:bg-yellow-600 transition">Add to Cart</button>
        <button class="bg-gray-300 text-gray-800 px-6 py-3 rounded-xl hover:bg-gray-400 transition">Wishlist</button>
      </div>
    </div>
  </div>
</div>
