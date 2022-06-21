<div class="form-group">
  <label>{{ $label }}</label>
  <textarea name="{{ $name }}" class="form-control" cols="30" rows="{{ $rows ?? 10 }}">{{ $value ?? '' }}</textarea>
</div>