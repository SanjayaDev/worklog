<x-layouts.admin.app :title="$title" :breadcrumb="$breadcrumb">

  <div class="card">
    <div class="card-body">
      <form action="/dashboard/projects/{{ $project->id }}" method="POST">
        @csrf
        @method('PUT')

        @include('admin.projects.form')

        <button class="btn btn-success btn-sm mt-4">Update</button>

      </form>
    </div>
  </div>

</x-layouts.admin.app>