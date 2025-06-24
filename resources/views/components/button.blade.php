<link rel="stylesheet" href="/css/components/button.css">

@props([
    'type' => 'button',
    'variant' => 'success'
])

<button type="{{ $type }}" {{ $attributes->merge(['class' => "btn btn-$variant"]) }}>
    {{ $slot }}
</button>