@props(['label' => '', 'name' => '', 'required' => false, 'md' => 12])
<div class="mb-3 form-group col-md-{{$md}}">
    <label class="mb-2">{{ $label }}</label>
    <select name="{{$name}}" class="form-select"> 
        {{ $slot }}
    </select>
    <span id="{{ $name }}" class="text-danger d-none"></span>
</div>
