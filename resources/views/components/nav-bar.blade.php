<header
  class="fixed top-0 left-0 right-0 z-50 flex flex-wrap sm:justify-start sm:flex-nowrap w-full bg-white h-[87px] shadow ">
  <nav class="max-w-[85rem] w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between h-full">
    <div class="flex items-center justify-between h-full">
      <a class="flex-none focus:outline-hidden focus:opacity-80" href="#" aria-label="Brand">
        <img src="{{ asset('images/b-logo.png') }}" alt="Brand Logo" width="120" height="80" class="object-contain" />
      </a>
      <div class="sm:hidden shadow">
        <button type="button"
          class="hs-collapse-toggle relative size-9 flex justify-center items-center gap-x-2 rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
          id="hs-navbar-example-collapse" aria-expanded="false" aria-controls="hs-navbar-example"
          aria-label="Toggle navigation" data-hs-collapse="#hs-navbar-example">
          <svg class="hs-collapse-open:hidden shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round">
            <line x1="3" x2="21" y1="6" y2="6" />
            <line x1="3" x2="21" y1="12" y2="12" />
            <line x1="3" x2="21" y1="18" y2="18" />
          </svg>
          <svg class="hs-collapse-open:block hidden shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round">
            <path d="M18 6 6 18" />
            <path d="m6 6 12 12" />
          </svg>
          <span class="sr-only">Toggle navigation</span>
        </button>
      </div>
    </div>
    <div id="hs-navbar-example"
      class="hidden hs-collapse overflow-hidden transition-all duration-300 basis-full grow sm:block"
      aria-labelledby="hs-navbar-example-collapse">
      <div class="flex flex-col gap-[50px] mt-5 sm:flex-row sm:items-center sm:mt-0 sm:ps-5 w-full h-full">
        <!-- Left-aligned links -->
        <div class="flex flex-col sm:flex-row gap-[50px] text-[18px]">
          <a class="font-medium focus:outline-hidden {{ Route::currentRouteName() == 'Home' ? 'text-blue-600 font-bold' : 'text-gray-600 hover:text-gray-400' }}"
            href="{{ route('Home') }}" aria-current="page">Home</a>
          <a class="font-medium focus:outline-hidden {{ Route::currentRouteName() == 'Shop' ? 'text-blue-600 font-bold' : 'text-gray-600 hover:text-gray-400' }}"
            href="{{ route('Shop') }}">Shop</a>
          <a class="font-medium focus:outline-hidden {{ Route::currentRouteName() == 'Feedback' ? 'text-blue-600 font-bold' : 'text-gray-600 hover:text-gray-400' }}"
            href="{{ route('Feedback') }}">Feedback</a>
        </div>

        <!-- Right-aligned links -->
        <div class="flex flex-col sm:flex-row gap-[50px] sm:ml-auto text-[18px]">

          {{-- login design from breeze --}}
          @if (Route::has('login'))
            {{-- logged in --}}
            <nav class="flex items-center justify-end gap-4">
            @auth
            <a href="{{ route('cart.user') }}"
            class="relative mr-8 flex items-center gap-2 font-medium text-gray-600 hover:text-gray-400 focus:outline-hidden focus:text-gray-400"
            window.location.reload();>
            Cart
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cart"
            viewBox="0 0 16 16">
            <path
              d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
            </svg>
            @if(isset($cartCount) && $cartCount > 0)
            <span
            class="absolute -top-0 -right-2 bg-sky-300 text-white text-[10px] font-bold rounded-full w-4 h-4 flex items-center justify-center">
            {{ $cartCount }}
            </span>
          @endif
            </a>
            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
            class="flex items-center gap-2 font-medium text-gray-600 hover:text-gray-400 focus:outline-hidden focus:text-gray-400"
            type="button">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
            class="bi bi-person-circle" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
            <path fill-rule="evenodd"
              d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
            </svg>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdown" class="z-10 hidden bg-gray-100 rounded-lg shadow-sm w-48 p-2">
            <ul class="py-3 text-md text-black" aria-labelledby="dropdownDefaultButton">
            <li>
              <a href="{{ route('account.setting') }}"
              class="block px-4 py-3 text-base rounded-lg text-gray-700 hover:bg-gray-200">
              Account Settings
              </a>
            </li>
            {{-- <li>
              <a href="{{ route('purchase_history.user') }}"
              class="block px-4 py-3 text-base rounded-lg text-gray-700 hover:bg-gray-200">
              Purchase History
              </a>
            </li> --}}
            <li>
              <a href="{{ route('wishlist.user') }}"
              class="block px-4 py-3 text-base rounded-lg text-gray-700 hover:bg-gray-200">
              Wishlist
              </a>
            </li>
            <li>
              <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit"
              class="block w-full text-left px-4 py-3 text-base rounded-lg text-gray-700 hover:bg-gray-200">
              Log Out
              </button>
              </form>
            </li>
            </ul>
            </div>
          </div>
          @else
          {{-- not logged in --}}
          <a onclick="showLoginAlert()"
          class="mr-8 flex items-center gap-2 font-medium text-gray-600 hover:text-gray-400 focus:outline-hidden focus:text-gray-400"
          href="#">
          Cart
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart"
          viewBox="0 0 16 16">
          <path
            d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
          </svg>
          </a>
          <a href="{{ route('login') }}"
          class="flex items-center gap-2 font-medium text-gray-600 hover:text-gray-400 focus:outline-hidden focus:text-gray-400"
          href="#">
          Account
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle"
          viewBox="0 0 16 16">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
          <path fill-rule="evenodd"
            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
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