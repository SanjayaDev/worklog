<x-layouts.admin.app  :title="$title" :breadcrumb="$breadcrumb">
  
  <div class="card">
    <div class="card-body">
      @can('check-module', '002UA')
        <a href="{{ dashboard_url('users/create') }}" class="btn btn-success btn-sm mb-3">Tambah</a>
      @endcan
      @if (Auth::user()->role_id == 1)
        <a href="{{ dashboard_url('roles') }}" class="btn btn-success btn-sm mb-3">Roles</a>
      @endif

      <table class="table table-bordered w-100 table-responsive">
        <thead>
          <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($users as $user)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->role->role_name }}</td>
              <td>
                <a href="{{ dashboard_url('users/'.$user->id.'/edit') }}" class="btn btn-info btn-sm">Edit</a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center">No Data</td>
            </tr>
          @endforelse
        </tbody>
      </table>

      {{ $users->links() }}
    </div>
  </div>

</x-layouts.admin.app>