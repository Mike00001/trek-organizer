<x-guest-layout class="flex items-center justify-center min-h-screen bg-green-700">
    <div class="w-full max-w-lg p-8 space-y-8 bg-white shadow-lg rounded-lg">
        <!-- Logo -->
        <div class="flex justify-center">
            <img src="{{ asset('images/logo.png') }}" alt="Trek Logo" class="w-120 h-100 mb-4">
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <h2 class="text-2xl font-bold text-center text-green-800">Welcome to TrekOrganiser</h2>
        <p class="text-center text-gray-600">Your adventure begins here. Please log in to your account.</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full border border-green-300 rounded-md focus:border-green-500 focus:ring focus:ring-green-200" 
                              type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full border border-green-300 rounded-md focus:border-green-500 focus:ring focus:ring-green-200" 
                              type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-green-300 text-green-600 shadow-sm focus:ring-green-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ms-3 bg-green-600 hover:bg-green-700">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
        
        <footer class="text-center text-gray-500 text-sm mt-4">
            © {{ date('Y') }} TrekOrganiser. All rights reserved ;)
        </footer>
    </div>
</x-guest-layout>
