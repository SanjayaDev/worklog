<div class="row my-2 align-items-center">
  <div class="col-md-{{ $grid1 ?? 4 }}">
    <h5>{{ $label }}</h5>
  </div>
  <div class="col-md-{{ $grid2 ?? 8 }}">
    <textarea name="{{ $name }}" class="form-control" cols="30" rows="{{ $rows ?? 10 }}">{{ $value ?? '' }}</textarea>
    @error($name)
      <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>
</div>