@extends('admin.app')
@section('title') @lang('societies') @endsection
@section('content')
  <div class="card mt-5">
    <div class="card-header d-flex justify-content-between">
      <h2 class="mb-4">@lang('societies')</h2>
      <a href="{{ route('admin.societies.index') }}"
        class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
    </div>
    <div class="card-body table-responsive">
      <form action="{{ route('admin.societies.update',$society) }}" method="post">@csrf @method('PUT')
        @include('admin.society._form')
      </form>
    </div>
  </div>


@endsection
