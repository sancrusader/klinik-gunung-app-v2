@props(['for', 'id'])

@php
    $defaultLabelClass = 'mb-2 text-sm text-start text-grey-900';
@endphp

<label for="{{ $for }}" class="{{ $attributes->get('class', $defaultLabelClass) }}">
    {{ $id }}
</label>
