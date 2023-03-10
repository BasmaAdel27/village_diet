@extends('admin.app')
@section('content')


  <div class="card mt-5">
    <div class="card-header d-flex justify-content-between">
      <h2 class="mb-4">@lang('profile')</h2>
    </div>
    <div class="card-body table-responsive">
      @role('trainer')
      <form action="{{ route('trainer.profile.store') }}" method="post">
      @endrole
      @role('admin')
      <form action="{{ route('admin.profile.store') }}" method="post">
      @endrole
        @csrf
        <div iv class="row">
          <div class="form-group col-6">
            <label>@lang('first_name')</label>
            <input type="text" name="first_name" class="form-control" value="{{old('first_name', $user->first_name) }}">
          </div>
          <div class="form-group col-6">
            <label>@lang('last_name')</label>
            <input type="text" name="last_name" class="form-control" value="{{ old('last_name',$user->last_name) }}">
          </div>
          @if ($user->isSuperAdmin())
          <div class="form-group col-6">
            <label>@lang('email')</label>
            <input type="text" class="form-control" value="{{ $user->email }}" disabled>
            <input type="hidden" name="email" value="{{ $user->email }}">
          </div>
          @else
          <div class="form-group col-6">
            <label>@lang('email')</label>
            <input type="text" name="email" class="form-control" value="{{old('email', $user->email )}}">
          </div>
          @endif
          <div class="form-group col-6">
            <label>@lang('password')</label>
            <input type="password" class="form-control" placeholder="@lang('password')" name="password">
          </div>
          <div class="form-group col-6">
            <label>@lang('password_confirmation')</label>
            <input type="password" class="form-control" placeholder="@lang('password_confirmation')"
              name="password_confirmation">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-6">
            <input type="submit" class="btn btn-dark" value="@lang('submit')">
          </div>
        </div>
      </form>
    </div>
  </div>


@endsection
