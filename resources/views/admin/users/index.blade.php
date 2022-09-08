@extends('admin.app')
@section('content')

<div class="card mt-5">
  <div class="card-header d-flex justify-content-between">
    <h2 class="mb-4">@lang('users')</h2>
    <a href="{{ route('admin.users.create') }}" class="btn btn-outline-primary btn-lg font-weight-bold">@lang('add')</a>
  </div>

  <div class="card-body table-responsive">
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
