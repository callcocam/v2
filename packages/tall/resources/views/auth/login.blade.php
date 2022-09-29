<x-tall-guest-layout>
    <x-tall-authentication-card>
        <x-slot name="header" class="text-center">
            <p class="text-slate-400 dark:text-navy-300">
                {{ __('Please sign in to continue') }}
            </p>
        </x-slot>
        <x-tall-validation-errors class="mb-4" />
        <form class="mt-16" action="{{ route('login') }}" method="POST">
            @csrf
            <div>
                <x-tall-label class="relative flex">
                    <x-tall-input placeholder="E-Mail Address" type="text" name="email"
                        value="{{ old('email') }}" />
                    <x-tall-icon-body>
                        <x-tall-icon name="mail" />
                    </x-tall-icon-body>
                </x-tall-label>
                <x-tall-error for="email" />
            </div>
            <div class="mt-4">
                <x-tall-label class="relative flex">
                    <x-tall-input placeholder="Password" type="password" name="password"
                        value="{{ old('password') }}" />
                    <x-tall-icon-body>
                        <x-tall-icon name="lock-closed" />
                    </x-tall-icon-body>
                </x-tall-label>
                <x-tall-error for="password" />
            </div>
            <div class="mt-4 flex items-center justify-between space-x-2">
                <x-tall-label class="inline-flex items-center space-x-2">
                    <x-tall-checkbox name="remember" value="{{ old('remember') }}">
                        <span class="line-clamp-1">{{ __('Remember me') }}</span>
                    </x-tall-checkbox>
                </x-tall-label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-xs text-slate-400 transition-colors line-clamp-1 hover:text-slate-800 focus:text-slate-800 dark:text-navy-300 dark:hover:text-navy-100 dark:focus:text-navy-100">
                        {{ __('Forgot Password?') }}
                    </a>
                @endif
            </div>
            <x-tall-button type="submit">
                {{ __('Sign In') }}
            </x-tall-button>
            @if (Route::has('register'))
                <div class="mt-4 text-center text-xs+">
                    <p class="line-clamp-1">
                        <span>{{ __('Dont have Account?') }}</span>
                        <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                            href="{{ route('register') }}">{{ __('Create account') }}</a>
                    </p>
                </div>
            @endif
        </form>
    </x-tall-authentication-card>
</x-tall-guest-layout>
