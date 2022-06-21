<x-layouts.admin.app  :title="$title" :breadcrumb="$breadcrumb">
  
  <div class="card">
    <div class="card-body">
      <a href="/dashboard/users/{{ $user->id }}/edit" class="btn btn-info btn-sm mb-2">Edit</a>
      <table class="table table-responsive">
        <tr>
          <th>Name</th>
          <td>{{ $user->name }}</td>
        </tr>
        <tr>
          <th>Email</th>
          <td>{{ $user->email }}</td>
        </tr>
        <tr>
          <th>Role</th>
          <td>{{ $user->role->role_name }}</td>
        </tr>
      </table>
    </div>
  </div>

</x-layouts.admin.app>