<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
             <x-home.logo
                    class="rounded-full w-20"
                    link-class="main-logo"
                    src="{{ asset('assets/images/logo/asli.png') }}"
                    alt="home-logo"
            />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400" dir="rtl">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}" dir="rtl">
            @csrf

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
