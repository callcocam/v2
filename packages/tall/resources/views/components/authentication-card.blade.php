<div class="min-h-100vh flex grow">
    <div class="fixed top-0 hidden p-6 lg:block lg:px-12">
        <a href="" class="flex items-center space-x-2">
            <img src="{{ asset('img/app-logo.svg') }}" alt="Logo" class="h-12 w-12">
            <p class="text-xl font-semibold uppercase text-slate-700 dark:text-navy-100">
                {{ config('app.name') }}
            </p>
        </a>
    </div>
    <div class="hidden w-full place-items-center lg:grid">
        <div class="w-full max-w-lg grow p-6">
            <img x-show="!$store.global.isDarkModeEnabled" class="w-full"
                src="{{ asset('img/illustrations/dashboard-check.svg') }}" alt="Image">
            <img x-show="$store.global.isDarkModeEnabled" class="w-full"
                src="{{ asset('img/illustrations/dashboard-check.svg') }}" alt="Image">
        </div>
    </div>
    <main class="flex w-full flex-col items-center bg-white dark:bg-navy-700 lg:max-w-md">
        <div class="flex w-full max-w-sm grow flex-col justify-center p-5">
            @isset($header)
                <div class="text-center">
                    <x-tall-authentication-card-logo />
                    <div class="mt-4">
                        <h2 class="text-2xl font-semibold text-slate-600 dark:text-navy-100">
                            {{ config('app.name') }}
                        </h2>
                        {{ $header }}
                    </div>
                </div>
            @endisset
            {{ $slot }}
        </div>
    </main>
</div>
