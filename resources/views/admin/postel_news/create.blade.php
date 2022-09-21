@extends('admin.app')
@section('content')

<div class="card mt-5">
  <div class="card-header d-flex justify-content-between">
    <h2 class="mb-4">@lang('postel_news')</h2>
    <a href="{{ route('admin.postel_news.index')}}"
      class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
  </div>
  <div class="card-body table-responsive">
    <form action="{{ route('admin.postel_news.store') }}" method="post">@csrf
      <div class="row">
        <div class="form-group col-6">
          <label>@lang("email")</label>
          <input type="email" class="form-control" name='email'>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-6">
          <label>@lang('content')</label>
          <textarea name="content" class="form-control"></textarea>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-6">
          <label>@lang('model')</label>
          <select class="form-control" name="coupon_type">
            <option value="model1">@lang('model1')</option>
            <option value="model2">@lang('model2')</option>
          </select>
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

@endsection
