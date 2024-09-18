@props(['name'])

<dl class="grid grid-cols-[repeat(2,auto)] gap-x-4 w-max">
    <dt>{{ $name }}:</dt>
    <dd class="text-right text-gray-800 mb-2">{{ $slot }}</dd>
</dl>
