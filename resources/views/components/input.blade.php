@props(['label' => '', 'placeholder' => false, 'value'=>false, 'name' => '', 'type' => 'text', 'required' => false, 'readonly' => false, 'md' => 12])
<div id="input" class="mb-3 form-group col-md-{{$md}}">
    <label class="mb-2">{{ $label }}</label>
    <input class="form-control {{ $name }}" type="{{ $type }}" name="{{ $name }}" value="{{ $value }}"
        placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }}>
    <span id="{{ $name }}" class="text-danger d-none"></span>
</div>
