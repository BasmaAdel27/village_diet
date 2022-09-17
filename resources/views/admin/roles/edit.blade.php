@extends('admin.app')
@section('content')

<div class="container">
  <div class="card mt-5">
    <div class="card-header d-flex justify-content-between">
      <h2 class="mb-4">@lang('roles')</h2>
      <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
    </div>
    <div class="card-body table-responsive">
      <form method="POST" action="{{ route('admin.roles.update',$role->id) }}">@csrf @method('PUT')
        @include('admin.roles._form')
      </form>
    </div>
  </div>
</div>

@endsection
