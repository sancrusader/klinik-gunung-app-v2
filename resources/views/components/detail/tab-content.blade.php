@props(['header', 'id', 'aria'])
<div {{ $attributes->merge(['class' => 'p-8 bg-gray-50 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 w-full']) }}
    id="{{ $id }}" role="tabpanel" aria-labelledby="{{ $aria }}">

    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">
        {{ $header }}
    </h3>

    {{ $slot }}
</div>
