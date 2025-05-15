<x-layout>
    <!-- Feedback Textarea -->
    <div class="space-y-1 mb-4">
        <p class="text-gray-600 text-base">Your suggestion matters. What can we improve on?</p>
        <div class="relative w-[935px]">
            <textarea 
                maxlength="1000"
                class="w-full h-[175px] border border-gray-300 rounded-lg p-4 resize-none focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm"
                placeholder="Comment..."></textarea>
            <span class="absolute bottom-2 right-3 text-xs text-gray-400">0/1000</span>
        </div>
    </div>

    <!-- Image Upload Section -->
    <div class="space-y-2 mb-6">
        <p class="text-blue-600 text-sm">Upload images to help us understand more.</p>

        <label
            for="File"
            class="w-[300px] h-[200px] flex flex-col justify-center items-center text-center border-2 border-dashed border-gray-300 rounded-lg p-4 cursor-pointer hover:border-blue-400 transition">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M7.5 7.5h-.75A2.25 2.25 0 0 0 4.5 9.75v7.5a2.25 2.25 0 0 0 2.25 2.25h7.5a2.25 2.25 0 0 0 2.25-2.25v-7.5a2.25 2.25 0 0 0-2.25-2.25h-.75m0-3-3-3m0 0-3 3m3-3v11.25" />
            </svg>

            <p class="text-sm text-gray-600">Paste, Drag, or Click to upload<br>multiple images</p>
            <input id="File" name="images[]" type="file" class="sr-only" multiple />
        </label>
    </div>

    <!-- Submit Button -->
    <button
        type="submit"
        class="bg-purple-800 hover:bg-purple-900 text-white text-sm font-medium px-10 py-3 rounded-lg">
        Submit
    </button>
</x-layout>
