@extends('admin.app')
@section('title')@lang('postel_news')@endsection
@section('content')

<div class="card mt-5">
  <div class="card-header d-flex justify-content-between">
    <h2 class="mb-4">@lang('postel_news')</h2>
    <a href="{{ route('admin.postel_news.index') }}"
      class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
  </div>
  <div class="card-body table-responsive">
    <form action="{{ route('admin.postel_news.store') }}" method="post" enctype="multipart/form-data">@csrf
      <div class="row">
        <div class="form-group col-6">
          <label>@lang("title")</label>
          <input type="text" class="form-control" placeholder='@lang("title")' name="title" value={{ old("title") }}>
        </div>
        <div class="form-group col-6">
          <label>@lang('template')</label>
          <select name="template" class="form-control">
            <option value="">@lang('select')</option>
            @foreach ($templates as $id => $template)
            <option value="{{ $id }}">{{ $template }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-12">
          <label>@lang('users')</label>
          <select name="emails[]" class="form-control js-example-basic-multiple" multiple>
            <option value="">@lang('select')</option>
            @foreach ($users as $email)
            <option value="{{ $email }}">{{ $email }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-6">
          <input type="submit" class="btn btn-dark" value="@lang('send')">
        </div>
      </div>
    </form>
  </div>
</div>

@endsection
