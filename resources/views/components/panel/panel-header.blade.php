@props(['title'])

<div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between gap-2">
    <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
        {{ __($title) }}
    </h3>

    {{ $slot }}
</div>
