@extends('admin.app')
@section('title')@lang('templates')@endsection
@section('content')

<div class="card mt-5">
  <div class="card-header d-flex justify-content-between">
    <h2 class="mb-4">@lang('templates')</h2>
    <a href="{{ route('admin.templates.index') }}"
      class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
  </div>
  <div class="card-body table-responsive">
    <form action="{{ route('admin.templates.store') }}" method="post" enctype="multipart/form-data">@csrf
      @include('admin.templates._form')
    </form>
  </div>
</div>

@endsection
