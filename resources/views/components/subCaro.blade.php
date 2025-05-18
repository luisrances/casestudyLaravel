<!-- Slider -->
<div data-hs-carousel='{
  "loadingClasses": "opacity-0",
  "dotsItemClasses": "hs-carousel-active:bg-blue-700 hs-carousel-active:border-blue-700 size-3 border border-gray-400 rounded-full cursor-pointer dark:border-neutral-600 dark:hs-carousel-active:bg-blue-500 dark:hs-carousel-active:border-blue-500",
  "slidesQty": {
    "xs": 1,
    "lg": 3
  }
}' class="relative">
  <div class="hs-carousel w-full h-[190px] overflow-hidden bg-white rounded-lg">
    <div class="relative min-h-72 -mx-1">
      <div class="hs-carousel-body absolute top-0 bottom-0 start-0 flex flex-nowrap opacity-0 transition-transform duration-700">

        <div class="hs-carousel-slide px-1">
          <div onclick="openProductModal('First Product', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 20, 999.99)"
            class="flex justify-center h-full bg-[#d9d9d9] p-6 cursor-pointer hover:bg-[#c5c5c5] transition">
            <span class="self-center text-sm text-black-800">First Product</span>
          </div>
        </div>

        <div class="hs-carousel-slide px-1">
          <div onclick="openProductModal('Second Product', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 12, 749.99)"
            class="flex justify-center h-full bg-[#d9d9d9] p-6 cursor-pointer hover:bg-[#c5c5c5] transition">
            <span class="self-center text-sm text-black-800">Second Product</span>
          </div>
        </div>

        <div class="hs-carousel-slide px-1">
          <div onclick="openProductModal('Third Product', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 5, 499.99)"
            class="flex justify-center h-full bg-[#d9d9d9] p-6 cursor-pointer hover:bg-[#c5c5c5] transition">
            <span class="self-center text-sm text-black-800">Third Product</span>
          </div>
        </div>

        <div class="hs-carousel-slide px-1">
          <div onclick="openProductModal('Fourth Product', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 8, 299.99)"
            class="flex justify-center h-full bg-[#d9d9d9] p-6 cursor-pointer hover:bg-[#c5c5c5] transition">
            <span class="self-center text-sm text-black-800">Fourth Product</span>
          </div>
        </div>

        <div class="hs-carousel-slide px-1">
          <div onclick="openProductModal('Fifth Product', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 15, 899.99)"
            class="flex justify-center h-full bg-[#d9d9d9] p-6 cursor-pointer hover:bg-[#c5c5c5] transition">
            <span class="self-center text-sm text-black-800">Fifth Product</span>
          </div>
        </div>

        <div class="hs-carousel-slide px-1">
          <div onclick="openProductModal('Sixth Product', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 0, 199.99)"
            class="flex justify-center h-full bg-[#d9d9d9] p-6 cursor-pointer hover:bg-[#c5c5c5] transition">
            <span class="self-center text-sm text-black-800">Sixth Product</span>
          </div>
        </div>

      </div>
    </div>
  </div>

  <button type="button" class="hs-carousel-prev hs-carousel-disabled:opacity-50 hs-carousel-disabled:pointer-events-none absolute inset-y-0 start-0 inline-flex justify-center items-center w-11.5 h-full text-gray-800 hover:bg-gray-800/10 focus:outline-hidden focus:bg-gray-800/10 rounded-s-lg dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
    <span class="text-2xl" aria-hidden="true">
      <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m15 18-6-6 6-6"></path>
      </svg>
    </span>
    <span class="sr-only">Previous</span>
  </button>
  <button type="button" class="hs-carousel-next hs-carousel-disabled:opacity-50 hs-carousel-disabled:pointer-events-none absolute inset-y-0 end-0 inline-flex justify-center items-center w-11.5 h-full text-gray-800 hover:bg-gray-800/10 focus:outline-hidden focus:bg-gray-800/10 rounded-e-lg dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
    <span class="sr-only">Next</span>
    <span class="text-2xl" aria-hidden="true">
      <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m9 18 6-6-6-6"></path>
      </svg>
    </span>
  </button>
</div>
<!-- End Slider -->