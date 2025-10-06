<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Forgot Password?</h2>
        <p class="text-sm text-gray-600 mt-2">No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" autocomplete="off">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="off" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 rounded-lg px-6 py-2">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>

        <div class="text-center mt-6 pt-6 border-t border-gray-200">
            <a href="{{ route('login') }}" class="inline-flex items-center text-sm text-indigo-600 hover:text-indigo-800">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to login
            </a>
        </div>
    </form>
</x-guest-layout>