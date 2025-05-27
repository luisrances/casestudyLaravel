<!-- Dynamic SubCaro Carousel -->
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

        @foreach ($products as $product)
        <div class="hs-carousel-slide px-1">
          @if ($product)
          <a href="{{ route('Shop') }}#{{ Str::slug($product->category) }}" class="block w-full h-full">
            <div class="flex justify-center items-center h-full bg-[#d9d9d9] cursor-pointer hover:bg-[#c5c5c5] transition rounded-md overflow-hidden">
              <img src="{{ asset('storage/' . $product->image_path) }}"
                alt="{{ $product->name }}"
                class="object-cover h-full w-full rounded-md" />
            </div>
          </a>
          @else
          <div class="flex justify-center items-center h-full bg-[#f0f0f0] text-gray-400 text-sm font-medium italic p-4 rounded-md">
            No available product
          </div>
          @endif
        </div>
        @endforeach

      </div>
    </div>
  </div>

  <!-- Prev Button -->
  <button type="button" class="hs-carousel-prev absolute inset-y-0 start-0 inline-flex justify-center items-center w-11.5 h-full text-gray-800 hover:bg-gray-800/10 focus:outline-hidden focus:bg-gray-800/10 rounded-s-lg dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
    <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path d="m15 18-6-6 6-6" />
    </svg>
    <span class="sr-only">Previous</span>
  </button>

  <!-- Next Button -->
  <button type="button" class="hs-carousel-next absolute inset-y-0 end-0 inline-flex justify-center items-center w-11.5 h-full text-gray-800 hover:bg-gray-800/10 focus:outline-hidden focus:bg-gray-800/10 rounded-e-lg dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
    <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path d="m9 18 6-6-6-6" />
    </svg>
    <span class="sr-only">Next</span>
  </button>
</div>