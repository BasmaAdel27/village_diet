@extends('trainer.layout')
@section('title') @lang('societies') @endsection
@section('content')

<div class="card mt-5">
  <div class="card-header d-flex justify-content-between">
    <h2 class="mb-4">@lang('societies')</h2>
    <a href="{{ route('trainer.societies.index') }}"
      class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-6">
        <label><strong>@lang('society_name') : </strong></label>
        {{ $society->title }}
      </div>
      <div class="col-6">
        <label><strong>@lang('users_count') : </strong></label>
        {{ $society->users_count }}
      </div>
    </div>
  </div>
</div>

@endsection
