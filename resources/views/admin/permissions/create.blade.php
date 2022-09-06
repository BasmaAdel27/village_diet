@extends('admin.app')
@section('content')
  <div class="col-10 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Create Role</h4>
        <form class="form-sample" method="POST" action="/en/admin/permissions">
          {{ csrf_field() }}

      <div class="row">
        <div class="col-md-5">
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Role Name</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="role_name" />
              @include('admin.layout.error', ['input' => 'role_name'])

            </div>
          </div>
        </div>
      </div>
          @include('admin.layout.error', ['input' => 'permission'])

          <table class="table table-striped yajra-datatable" id="example">
        <thead>
        <tr>
          <th class="col-6">Name</th>
          <th>
            <input type="checkbox" name="select_all" value="selects_all" id="example-select-all">

          </th>

        </tr>
        </thead>
        <tbody>
        @foreach($permissions as $permission)
        <tr>
          <td>{{$permission->name}}</td>
          <td>
            <input type="checkbox" name="permission[]" value="{{$permission->id}}" class="example-select-all">
          </td>
        </tr>
        @endforeach
        </tbody>
      </table>
          <input class="btn btn-success" type="submit" name="submit" value="submit">
    </form>
    </div>
  </div>
    </div>

@endsection
@section('scripts')
<script type="text/javascript">
  $("#example-select-all").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
  });

    var table = $('.yajra-datatable').DataTable({

          orderable: true,
          searchable: true,

    });


</script>
@endsection
