@extends('trainer.layout')
@section('title') @lang('statistics') @endsection
@section('content')

<div class="card mt-5">
  <div class="card-header d-flex justify-content-between">
    <h2 class="mb-4">@lang('statistics')</h2>
    <a href="{{ route('trainer.users.index') }}" class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
  </div>
  <div class="m-3 text-center row">
    <div class="form-group col-6">
      <label>@lang('weight_days')</label>
      <canvas id="weightChart" style="width:100%;max-width:1000px"></canvas>
    </div>
    <hr>
    <div class="form-group col-6">
      <label>@lang('cup_days')</label>
      <canvas id="dailyCupChart" style="width:100%;max-width:1000px"></canvas>
    </div>
    <hr>
    <div class="form-group col-6">
      <label>@lang('walk_days')</label>
      <canvas id="walkDurationChart" style="width:100%;max-width:1000px"></canvas>
    </div>
    <hr>
    <div class="form-group col-6">
      <label>@lang('sleep_days')</label>
      <canvas id="sleepHoursChart" style="width:100%;max-width:1000px"></canvas>
    </div>
  </div>
</div>

@endsection
@include('trainer.users._charts_script')
