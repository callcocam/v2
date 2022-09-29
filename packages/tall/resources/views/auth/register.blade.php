<x-tall-guest-layout>
    <x-tall-authentication-card>
        <x-slot name="header" class="text-center">
            <p class="text-slate-400 dark:text-navy-300">
                {{ __(' Please sign up to continue') }}
            </p>
        </x-slot>
        <div class="mt-10 flex space-x-4">
            <button
                class="btn w-full space-x-3 border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90">
                <img class="h-5.5 w-5.5 " src="{{ asset('img/google.svg') }}" alt="logo" />
                <span>Google</span>
            </button>
            <button
                class="btn w-full space-x-3 border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90">
                <img class="h-5.5 w-5.5 " src="{{ asset('img/github.svg') }}" alt="logo" />
                <span>Github</span>
            </button>
        </div>
        <div class="my-7 flex items-center space-x-3">
            <div class="h-px flex-1 bg-slate-200 dark:bg-navy-500"></div>
            <p class="text-tiny+ uppercase">or sign up with email</p>

            <div class="h-px flex-1 bg-slate-200 dark:bg-navy-500"></div>
        </div>
        <x-tall-validation-errors class="mb-4" />
        <form class="mt-2" action="{{ route('register') }}" method="POST">
            @csrf
            <div>
                <x-tall-label class="relative flex">
                    <x-tall-input placeholder="{{ __('Name') }}" type="text" name="name"
                        value="{{ old('name') }}" />
                    <x-tall-icon-body>
                        <x-tall-icon name="user" />
                    </x-tall-icon-body>
                </x-tall-label>
                <x-tall-error for="email" />
            </div>
            <div class="mt-4">
                <x-tall-label class="relative flex">
                    <x-tall-input placeholder="{{ __('E-Mail Address') }}" type="text" name="email"
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

            <div class="mt-4">
                <x-tall-label class="relative flex">
                    <x-tall-input placeholder="Password" type="password" name="password_confirmation"
                        value="{{ old('password_confirmation') }}" />
                    <x-tall-icon-body>
                        <x-tall-icon name="lock-closed" />
                    </x-tall-icon-body>
                </x-tall-label>
                <x-tall-error for="password_confirmation" />
            </div>
            <div class="mt-4 flex items-center justify-between space-x-2">
                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <x-tall-label class="inline-flex items-center space-x-2">
                        <x-tall-checkbox name="terms" value="{{ old('terms') }}">
                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </x-tall-checkbox>
                    </x-tall-label>
                @endif
            </div>
            <x-tall-button type="submit">
                {{ __('Sign Up') }}
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
