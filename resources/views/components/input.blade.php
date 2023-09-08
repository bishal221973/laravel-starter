<div class="form-group">
    @if ($label)
        <label>{{ $label }}</label>
    @endif
    <input class="form-control" type="{{ $type }}" placeholder="{{ $placeholder }}" name="{{ $name }}"
        id="{{ $id }}" {{ $required == 'true' ? 'required' : '' }} value="{{ $default ? $default : old($name) }}">
    @error($name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
