@extends('admin.app')
@section('title')@lang('services')@endsection
@section('content')


<div class="card mt-5">
  <div class="card-header d-flex justify-content-between">
    <h2 class="mb-4">@lang('services')</h2>
    <a href="{{ route('admin.services.index') }}" class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
  </div>
  <div class="card-body table-responsive">
    <form action="{{ route('admin.services.update',$service) }}" method="post" enctype="multipart/form-data">@csrf
      @method('PUT')
      @include('admin.services._form')
    </form>
  </div>
</div>


@endsection
