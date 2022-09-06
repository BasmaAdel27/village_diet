@extends('admin.app')
@section('content')
  <div class="container mt-5">
    <h2 class="mb-4 user">Users</h2>
    <a href='{{route('admin.users.create')}}' class="edit btn btn-success btn-sm">Add User</a>
    <table class="table table-bordered yajra-datatable">
      <thead>
      <tr>
        <th>No</th>
        <th>first name</th>
        <th>last name</th>
        <th>email</th>
        <th>Phone</th>
        <th>date_of_birth</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
@endsection
@section('scripts')
<script type="text/javascript">
  $(function () {

    var table = $('.yajra-datatable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "/admin/users/list",
      columns: [
        {data: 'id', name: 'id'},
        {data: 'first_name', name: 'first_name'},
        {data: 'last_name', name: 'last_name'},
        {data: 'email', name: 'email'},
        {data: 'date_of_birth', name: 'date_of_birth'},
        {data: 'phone', name: 'phone'},
        {
          data: 'action',
          name: 'action',
          orderable: true,
          searchable: true
        },
      ]
    });

  });
</script>
@endsection
