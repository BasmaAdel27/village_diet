@extends('admin.app')
@section('title')@lang('sliders')@endsection
@section('content')


  <div class="card mt-5">
    <div class="card-header d-flex justify-content-between">
      <h2 class="mb-4">@lang('sliders')</h2>
      <a href="{{ route('admin.sliders.index') }}"
        class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
    </div>
    <div class="card-body table-responsive">
      <form action="{{ route('admin.sliders.store') }}" method="post" enctype="multipart/form-data">@csrf
        @include('admin.sliders._form')
      </form>
    </div>
  </div>

@endsection
