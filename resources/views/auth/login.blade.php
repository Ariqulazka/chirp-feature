<x-guest-layout>
    <!-- Heading -->
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6 transition-transform transform hover:scale-105 ease-in-out">{{ __('Login') }}</h2>

    <!-- Form -->
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input 
                id="email" 
                class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out transform hover:scale-105 focus:scale-105" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input 
                id="password" 
                class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out transform hover:scale-105 focus:scale-105" 
                type="password" 
                name="password" 
                required 
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center mb-6">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 transition duration-300 ease-in-out" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Submit Button -->
        <div class="mb-4">
            <button type="submit" class="w-full py-2 px-4 text-white bg-gray-700 rounded-md hover:bg-gray-600 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-300 ease-in-out transform hover:scale-105">
                {{ __('Log in') }}
            </button>
        </div>

        <!-- Forgot Password Link -->
        <div class="mb-4 text-center text-sm">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-gray-800 hover:text-indigo-800 underline transition duration-300 ease-in-out transform hover:scale-105">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <!-- Register Link -->
        <div class="text-center text-sm">
            <p class="text-gray-600">
                {{ __("Don't have an account?") }}
                <a href="{{ route('register') }}" class="text-gray-800 hover:text-indigo-800 underline transition duration-300 ease-in-out transform hover:scale-105">
                    {{ __('Create one') }}
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
