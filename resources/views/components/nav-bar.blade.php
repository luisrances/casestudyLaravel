<header class="fixed top-0 left-0 right-0 z-50 flex flex-wrap sm:justify-start sm:flex-nowrap w-full bg-white h-[87px] shadow ">
  <nav class="max-w-[85rem] w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between h-full">
    <div class="flex items-center justify-between h-full">
      <a class="flex-none focus:outline-hidden focus:opacity-80" href="#" aria-label="Brand">
        <img src="./Images/b-logo.png" alt="b-logo" width="120" height="80" class="object-contain" />
      </a>
      <div class="sm:hidden">
        <button type="button" class="hs-collapse-toggle relative size-9 flex justify-center items-center gap-x-2 rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" id="hs-navbar-example-collapse" aria-expanded="false" aria-controls="hs-navbar-example" aria-label="Toggle navigation" data-hs-collapse="#hs-navbar-example">
          <svg class="hs-collapse-open:hidden shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="6" y2="6"/><line x1="3" x2="21" y1="12" y2="12"/><line x1="3" x2="21" y1="18" y2="18"/></svg>
          <svg class="hs-collapse-open:block hidden shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
          <span class="sr-only">Toggle navigation</span>
        </button>
      </div>
    </div>
    <div id="hs-navbar-example" class="hidden hs-collapse overflow-hidden transition-all duration-300 basis-full grow sm:block" aria-labelledby="hs-navbar-example-collapse">
      <div class="flex flex-col gap-[50px] mt-5 sm:flex-row sm:items-center sm:mt-0 sm:ps-5 w-full h-full">
        <!-- Left-aligned links -->
        <div class="flex flex-col sm:flex-row gap-[50px] text-[18px]">
          <a class="font-medium text-gray-600 focus:outline-hidden" href="{{ route('Home') }}" aria-current="page">Home</a>
          <a class="font-medium text-gray-600 hover:text-gray-400 focus:outline-hidden focus:text-gray-400" href="{{ route('Shop') }}">Shop</a>
          <a class="font-medium text-gray-600 hover:text-gray-400 focus:outline-hidden focus:text-gray-400" href="{{ route('Feedback') }}">Feedback</a>
        </div>

        <!-- Right-aligned links -->
        <div class="flex flex-col sm:flex-row gap-[50px] sm:ml-auto text-[18px]">

          {{-- login design from breeze --}}
          @if (Route::has('login'))
            {{-- logged in --}}
            <nav class="flex items-center justify-end gap-4">
                @auth
                  <a href="{{ url('/dashboard') }}" class="flex items-center gap-2 font-medium text-gray-600 hover:text-gray-400 focus:outline-hidden focus:text-gray-400" href="#">
                    {{ Auth::check() ? Auth::user()->first_name . ' ' . Auth::user()->last_name : 'Account' }}
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                      <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                      <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                    </svg>
                  </a>
          @else
                  {{-- not logged in --}}
                  <a id="cart-button" class="mr-8 flex items-center gap-2 font-medium text-gray-600 hover:text-gray-400 focus:outline-hidden focus:text-gray-400" href="#">
                    Cart
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                      <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                    </svg>
                  </a>
                  <a href="{{ route('login') }}" class="flex items-center gap-2 font-medium text-gray-600 hover:text-gray-400 focus:outline-hidden focus:text-gray-400" href="#">
                    Account
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                      <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                      <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                    </svg>
                  </a>
                @endauth
            </nav>
          @endif
        </div>
      </div>
    </div>
  </nav>
</header>

<!-- Cart Modal -->
<div id="cart-modal" class="fixed inset-0 z-50  overflow-y-auto">
  <div id="cart-overlay" class="fixed inset-0 bg-black bg-opacity-50"></div>
  <div class="fixed top-0 right-0 bottom-0 w-full max-w-md bg-white shadow-lg transform transition-transform duration-300 ease-in-out">
      <div class="flex flex-col h-full">
          <!-- Header -->
          <div class="flex justify-between items-center p-4 border-b">
              <h2 class="text-lg font-medium">Your Cart</h2>
              <button id="close-cart" class="text-gray-400 hover:text-gray-500">
                  <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                  </svg>
              </button>
          </div>
          
          <!-- Empty cart message -->
          <div id="cart-empty" class="flex-1 flex flex-col items-center justify-center p-4">
              <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-cart text-gray-300 mb-4" viewBox="0 0 16 16">
                  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
              </svg>
              <p class="text-gray-500">Your cart is empty</p>
              <a href="/shop" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                  Start Shopping
              </a>
          </div>
          
          <!-- Cart content -->
          <div id="cart-content" class="hidden flex-1 flex flex-col">
              <!-- Cart items -->
              <div id="cart-items" class="flex-1 overflow-y-auto p-4">
                  <!-- Items will be inserted here by JavaScript -->
              </div>
              
              <!-- Cart footer -->
              <div class="p-4 border-t">
                  <div class="flex justify-between mb-4">
                      <span class="font-medium">Total:</span>
                      <span id="cart-total" class="font-bold"></span>
                  </div>
                  
                  <div class="flex flex-col space-y-2">
                      <a href="/checkout" class="px-4 py-2 bg-blue-600 text-white text-center rounded hover:bg-blue-700">
                          Proceed to Checkout
                      </a>
                      <a href="/cart" class="px-4 py-2 border border-gray-300 text-center rounded hover:bg-gray-50">
                          View Cart
                      </a>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
      const cartButton = document.getElementById('cart-button');
      const cartModal = document.getElementById('cart-modal');
      const cartOverlay = document.getElementById('cart-overlay');
      const closeCart = document.getElementById('close-cart');
      const cartContent = document.getElementById('cart-content');
      const cartEmpty = document.getElementById('cart-empty');
      const cartItems = document.getElementById('cart-items');
      const cartTotal = document.getElementById('cart-total');
  
      function getCart() {
          // For guests, use localStorage
          let cart = localStorage.getItem('cart');
          return cart ? JSON.parse(cart) : [];
      }
  
      function setCart(cart) {
          localStorage.setItem('cart', JSON.stringify(cart));
      }
  
      function renderCart() {
          const cart = getCart();
          if (cart.length === 0) {
              cartContent.classList.add('hidden');
              cartEmpty.classList.remove('hidden');
          } else {
              cartContent.classList.remove('hidden');
              cartEmpty.classList.add('hidden');
              cartItems.innerHTML = '';
              let total = 0;
              cart.forEach(item => {
                  total += item.price * item.quantity;
                  cartItems.innerHTML += `
                      <div class="flex justify-between items-center mb-2">
                          <div>
                              <div class="font-medium">${item.name}</div>
                              <div class="text-sm text-gray-500">Qty: ${item.quantity}</div>
                          </div>
                          <div class="font-bold">₱${(item.price * item.quantity).toFixed(2)}</div>
                      </div>
                  `;
              });
              cartTotal.textContent = `₱${total.toFixed(2)}`;
          }
      }
  
      cartButton.addEventListener('click', function (e) {
          e.preventDefault();
          cartModal.classList.remove('hidden');
          renderCart();
      });
  
      closeCart.addEventListener('click', function () {
          cartModal.classList.add('hidden');
      });
  
      cartOverlay.addEventListener('click', function () {
          cartModal.classList.add('hidden');
      });
  
      // Optional: update cart when localStorage changes (e.g., from another tab)
      window.addEventListener('storage', function (e) {
          if (e.key === 'cart') renderCart();
      });
  });
</script>