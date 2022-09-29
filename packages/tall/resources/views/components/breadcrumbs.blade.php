@props(['link'=>"Listar",'title'=>config('app.name'),'active','href'])
<div class="flex items-center space-x-4 py-5 lg:py-6">
    <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
        {{ $title }}
    </h2>
    <div class="hidden h-full py-1 sm:flex">
        <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
    </div>
    <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
        <li class="flex items-center space-x-2">
            @isset($href)
                <a  href="{{ $href }}"
                    {{ $attributes->merge([
                        'class' => 'text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent',
                    ]) }}>{{ $link }}</a>
            @endisset
            <x-tall-icon name="pipe" class="h-3 w-3" />
        </li>
        <li>{{ $active }}</li>
    </ul>
</div>
