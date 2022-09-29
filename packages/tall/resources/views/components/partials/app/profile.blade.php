<div :class="isShowPopper && 'show'" class="popper-root fixed" x-ref="popperRoot">
    <div
        class="popper-box w-64 rounded-lg border border-slate-150 bg-white shadow-soft dark:border-navy-600 dark:bg-navy-700">
        <div class="flex items-center space-x-4 rounded-t-lg bg-slate-100 py-5 px-4 dark:bg-navy-800">
            <div class="avatar h-14 w-14">
                <img class="rounded-full" src="{{ auth()->user()->profile_photo_url }}" alt="avatar" />
            </div>
            <div>
                <a href="{{ route('admin.profile.view')}}"
                    class="text-base font-medium text-slate-700 hover:text-primary focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light">
                    Travis Fuller
                </a>
                <p class="text-xs text-slate-400 dark:text-navy-300">
                    Product Designer
                </p>
            </div>
        </div>
        <div class="flex flex-col pt-2 pb-5">
            @if ($r = isRoute('admin.profile.view'))
                <a href="{{ $r }}"
                    class="group flex items-center space-x-3 py-2 px-4 tracking-wide outline-none transition-all hover:bg-slate-100 focus:bg-slate-100 dark:hover:bg-navy-600 dark:focus:bg-navy-600">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-warning text-white">
                        <x-tall-icon name="user" />
                    </div>
                    <div>
                        <h2
                            class="font-medium text-slate-700 transition-colors group-hover:text-primary group-focus:text-primary dark:text-navy-100 dark:group-hover:text-accent-light dark:group-focus:text-accent-light">
                            {{ __('Profile') }}
                        </h2>
                        <div class="text-xs text-slate-400 line-clamp-1 dark:text-navy-300">
                            {{ __('Your profile setting') }}
                        </div>
                    </div>
                </a>
            @endif
            @if ($r = isRoute('admin.users'))
                <a href="{{ isRoute('admin.users') }}"
                    class="group flex items-center space-x-3 py-2 px-4 tracking-wide outline-none transition-all hover:bg-slate-100 focus:bg-slate-100 dark:hover:bg-navy-600 dark:focus:bg-navy-600">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-secondary text-white">
                        <x-tall-icon name="user-group" />
                    </div>

                    <div>
                        <h2
                            class="font-medium text-slate-700 transition-colors group-hover:text-primary group-focus:text-primary dark:text-navy-100 dark:group-hover:text-accent-light dark:group-focus:text-accent-light">
                            {{ __('Team') }}
                        </h2>
                        <div class="text-xs text-slate-400 line-clamp-1 dark:text-navy-300">
                            {{ __('Your team activity') }}
                        </div>
                    </div>
                </a>
            @endif
            @if ($r = isRoute('admin.roles'))
                <a href="{{ $r }}"
                    class="group flex items-center space-x-3 py-2 px-4 tracking-wide outline-none transition-all hover:bg-slate-100 focus:bg-slate-100 dark:hover:bg-navy-600 dark:focus:bg-navy-600">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-error text-white">
                        <x-tall-icon name="chart-bar" />
                    </div>

                    <div>
                        <h2
                            class="font-medium text-slate-700 transition-colors group-hover:text-primary group-focus:text-primary dark:text-navy-100 dark:group-hover:text-accent-light dark:group-focus:text-accent-light">
                            {{ __('Access') }}
                        </h2>
                        <div class="text-xs text-slate-400 line-clamp-1 dark:text-navy-300">
                            {{ __('Action control list') }}
                        </div>
                    </div>
                </a>
            @endif
            @if ($r = isRoute('admin.permissions'))
                <a href="#"
                    class="group flex items-center space-x-3 py-2 px-4 tracking-wide outline-none transition-all hover:bg-slate-100 focus:bg-slate-100 dark:hover:bg-navy-600 dark:focus:bg-navy-600">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-info text-white">
                        <x-tall-icon name="message" />
                    </div>
                    <div>
                        <h2
                            class="font-medium text-slate-700 transition-colors group-hover:text-primary group-focus:text-primary dark:text-navy-100 dark:group-hover:text-accent-light dark:group-focus:text-accent-light">
                            {{ __('Permissions') }}
                        </h2>
                        <div class="text-xs text-slate-400 line-clamp-1 dark:text-navy-300">
                            {{ __(' Your permissions and tasks') }}
                        </div>
                    </div>
                </a>
            @endif
            @if ($r = isRoute('admin.tenants'))
                <a href="{{ $r }}"
                    class="group flex items-center space-x-3 py-2 px-4 tracking-wide outline-none transition-all hover:bg-slate-100 focus:bg-slate-100 dark:hover:bg-navy-600 dark:focus:bg-navy-600">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-success text-white">
                        <x-tall-icon name="cog" />
                    </div>

                    <div>
                        <h2
                            class="font-medium text-slate-700 transition-colors group-hover:text-primary group-focus:text-primary dark:text-navy-100 dark:group-hover:text-accent-light dark:group-focus:text-accent-light">
                            {{ __('Settings') }}
                        </h2>
                        <div class="text-xs text-slate-400 line-clamp-1 dark:text-navy-300">
                            {{ __(' Webapp settings') }}
                        </div>
                    </div>
                </a>
            @endif

            <div class="mt-3 px-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="btn h-9 w-full space-x-2 bg-primary text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                        <x-tall-icon name="logout" />
                        <span>Logout</span>
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
