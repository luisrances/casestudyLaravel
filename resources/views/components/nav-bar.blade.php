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
          <a class="font-medium text-blue-500 focus:outline-hidden" href="#" aria-current="page">Home</a>
          <a class="font-medium text-gray-600 hover:text-gray-400 focus:outline-hidden focus:text-gray-400" href="#">Shop</a>
          <a class="font-medium text-gray-600 hover:text-gray-400 focus:outline-hidden focus:text-gray-400" href="#">Feedback</a>
        </div>

        <!-- Right-aligned links -->
        <div class="flex flex-col sm:flex-row gap-[50px] sm:ml-auto text-[18px]">
          <a class="flex items-center gap-2 font-medium text-gray-600 hover:text-gray-400 focus:outline-hidden focus:text-gray-400" href="#">
            Cart
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 7M7 13l-2 9m13-9l2 9m-5-9V6a2 2 0 00-4 0v3" />
            </svg>
          </a>

          <a class="flex items-center gap-2 font-medium text-gray-600 hover:text-gray-400 focus:outline-hidden focus:text-gray-400" href="#">
            Account
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A4 4 0 017 17h10a4 4 0 011.879.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
          </a>
        </div>
      </div>
    </div>
  </nav>
</header>
