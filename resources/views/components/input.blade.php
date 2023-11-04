@props([
    'disabled' => false,
    'value' => '',
    'label' => '',
    'type' => '',
    'id' => '',
    'required' => false,
    'name' => '',
])

<div class="mb-4">
    <label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
        {{ $label }} {!! $required ? '<span class="text-sm text-danger">*</span>' : '' !!}
    </label>

    <input type="{{ $type }}" value="{{ $value }}" name="{{ $name }}" id="{{ $id }}"
        {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
            'class' =>
                'text-sm block mt-1 w-full border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 rounded-md shadow-sm',
        ]) !!} />

    @error($name)
        <small class="text-sm text-danger space-y-1">
            {{ $message }}
        </small>
    @enderror
</div>
