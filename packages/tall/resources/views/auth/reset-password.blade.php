<x-tall-guest-layout>
    <x-tall-authentication-card>
        <x-slot name="header" class="text-center">
           
            <p class="text-slate-400 dark:text-navy-300">
                {{ __(' Please enter your new password to continue') }}
            </p>
        </x-slot>
        <x-tall-validation-errors class="mb-4" />
        <form class="mt-2" action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div class="mt-4">
                <x-tall-label class="relative flex">
                    <x-tall-input placeholder="{{ __('E-Mail Address') }}" type="text" name="email"
                        value="{{ old('email', $request->email) }}" />
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
            <x-tall-button type="submit">
                {{ __('Reset Password') }}
            </x-tall-button>
        </form>
    </x-tall-authentication-card>
</x-tall-guest-layout>
