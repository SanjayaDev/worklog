<div class="form-group">
  <label>{{ $label }}</label>
  <input type="{{ $type ?? 'text' }}" class="form-control" name="{{ $name }}" id="{{ $idCustom ?? '' }}" value="{{ $value ?? '' }}">
  @error($name)
    <small class="text-danger">{{ $message }}</small>
  @enderror
</div>