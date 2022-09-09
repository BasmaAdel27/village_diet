@extends('admin.app')
@section('content')
<div class="container">

  <div class="card mt-5">
    <div class="card-header d-flex justify-content-between">
      <h2 class="mb-4">@lang('videos')</h2>
      <a href="{{ route('admin.videos.index') }}" class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
    </div>
    <div class="card-body table-responsive">
      <form action="{{ route('admin.videos.update',$video) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.videos._form')
      </form>
    </div>
  </div>
</div>

@endsection
