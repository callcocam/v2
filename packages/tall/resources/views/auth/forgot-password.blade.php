<x-tall-guest-layout>
    <x-tall-authentication-card>
        <x-slot name="header" class="text-center">
            <p class="text-slate-400 dark:text-navy-300">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </p>
        </x-slot>
        <x-tall-validation-errors class="mb-4" />
        <form class="mt-8" action="{{ route('password.email') }}" method="POST">
            @csrf
            <div>
                <x-tall-label class="relative flex">
                    <x-tall-input placeholder="E-Mail Address" type="text" name="email" value="{{ old('email') }}" />
                    <x-tall-icon-body>
                        <x-tall-icon name="mail" />
                    </x-tall-icon-body>
                </x-tall-label>
                <x-tall-error for="email" />
            </div>
            <x-tall-button type="submit">
                {{ __('Email Password Reset Link') }}
            </x-tall-button>
            <div class="mt-4 text-center text-xs+">
                <p class="line-clamp-1">
                    <span> {{ __('Already registered?') }} </span>
                    <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                        href="{{ route('login') }}">Sign In</a>
                </p>
            </div>
        </form>
    </x-tall-authentication-card>
</x-tall-guest-layout>
