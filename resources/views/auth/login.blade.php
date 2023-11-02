<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <x-input id="email" label="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}"
            required />
        <x-input id="password" label="{{ __('Password') }}" type="password" name="password" required
            autocomplete="current-password" />

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif

            <div class="ml-3">
                <x-button id="login" label="{{ __('Masuk') }}" type="submit" />
            </div>
        </div>
    </form>
</x-guest-layout>
