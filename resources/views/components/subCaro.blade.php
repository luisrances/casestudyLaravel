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
  <button type="button" class="hs-carousel-prev absolute top-1/2 -translate-y-1/2 -left-6 inline-flex justify-center items-center w-12 h-12 bg-white text-gray-600 hover:text-blue-500 hover:bg-blue-50 focus:outline-none focus:text-blue-500 focus:bg-blue-50 rounded-full shadow-lg hover:shadow-xl transition-colors duration-200 z-10">
    <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path d="m15 18-6-6 6-6" />
    </svg>
    <span class="sr-only">Previous</span>
  </button>

  <!-- Next Button -->
  <button type="button" class="hs-carousel-next absolute top-1/2 -translate-y-1/2 -right-6 inline-flex justify-center items-center w-12 h-12 bg-white text-gray-600 hover:text-blue-500 hover:bg-blue-50 focus:outline-none focus:text-blue-500 focus:bg-blue-50 rounded-full shadow-lg hover:shadow-xl transition-colors duration-200 z-10">
    <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path d="m9 18 6-6-6-6" />
    </svg>
    <span class="sr-only">Next</span>
  </button>

</div>