@extends('admin.app')
@section('styles')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
  <div class="container">

    <div class="card mt-5">
      <div class="card-header d-flex justify-content-between">
        <h2 class="mb-4">@lang('coupons')</h2>
        <a href="{{ route('admin.coupons.index')}}"
           class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
      </div>
      <div class="card-body table-responsive">
        <form action="{{ route('admin.coupons.update',$coupon->id) }}" method="post" >@csrf
          @method('PUT')
          <div class="row">
            <div class="form-group col-6">
              <label>@lang("code")</label>
              <input type="text" class="form-control" name='code'  value="{{$coupon->code}}">
            </div>
            <div class="form-group col-6">
              <input type="submit" value="generate code" class="btn btn-success" name='generate_code' style="margin: 32px;">
            </div>
            <div class="form-group col-6">
              <label for="date_from">@lang('activate_date')</label>
              <input type="date" class="form-control" id="date_from" name="activate_date"
                     value="{{ date('Y-m-d', strtotime($coupon->activate_date))}}">
            </div>
            <div class="form-group col-6">
              <label for=" date_to">@lang('end_date')</label>
              <div class="input-group">
                <input type="date" class="form-control" id="date_to" name="end_date"
                       value="{{date('Y-m-d', strtotime($coupon->end_date)) }}">
              </div>
            </div>

            <div class="form-group col-6">
              <label>@lang("amount")</label>
              <input type="text" class="form-control" name='amount'  value="{{$coupon->amount}}">
            </div>

            <div class="form-group col-6">
              <label>@lang("max_used")</label>
              <input type="text" class="form-control" name='max_used' value="{{$coupon->max_used}}">
            </div>

            <div class="form-group col-6">
              <label>@lang("used_times")</label>
              <input type="text" class="form-control" name='used_times' value="{{$coupon->used_times}}">
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

