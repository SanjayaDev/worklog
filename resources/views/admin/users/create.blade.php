<x-layouts.admin.app  :title="$title" :breadcrumb="$breadcrumb">
  
  <div class="card">
    <div class="card-body">
      <form action="/dashboard/users" method="POST">
        @csrf

        @include('admin.users.form')

        <button class="btn btn-primary btn-sm mt-3" type="submit">Tambah</button>
      </form>
    </div>
  </div>

</x-layouts.admin.app>