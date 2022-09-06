@extends('admin.app')
@section('content')
  <div class="container mt-5">
    <h2 class="mb-4 user">Roles</h2>
    <a href="{{route('admin.roles.create')}}" class="edit btn btn-success btn-sm ">Create Roll</a>
    @if ($message = Session::get('success'))

      <div class="alert alert-success">

        <p>{{ $message }}</p>

      </div>

    @endif
    <table class="table table-bordered yajra-datatable">
      <thead>
      <tr>
        <th>No</th>
        <th>Name</th>
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
        ajax: "/admin/roles/list",
        columns: [
          {data: 'id', name: 'id'},
          {data: 'name', name: 'name'},

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
