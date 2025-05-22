<x-layout>
  <div class="shopcont h-screen flex overflow-hidden">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r p-6 h-full overflow-y-auto">
      <h2 class="text-2xl font-bold mb-4">Categories</h2>

      <div class="space-y-4" id="sidebar-nav">
        <!-- Accessories -->
        <div>
          <h3 class="text-lg font-semibold">Accessories</h3>
          <ul class="ml-4 border-l-2 border-blue-400 pl-2 space-y-1">
            <li><a href="#attachments" class="nav-link text-sm block">Attachments</a></li>
            <li><a href="#apparel" class="nav-link text-sm block">Apparel</a></li>
            <li><a href="#gear" class="nav-link text-sm block">Gear</a></li>
          </ul>
        </div>

        <!-- Parts -->
        <div>
          <h3 class="text-lg font-semibold">Parts</h3>
          <ul class="ml-4 border-l-2 border-blue-400 pl-2 space-y-1">
            <li><a href="#cockpit" class="nav-link text-sm block">Cockpit</a></li>
            <li><a href="#drivetrain" class="nav-link text-sm block">Drivetrain</a></li>
            <li><a href="#braking-system" class="nav-link text-sm block">Braking System</a></li>
            <li><a href="#wheels-tires" class="nav-link text-sm block">Wheels & Tires</a></li>
            <li><a href="#frame-fork" class="nav-link text-sm block">Frame & Fork</a></li>
            <li><a href="#seating-area" class="nav-link text-sm block">Seating Area</a></li>
          </ul>
        </div>

        <!-- Tools -->
        <div>
          <h3 class="text-lg font-semibold">Tools</h3>
          <ul class="ml-4 border-l-2 border-blue-400 pl-2 space-y-1">
            <li><a href="#tools" class="nav-link text-sm block">Tools</a></li>
          </ul>
        </div>

        <!-- Bikes -->
        <div>
          <h3 class="text-lg font-semibold">Bikes</h3>
          <ul class="ml-4 border-l-2 border-blue-400 pl-2 space-y-1">
            <li><a href="#mtb" class="nav-link text-sm block">MTB</a></li>
            <li><a href="#time-trial" class="nav-link text-sm block">Time Trial</a></li>
            <li><a href="#road-bike" class="nav-link text-sm block">Road Bike</a></li>
            <li><a href="#gravel-bike" class="nav-link text-sm block">Gravel Bike</a></li>
          </ul>
        </div>
      </div>
    </aside>

    <!-- Card -->
    <main id="main-content" class="flex-1 overflow-y-auto p-8 space-y-10 h-screen scroll-smooth">
      @foreach ($products as $category => $categoryProducts)
      <section id="{{ $category }}" class="scroll-mt-32">
        <h2 class="text-2xl font-bold capitalize mb-4">{{ str_replace('-', ' ', $category) }}</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
          @foreach ($categoryProducts as $product)
          <div class="bg-white shadow-md rounded-xl overflow-hidden">
            <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://via.placeholder.com/300x200?text=' . ucfirst($category) }}" alt="" class="w-full h-40 object-cover">
            <div class="p-4">
              <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
              <p class="text-sm text-gray-600 truncate" title="{{ $product->description }}">{{ $product->description }}</p>
              <p class="text-blue-600 font-semibold mt-2">Php {{ number_format($product->price, 2) }}</p>
              <p class="text-sm mt-1 {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                Stock: {{ $product->stock > 0 ? $product->stock : 'Out of Stock' }}
              </p>
              <button
                class="mt-2 inline-block text-sm bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600"
                onclick="openProductModal(
                      '{{ addslashes($product->name) }}',
                      `{{ addslashes($product->description) }}`,
                      {{ $product->stock }},
                      {{ $product->price }},
                      '{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://via.placeholder.com/300x200?text=' . ucfirst($category) }}',
                      {{ $product->id }}
                    )">
                View Details
              </button>
            </div>
          </div>
          @endforeach
        </div>
      </section>
      @endforeach
    </main>
  </div>

  <!-- Modal -->
  {{-- <div id="product-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-6 rounded-lg max-w-3xl w-full max-h-3xl h-full relative">
      <button class="absolute top-2 right-2 text-xl" onclick="document.getElementById('product-modal').classList.add('hidden')">&times;</button>
      <div id="product-content"></div>
    </div>
  </div> --}}

  {{-- <script>
    function openModal(data) {..}
  </script> --}}

  <script>
    // Scroll Spy Script
    document.addEventListener('DOMContentLoaded', function() {
      const mainContent = document.getElementById('main-content');
      const sections = mainContent.querySelectorAll('section');
      const navLinks = document.querySelectorAll('.nav-link');

      function onScroll() {
        let currentSection = '';
        let minOffset = Number.POSITIVE_INFINITY;

        sections.forEach(section => {
          const offset = Math.abs(section.getBoundingClientRect().top - mainContent.getBoundingClientRect().top - 100);
          if (offset < minOffset) {
            minOffset = offset;
            currentSection = section.id;
          }
        });

        navLinks.forEach(link => {
          link.classList.remove('text-blue-600', 'font-bold');
          if (link.getAttribute('href') === '#' + currentSection) {
            link.classList.add('text-blue-600', 'font-bold');
          }
        });
      }


      mainContent.addEventListener('scroll', onScroll);
      onScroll();

      navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
          e.preventDefault();
          const id = this.getAttribute('href').substring(1);
          const target = document.getElementById(id);

          if (target) {
            const containerTop = mainContent.getBoundingClientRect().top;
            const targetTop = target.getBoundingClientRect().top;
            const scrollOffset = targetTop - containerTop + mainContent.scrollTop - 16;

            mainContent.scrollTo({
              top: scrollOffset,
              behavior: 'smooth'
            });
          }
        });
      });
    });
  </script>
</x-layout>