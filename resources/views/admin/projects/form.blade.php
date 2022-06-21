<x-forms.input-grid label="Project Name" name="project_name" value="{{ old('project_name') ?? $project->project_name ?? '' }}"></x-forms.input-grid>
<x-forms.textarea-grid label="Project Description" name="project_description" rows="5" value="{{ old('project_description') ?? $project->project_description ?? '' }}"></x-forms.textarea-grid>

<div class="row my-2 align-items-center">
  <div class="col-md-4">
    <h5>Owner User</h5>
  </div>
  <div class="col-md-8">
    <select name="owner_user" class="form-control">
      @foreach ($users as $user)
        @if (isset($project->owner_user))
          <option {{ $project->owner_user == $user->id ? 'checked' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
        @else
          <option {{ old('owner_user') == $user->id ? 'checked' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
        @endif
      @endforeach
    </select>
  </div>
</div>