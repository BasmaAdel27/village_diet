@php
$subscription = \App\Models\Subscription::find(request('subscription_id'));
@endphp

@extends('admin.app')
@section('title')@lang('details')@endsection

@section('content')

<div class="card mt-5">
  <div class="card-header d-flex justify-content-between">
    <h2 class="mb-4">@lang('details')</h2>
    <a href="{{ route('admin.subscriptions.index') }}"
      class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-12">
        <h2>@lang('basic_informations')</h2>
      </div>
    </div>
    <div class="row" style="border: 1px solid #e7eaed;margin-top:5px">
      <div class="col-6 mt-4">
        <label><strong>@lang('name') : </strong></label>
        {{$user->fullname}}
      </div>
      <div class="col-6 mt-4">
        <label><strong>@lang('user_number') : </strong></label>
        {{$user->user_number}}
      </div>
      <div class="col-6 mt-4">
        <label><strong>@lang('email') : </strong></label>
        {{$user->email}}
      </div>
      <div class="col-6 mt-4">
        <label><strong>@lang('status') : </strong></label>
        {{ ($user->is_active) ? trans('active') : trans('in_active')}}
      </div>
      <div class="col-6 mt-4">
        <label><strong>@lang('address') : </strong></label>
        {{ $user->address }}
      </div>
      <div class="col-6 mt-4">
        <label><strong>@lang('instagram') : </strong></label>
        {{ $user->insta_link }}
      </div>
      <div class="col-6 mt-4">
        <label><strong>@lang('twitter') : </strong></label>
        {{ $user->twitter_link }}
      </div>
      <div class="col-6 mt-4">
        <label><strong>@lang('country') : </strong></label>
        {{ $user->country?->name }}
      </div>
      <div class="col-6 mt-4">
        <label><strong>@lang('city') : </strong></label>
        {{ $user->state?->name }}
      </div>
      <div class="col-6 mt-4">
        <label><strong>@lang('phone') : </strong></label>
        {{$user->phone}}
      </div>
      <div class="col-6 mt-4">
        <label><strong>@lang('date_of_birth') : </strong></label>
        {{$user->date_of_birth?->format('Y-m-d')}}
      </div>
      <div class="col-6 mt-4">
        <label><strong>@lang('created_at') : </strong></label>
        {{$user->created_at}}
      </div>
    </div>
    @if (count($user->entry->answers ?? []))
    <div class="row mt-4">
      <div class="col-12">
        <h2>@lang('health_info')</h2>
      </div>
    </div>
    <div class="row" style="border: 1px solid #e7eaed;margin-top:5px">
      @foreach ($user->entry->answers ?? [] as $answer)
      <div class="col-6">
        <label><strong>{{ $answer->question?->content }} : </strong></label>
      </div>
      <div class="col-6">
        {{ $answer->value }}
      </div>
      @endforeach
    </div>
    @endif
    <div class="row mt-4">
      <div class="col-12">
        <h2>@lang('subscription_info')</h2>
      </div>
    </div>
    <div class="row" style="border: 1px solid #e7eaed;margin-top:5px">
      <div class="col-6 mt-4">
        <label><strong>@lang('subscription_status') : </strong></label>
        {{$subscription->status_ar}}
      </div>
      <div class="col-6 mt-4">
        <label><strong>@lang('payment_method') : </strong></label>
        {{$subscription->payment_method}}
      </div>
      <div class="col-6 mt-4">
        <label><strong>@lang('init_amount') : </strong></label>
        {{$subscription->amount}}
      </div>
      <div class="col-6 mt-4">
        <label><strong>@lang('vat_tax_amount') : </strong></label>
        {{$subscription->tax_amount}}
      </div>
      <div class="col-6 mt-4">
        <label><strong>@lang('total') : </strong></label>
        {{$subscription->total_amount}}
      </div>
      <div class="col-6 mt-4">
        <label><strong>@lang('created_at') : </strong></label>
        {{$subscription->created_at}}
      </div>
      <div class="col-6 mt-4">
        <label><strong>@lang('end_date') : </strong></label>
        {{$subscription->end_date}}
      </div>
      <div class="col-6 mt-4">
        <label><strong>@lang('coupon') : </strong></label>
        {{($subscription->coupon_id) ? 'True' : 'False'}}
      </div>
      <div class="col-6 mt-4">
        <label><strong>@lang('transaction_id') : </strong></label>
        {{($subscription->coupon_id) ? 'True' : 'False'}}
      </div>
    </div>
  </div>
</div>

@endsection
