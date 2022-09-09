@extends('admin.app')
@section('content')
<div class="container">

  <div class="card mt-5">
    <div class="card-header d-flex justify-content-between">
      <h2 class="mb-4">@lang('static_pages')</h2>
      <a href="{{ route('admin.static_pages.index') }}"
        class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
    </div>
    <div class="card-body table-responsive">
      <form action="{{ route('admin.static_pages.store') }}" method="post" enctype="multipart/form-data">@csrf
        @include('admin.static_pages._form')
      </form>
    </div>
  </div>
</div>

@endsection
