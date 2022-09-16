@extends('admin.app')
@section('content')

<div class="container">
  <div class="card mt-5">
    <div class="card-header d-flex justify-content-between">
      <h2 class="mb-4">@lang('roles')</h2>
      <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
    </div>
    <form class="form-sample" method="POST" action="{{ route('admin.roles.store') }}">@csrf
      <div class="row mt-5  mb-4">
        <label class="col-2 col-form-label ml-2">@lang('role')</label>
        <input type="text" class="form-control col-6" name="role_name" />
      </div>
      <div class="row">
        <label class="col-2 col-form-label ml-2">@lang('permissions')</label>
        <select class="js-example-basic-multiple col-6" name="permission[]" multiple="multiple">
          @foreach($permissions as $permission)
          <option value="{{$permission->id}}">{{ trans('site.' . $permission->name) }}</option>
          @endforeach
        </select>
      </div>
      <input class="btn btn-success mt-3 ml-2" type="submit" name="submit" value="@lang('submit')">
    </form>
  </div>
</div>

@endsection
