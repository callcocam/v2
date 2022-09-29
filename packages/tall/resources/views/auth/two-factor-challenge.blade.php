<x-tall-guest-layout>
    <x-tall-authentication-card>
        <x-slot name="header" class="text-center">
            <p class="text-slate-400 dark:text-navy-300">
                {{ __('Please sign in to continue') }}
            </p>
        </x-slot>
        <div x-data="{ recovery: false }">
            <div class="mb-4 text-sm text-gray-600" x-show="! recovery">
                {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
            </div>

            <div class="mb-4 text-sm text-gray-600" x-show="recovery">
                {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
            </div>

            <x-tall-validation-errors class="mb-4" />
            <form method="POST" action="{{ route('two-factor.login') }}">
                @csrf

                <div class="mt-4" x-show="! recovery">
                    <x-tall-label for="code" class="relative flex">
                        <x-tall-input id="code" type="text" inputmode="numeric" name="code" autofocus
                            x-ref="code" autocomplete="one-time-code" placeholder="{{ __('Code') }}" />
                    </x-tall-label>
                </div>

                <div class="mt-4" x-show="recovery">
                    <x-tall-label for="recovery_code" class="relative flex">
                        <x-tall-input id="recovery_code" type="text" name="recovery_code" x-ref="recovery_code"
                            autocomplete="one-time-code" placeholder="{{ __('Recovery Code') }}" />
                    </x-tall-label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-tall-button type="button" x-show="! recovery"
                        x-on:click="
                                    recovery = true;
                                    $nextTick(() => { $refs.recovery_code.focus() })
                                ">
                        {{ __('Use a recovery code') }}
                    </x-tall-button>

                    <x-tall-button type="button" x-show="recovery"
                        x-on:click="
                                    recovery = false;
                                    $nextTick(() => { $refs.code.focus() })
                                ">
                        {{ __('Use an authentication code') }}
                    </x-tall-button>
                </div>
            </form>
        </div>
    </x-tall-authentication-card>
</x-tall-guest-layout>
