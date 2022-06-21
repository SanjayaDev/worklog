<x-layouts.admin.app  :title="$title" :breadcrumb="$breadcrumb">
 
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" data-bs-toggle="tab" href="#userTab">User</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="tab" href="#moduleAccessTab">Module Access</a>
    </li>
  </ul>

  <div class="card">
    <div class="card-body">
      <div class="tab-content">
        <div class="tab-pane container active" id="userTab">
          <table class="table table-bordered table-responsive">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($users as $user)
                <tr>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>
                    <a href="{{ dashboard_url('users/' . $user->id) }}" class="btn btn-primary btn-sm">Detail</a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="3" class="text-center">No Data</td>
                </tr>
              @endforelse
            </tbody>
          </table>

          {{ $users->links() }}
        </div>
        <div class="tab-pane container fade" id="moduleAccessTab">
          <form action="{{ dashboard_url('') }}roles/{{ $role->id }}/module/assign" method="POST">
            @csrf
            @method("PUT")
            <table class="table table-bordered table-responsive">
              <thead>
                <tr>
                  <th>Module Code</th>
                  <th>Module Name</th>
                  <th>Descrition</th>
                  <th>Assigned</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @if ($role->id == 1)
                  <tr>
                    <td colspan="4" class="text-center">Super admin is allowed all modules</td>
                  </tr>
                @else
                  @foreach ($module_exists as $module)
                    <tr>
                      <td>{{ $module->module_code }}</td>
                      <td>{{ $module->module_name }}</td>
                      <td>{{ $module->module_description }}</td>
                      <td>
                        {{ count($module->module_roles) > 0 ? "Assign" : "-" }}
                      </td>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="module_id[]" value="{{ $module->id }}" {{ count($module->module_roles) > 0 ? "checked" : "" }}>
                          <label class="form-check-label">Assign</label>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
            </table>

            <button class="btn btn-success btn-sm mt-3" type="submit">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</x-layouts.admin.app>