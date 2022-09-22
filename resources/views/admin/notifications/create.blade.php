@extends('admin.app')
@section('title')@lang('notifications')@endsection
@section('content')


  <div class="card mt-5">
    <div class="card-header d-flex justify-content-between">
      <h2 class="mb-4">@lang('notifications')</h2>
      <a href="{{ route('admin.notifications.index') }}"
        class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
    </div>
    <div class="card-body table-responsive">
      <form action="{{ route('admin.notifications.store') }}" method="post" enctype="multipart/form-data">@csrf
        @include('admin.notifications._form')
      </form>
    </div>
  </div>


@endsection
