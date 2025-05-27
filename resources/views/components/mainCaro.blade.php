<!-- Slider -->
<div data-hs-carousel='{
    "loadingClasses": "opacity-0",
    "dotsItemClasses": "hs-carousel-active:bg-blue-700 hs-carousel-active:border-blue-700 size-3 border border-gray-400 rounded-full cursor-pointer",
    "isAutoPlay": true
  }' class="relative">
  <div class="hs-carousel relative overflow-hidden w-full min-h-96 bg-white rounded-lg">
    <div class="hs-carousel-body absolute top-0 bottom-0 start-0 flex flex-nowrap transition-transform duration-700 opacity-0">
      @foreach ($products as $product)
      <div class="hs-carousel-slide w-full flex justify-center items-center">
        <div class="bg-gray-100 rounded-lg shadow w-full h-full flex items-center justify-center">
          <img src="{{ asset('storage/' . $product->image_path) }}" alt="Product Image" class="max-w-full object-contain rounded">
        </div>
      </div>
      @endforeach
    </div>
  </div>

  <button type="button" class="hs-carousel-prev absolute inset-y-0 start-0 w-11.5 text-gray-800 hover:bg-gray-800/10">
    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path d="m15 18-6-6 6-6"></path>
    </svg>
  </button>

  <button type="button" class="hs-carousel-next absolute inset-y-0 end-0 w-11.5 text-gray-800 hover:bg-gray-800/10">
    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path d="m9 18 6-6-6-6"></path>
    </svg>
  </button>

  <div class="hs-carousel-pagination flex justify-center absolute bottom-3 start-0 end-0 gap-x-2"></div>
</div>
<!-- End Slider -->
