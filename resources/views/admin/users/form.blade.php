<x-forms.input-group label="Name" name="name" value="{{ old('name') ?? $user->name ?? '' }}"></x-forms.input-group>

<x-forms.input-group label="Email" name="email" type="email" value="{{ old('email') ?? $user->email ?? '' }}"></x-forms.input-group>
<input type="hidden" name="id" value="{{ $user->id ?? '' }}">

<x-forms.input-group label="Password" name="password" type="password"></x-forms.input-group>

@if (Auth::user()->role_id == 1)
  <div class="form-group">
    <label>Roles</label>
    <select name="role_id" class="form-control">
      @foreach ($roles as $role)
        <option @if(isset($user->role_id) && $user->role_id == $role->id) selected @endif value="{{ $role->id }}">{{ $role->role_name }}</option>
      @endforeach
    </select>
    @error('role_id')
      <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>
@endif