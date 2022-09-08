@extends('admin.app')
@section('content')
  <div class="container mt-5">
    <h2 class="mb-4 user">@lang('roles')</h2>
    <a href="{{route('admin.roles.create')}}" class="edit btn btn-success btn-sm ">@lang('add')</a>

    <table class="table table-bordered yajra-datatable">
      <thead>
      <tr>
        <th>@lang('#')</th>
        <th>@lang('name')</th>
        <th>@lang('action')</th>
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
            orderable: false,
            searchable: false
          },
        ]
      });

    });

  </script>
@endsection
