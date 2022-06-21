<div class="row my-2 align-items-center">
  <div class="col-md-{{ $grid1 ?? 4 }}">
    <h5>{{ $label }}</h5>
  </div>
  <div class="col-md-{{ $grid2 ?? 8 }}">
    <input type="{{ $type ?? 'text' }}" class="form-control" name="{{ $name }}" value="{{ $value ?? '' }}" {{ $required ?? ''}}>
    @error($name)
      <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>
</div>