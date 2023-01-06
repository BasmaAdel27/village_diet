@extends('admin.app')
@section('styles')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title')@lang('customer_opinions')@endsection
@section('content')
  <div class="container">

    <div class="card mt-5">
      <div class="card-header d-flex justify-content-between">
        <h2 class="mb-4">@lang('customer_opinions')</h2>
        <a href="{{ route('admin.opinions.index') }}"
           class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
      </div>
      <div class="card-body table-responsive">
        <form action="{{ route('admin.opinions.update',$opinion->id) }}" method="post" enctype="multipart/form-data">@csrf
         @csrf
          @method('PUT')
          <div class="row">
            <div class="form-group col-6">
              <label>@lang("name")</label>
              <input type="text" class="form-control" name='name' value="{{old('name',$opinion->name)}}">
            </div>
            <div class="form-group col-6">
              <label>@lang('select_image')</label>
              <input type="file" name="image" class="file-upload-default" id="image" value="{{old('image')}}">
              <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                <span class="input-group-append">
                <button class="file-upload-browse btn btn-primary" type="button">@lang('upload')</button>
              </span>
              </div>
            </div>
            <div class="form-group col-6">
              <label>@lang("content")</label>
              <textarea class="form-control" name='content' >{{old('content',$opinion->content)}}</textarea>
            </div>

          </div>
          <div class="row">
            <div class="form-group col-6">
              <input type="submit" class="btn btn-dark" value="@lang('submit')">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection

