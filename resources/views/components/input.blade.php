@props([
    'type' => 'text',
    'name',
    'label' => null,
    'value' => '',
    'placeholder' => '',
    'required' => false,
])

<link rel="stylesheet" href="/css/components/input.css">
<div class="form-group">
    @if($label)
        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    @endif
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        @if($required) required @endif
        {{ $attributes->merge(['class' => 'form-control']) }}
    >
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>