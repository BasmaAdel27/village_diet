@extends('admin.app')
@section('content')
<div class="container">

  <div class="card mt-5">
    <div class="card-header d-flex justify-content-between">
      <h2 class="mb-4">@lang('admins')</h2>
      <a href="{{ route('admin.admins.index') }}" class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
    </div>
    <div class="card-body table-responsive">
      <form action="{{ route('admin.admins.update',$admin) }}" method="post">@csrf @method('PUT')
        @include('admin.admins._form')
      </form>
    </div>
  </div>
</div>

@endsection
