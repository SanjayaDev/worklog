<x-layouts.admin.app  :title="$title" :breadcrumb="$breadcrumb">

  <div class="card">
    <div class="card-body">
      <button class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#modalAddRole">Add Role</button>

      <table class="table table-bordered w-100">
        <thead>
          <tr>
            <th>No</th>
            <th>Role</th>
            <th>Role Description</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($roles as $role)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $role->role_name }}</td>
              <td>{{ $role->role_description }}</td>
              <td>
                <a href="{{ dashboard_url('roles/' . $role->id) }}" class="btn btn-info btn-sm">Detail</a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="text-center">No Data</td>
            </tr>
          @endforelse
        </tbody>
      </table>

      <!-- The Modal -->
      <div class="modal fade" id="modalAddRole">
        <div class="modal-dialog">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Add New Role</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              
              <form action="{{ dashboard_url('roles') }}" method="POST">
                @csrf

                <x-forms.input-group label="Role Name" name="role_name"></x-forms.input-group>

                <x-forms.textarea-group label="Role Description" name="role_description" rows="3"></x-forms.textarea-group>

                <button class="btn btn-success btn-sm mt-3" type="submit">Add Role</button>
              </form>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

</x-layouts.admin.app>