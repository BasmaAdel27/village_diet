@extends('admin.app')
@section('title')@lang('contact us details')@endsection

@section('content')

<div class="card mt-5">
  <div class="card-header d-flex justify-content-between">
    <h2 class="mb-4">@lang('contact us details')</h2>
    <a href="{{ route('admin.contactUs.index') }}"
      class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-6">
        <label><strong>@lang('name') : </strong></label>
        {{$contactUs->fullname}}
      </div>
      <div class="col-6">
        <label><strong>@lang('user type') : </strong></label>
        {{$contactUs->user_type}}
      </div>
      <div class="col-6 mt-4">
        <label><strong>@lang('email') : </strong></label>
        {{$contactUs->eamil}}
      </div>
      <div class="col-6 mt-4">
        <label><strong>@lang('message type') : </strong></label>
        {{$contactUs->message_type}}
      </div>
      <div class="col-6  mt-4">
        <label><strong>@lang('content') : </strong></label>
        {{$contactUs->content}}
      </div>
      <div class="col-6  mt-4">
        <label><strong>@lang('phone') : </strong></label>
        {{$contactUs->phone}}
      </div>
      <div class="col-6 mt-4">
        <label><strong>@lang('whatsapp phone') : </strong></label>
        {{$contactUs->whatsapp_phone}}
      </div>
      <div class="col-6 mt-4">
        <label><strong>@lang('created_at') : </strong></label>
        {{$contactUs->created_at}}
      </div>
    </div>
  </div>
</div>

@endsection
