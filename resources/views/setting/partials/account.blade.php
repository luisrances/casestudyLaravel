<div id="account" class="section px-4">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 sm:mb-0">Personal Info</h2>
    </div>

    {{-- <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control form-control-md" id="image" name="image">
        @if (!empty($account->image))
            <img src="{{ asset('storage/' . $account->image) }}" alt="Account Image" class="img-thumbnail mt-3" style="max-width: 150px;">
        @endif
    </div> --}}

    <div class="flex flex-col md:flex-row items-center gap-6 mb-4 border-b pb-4">
        <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center overflow-hidden shadow-inner">
            @if (!empty($account->image))
                <img src="{{ asset('storage/' . $account->image) }}" alt="Profile Photo" class="w-full h-full object-cover">
            @else
                <span class="text-gray-500 text-4xl">👤</span>
            @endif
        </div>
        <div class="flex flex-col items-center md:items-start">
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Profile Photo</h3>
            <div class="flex gap-4">
                <a href="#" class="text-blue-600 font-medium hover:underline text-sm">Upload new photo</a>
                <input type="file" class="form-control form-control-md" id="image" name="image">
                @if (!empty($account->image))
                    <img src="{{ asset('storage/' . $account->image) }}" alt="Account Image" class="img-thumbnail mt-3" style="max-width: 150px;">
                @endif
                <a href="#" class="text-red-500 font-medium hover:underline text-sm">Remove photo</a>
            </div>
        </div>
    </div>
    
    <form action="{{ route('account.update', $account) }}" method="POST" enctype="multipart/form-data" onsubmit="handleAccountSetting(event)">
        @csrf @method('PATCH')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 mb-4">
            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $account->first_name ?? '') }}" placeholder="Enter your first name" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3">
            </div>
            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $account->last_name ?? '') }}" placeholder="Enter your last name" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 mb-4"> {{-- Added mb-10 for spacing before buttons --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email', $account->email ?? '') }}" placeholder="Enter your email address" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" value="{{ old('password', $account->password ?? '') }}" placeholder="Enter password" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 bg-gray-100 cursor-not-allowed">
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-6 border-t">
            <button type="button" class="px-5 py-2 border border-blue-600 text-blue-600 font-semibold rounded-lg hover:bg-blue-50 transition duration-300 ease-in-out">
                Edit Profile
            </button>
            <button type="submit" class="px-5 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300 ease-in-out">
                Save Changes
            </button>
        </div>
    </form>
</div>