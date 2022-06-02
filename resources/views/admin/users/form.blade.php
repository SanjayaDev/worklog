<x-forms.input-group label="Name" name="name" value="{{ old('name') ?? $user->name ?? '' }}"></x-forms.input-group>

<x-forms.input-group label="Email" name="email" type="email" value="{{ old('email') ?? $user->email ?? '' }}"></x-forms.input-group>
<input type="hidden" name="id" value="{{ $user->id ?? '' }}">

<x-forms.input-group label="Password" name="password" type="password"></x-forms.input-group>

@if (Auth::user()->is_super_admin)
<div class="form-check">
  <input class="form-check-input" type="checkbox" name="is_super_admin" value="1" {{ isset($user->is_super_admin) && $user->is_super_admin == 1 ? "checked" : "" }}>
  <label class="form-check-label">Super Admin</label>
</div>
@endif