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
        <select class="js-example-basic-multiple col-12" name="permission[]" multiple="multiple">
          @foreach($permissions as $permission)
          <option value="{{$permission->id}}">{{$permission->name}}</option>
          @endforeach
        </select>
        <input class="btn btn-success mt-3" type="submit" name="submit" value="submit">
      </form>
    </div>
  </div>
</div>

@endsection

