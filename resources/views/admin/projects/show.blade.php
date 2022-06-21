<x-layouts.admin.app :title="$title" :breadcrumb="$breadcrumb">

  <div class="card">
    <div class="card-body">
      @can('check-module', '003PJE')
      <a href="{{ dashboard_url('projects/' . $project->id . '/edit') }}" class="mb-4">Edit</a>
      @endcan

      <table class="table">
        <tr>
          <th>Project Name</th>
          <td>: {{ $project->project_name }}</td>
        </tr>
        <tr>
          <th>Project Description</th>
          <td>: {{ $project->project_name }}</td>
        </tr>
        <tr>
          <th>Owner</th>
          <td>: {{ $project->owner->name }}</td>
        </tr>
      </table>
    </div>
  </div>

</x-layouts.admin.app>