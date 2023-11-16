@props(['label' => '', 'placeholder' => false, 'name' => '', 'type' => '', 'required' => false, 'cols' => '', 'rows' => ''])
<div id="input" class="mb-3 form-group col-md-12">
    <label class="mb-2">{{ $label }}</label>
    <textarea class="form-control {{ $name }}" name="{{ $name }}" cols="{{ $cols }}" rows="{{ $rows }}"
        placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }}></textarea>
</div>
