<x-layouts.admin.app  :title="$title" :breadcrumb="$breadcrumb">
  
  <div class="card">
    <div class="card-body">
      <form action="/dashboard/users/{{ $user->id }}" method="POST">
        @csrf
        @method("PUT")

        @include('admin.users.form', ["user" => $user])

        <button class="btn btn-primary btn-sm mt-3" type="submit">Edit</button>
      </form>
    </div>
  </div>

</x-layouts.admin.app>