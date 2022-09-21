@extends('admin.app')
@section('content')


  <div class="card mt-5">
    <div class="card-header d-flex justify-content-between">
      <h2 class="mb-4">@lang('roles')</h2>
      <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
    </div>
    <div class="card-body table-responsive">
      <form action="{{ route('admin.roles.store') }}" method="post" enctype="multipart/form-data">@csrf
        @include('admin.roles._form')
      </form>
    </div>
  </div>


@endsection
