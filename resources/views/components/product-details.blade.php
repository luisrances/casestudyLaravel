<div 
  id="product-modal" 
  class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden"
>
  <div class="bg-white w-full max-w-4xl p-6 rounded-lg relative">
    <button 
      onclick="closeModal()" 
      class="absolute top-3 right-3 text-2xl font-bold text-gray-700 hover:text-black"
    >&times;</button>

    <!-- Dynamic content goes here -->
    <div id="product-content"></div>
  </div>
</div>
