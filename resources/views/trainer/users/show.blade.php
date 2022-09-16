@extends('trainer.layout')
@section('content')

<div class="card mt-5">
  <div class="card-header d-flex justify-content-between">
    <h2 class="mb-4">@lang('users')</h2>
    <a href="{{ route('trainer.users.index') }}" class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-6">
        <label><strong>@lang('name') : </strong></label>
        {{ $user->first_name . ' ' . $user->last_name }}
      </div>
      <div class="col-6">
        <label><strong>@lang('email') : </strong></label>
        {{ $user->email }}
      </div>
      <div class="col-6 mt-4">
        <label><strong>@lang('user_number') : </strong></label>
        {{ $user->user_number }}
      </div>
      <div class="col-6">
        <label><strong>@lang('phone') : </strong></label>
        {{ $user->phone }}
      </div>
      <div class="col-6 mt-4">
        <label><strong>@lang('date_of_birth') : </strong></label>
        {{ $user->date_of_birth }}
      </div>
      <div class="col-6">
        <label><strong>@lang('status') : </strong></label>
        {{ $user->active }}
      </div>
      <div class="col-6 mt-4">
        <label><strong>@lang('country') : </strong></label>
        {{ $user->country?->name }}
      </div>
      <div class="col-6">
        <label><strong>@lang('state') : </strong></label>
        {{ $user->state?->name }}
      </div>
      <div class="col-6 mt-4">
        <label><strong>@lang('address') : </strong></label>
        {{ $user->address }}
      </div>
      <div class="col-12 m-4">
        <h2>@lang('health_info')</h2>
      </div>
      @foreach ($user->entry->answers ?? [] as $answer)
      <div class="col-6">
        <label><strong>{{ $answer->question?->content }} : </strong></label>
      </div>
      <div class="col-6">
        {{ $answer->value }}
      </div>
      @endforeach
    </div>
  </div>
</div>

@endsection
