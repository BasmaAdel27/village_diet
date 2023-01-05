@extends('admin.app')
@section('title') @lang('users') @endsection
@section('content')


  <div class="card mt-5">
    <div class="card-header d-flex justify-content-between">
      <h2 class="mb-4">@lang('users')</h2>
      <a href="{{ route('admin.users.index') }}" class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
    </div>
    <div class="card-body table-responsive">
      <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">@csrf
        @include('admin.users._form')
      </form>
    </div>
  </div>


@endsection


