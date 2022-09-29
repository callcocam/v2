<x-tall-guest-layout>
    <x-tall-authentication-card>
        <x-slot name="header" class="text-center">
            <p class="text-slate-400 dark:text-navy-300">
                {{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </p>
        </x-slot>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
            </div>
        @endif
        <form class="mt-16" action="{{ route('verification.send') }}" method="POST">
            @csrf

            <x-tall-button type="submit">
                {{ __('Resend Verification Email') }}
            </x-tall-button>
        </form>
        <div class="mt-4 text-center text-xs+">
            <p class="line-clamp-1">
                <a href="{{ route('profile.show') }}" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Edit Profile') }}</a>

            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 ml-2">
                    {{ __('Log Out') }}
                </button>
            </form>
            </p>
        </div>
    </x-tall-authentication-card>
</x-tall-guest-layout>
