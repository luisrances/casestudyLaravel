<x-guest-layout>
    <!-- Heading Section -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <div class="mb-6 text-left">
        <h1 class="text-2xl font-bold text-gray-800">Welcome back!</h1>
        <p class="text-sm text-gray-600">Discover your perfect pace, GoPedal with us.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="email" placeholder="Email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" placeholder="Password"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Forgot Password and Sign Up Links -->
        <div class="flex justify-between mt-4">
            @if (Route::has('password.request'))
                <a class="text-sm text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
            <a class="text-sm text-blue-600 hover:text-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500" href="{{ route('register') }}">
                {{ __('Sign Up') }}
            </a>
        </div>

        <!-- Centered Login Button -->
        <div class="mt-6">
            <x-primary-button class="w-full bg-sky-500 hover:bg-sky-600 text-white py-3 text-lg rounded-md text-center justify-center">
                {{ __('Log In') }}
            </x-primary-button>
        </div>

        <!-- Or Connect With Section with Lines -->
        <div class="flex items-center my-4 text-center text-sm text-gray-600">
            <div class="flex-grow border-t border-gray-400"></div>
            <span class="mx-4">Or connect with</span>
            <div class="flex-grow border-t border-gray-400"></div>
        </div>

        <!-- Social Media or Third-party Login Buttons -->
        <div class="flex justify-between space-x-2">
            <!-- Facebook Button (Blue) -->
            <button class="w-full py-3 border border-blue-600 text-blue-600 flex items-center justify-center rounded-md hover:border-blue-800">
                <i class="fab fa-facebook-f text-xl"></i>
            </button>

                        <!-- Google Button (Red) -->
            <button class="w-full py-3 border border-red-600 text-red-600 flex items-center justify-center rounded-md hover:border-red-800">
                <i class="fab fa-google text-xl"></i>
            </button>
        </div>
    </form>
</x-guest-layout>
