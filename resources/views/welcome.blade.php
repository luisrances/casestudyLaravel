<x-layout>
    <h1 class="font-bold text-[36px] mt-[20px]">Latest this week</h1>

    <div class="flex flex-col lg:flex-row gap-6">
        <div class="lg:w-2/3 w-full">
            <x-mainCaro />
        </div>

        <div class="lg:w-1/3 w-full flex flex-col gap-6">
            <div class="bg-gray-100 p-6 rounded-xl shadow">
                <h2 class="font-semibold text-xl mb-2">Big Sale!</h2>
                <p>Get up to 50% off selected items this week only.</p>
            </div>
            <div class="bg-gray-100 p-6 rounded-xl shadow">
                <h2 class="font-semibold text-xl mb-2">New Arrivals</h2>
                <p>Explore the newest additions to our shop.</p>
            </div>
            <div class="bg-gray-100 p-6 rounded-xl shadow">
                <h2 class="font-semibold text-xl mb-2">Upcoming Events</h2>
                <p>Don't miss our summer sale live stream on Friday!</p>
            </div>
        </div>
    </div>

    <div class="banner">
        <img src="./Images/Banner.png" alt="Banner" width="1568" height="240" class="mt-[35px] shadow-xl rounded-xl"/>
    </div>

    <div class="mt-[35px]">
        <h1 class="font-bold opacity-50 text-[36px]">Recommendation</h1>
        <p class="text-[22px]">Accessories</p>
        <x-subCaro></x-subCaro>
        <p class="text-[22px]">Accessories</p>
        <x-subCaro></x-subCaro>
        <p class="text-[22px]">Accessories</p>
        <x-subCaro></x-subCaro>
        <p class="text-[22px]">Accessories</p>
        <x-subCaro></x-subCaro>
    </div>
</x-layout>
