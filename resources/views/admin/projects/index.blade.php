<x-layouts.admin.app :title="$title" :breadcrumb="$breadcrumb">

  <div class="card">
    <div class="card-body">
      @can('check-module', '003PJA')
        <x-button-add href="{{ dashboard_url('projects/create') }}"></x-button-add>
      @endcan

      <table class="table table-bordered table-hover table-responsive">
        <thead>
          <tr>
            <th>No</th>
            <th>Project</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($projects as $project)
            <tr>
              <td>{{ $loop->iteration + $projects->firstItem() - 1 }}</td>
              <td>{{ $project->project_name }}</td>
              <td>
                @can('check-module', '003PJD')
                  <a href="{{ dashboard_url('projects/' . $project->id) }}" class="btn btn-primary btn-sm">Detail</a>
                @endcan
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="3" class="text-center">No Data</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</x-layouts.admin.app>