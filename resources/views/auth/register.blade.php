<x-guest-layout>
            <!-- Form Section -->
            <div class="max-w-xl mx-auto mt-6">
                <!-- Heading Section -->
                <div class="mb-6 text-left">
                    <h1 class="text-2xl font-bold text-gray-800">Welcome cyclist!</h1>
                    <p class="text-sm text-gray-600">Find the perfect pace, GoPedal with us.</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- First and Last Name in one row -->
                    <div class="flex flex-col md:flex-row md:space-x-4">
                        <!-- First Name -->
                        <div class="w-full md:w-1/2">
                            <x-input-label for="first_name" :value="__('')" />
                            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" placeholder="First Name" />
                            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                        </div>

                        <!-- Last Name -->
                        <div class="w-full md:w-1/2 mt-4 md:mt-0">
                            <x-input-label for="last_name" :value="__('')" />
                            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autocomplete="last_name" placeholder="Last Name" />
                            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="Password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Centered Create Account Button -->
                    <div class="mt-6">
                        <x-primary-button class="w-full bg-sky-500 hover:bg-sky-600 text-white py-3 text-lg rounded-md text-center justify-center">
                            {{ __('Create Account') }}
                        </x-primary-button>
                    </div>

                    <!-- Right-aligned Login Link -->
                    <div class="flex justify-end mt-4">
                        <span class="text-sm text-gray-600">Already have an account?
                            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
