@props(['type' => 'text', 'name', 'placeholder'])

<input type="{{ $type }}" name="{{ $name }}" placeholder="{{ $placeholder }}"
    {{ $attributes->class(['flex border items-center w-full px-5 py-4 mr-2 text-sm font-medium outline-none focus:bg-grey-400 mb-7 placeholder:text-grey-700 bg-grey-200 text-dark-grey-900 rounded-2xl']) }} />
