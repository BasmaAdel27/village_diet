@extends('admin.app')
@section('styles')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title')@lang('coupons')@endsection
@section('content')


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
              <input type="text" class="form-control" name='code' id="code1" value="{{$coupon->code}}">
            </div>
            <div class="form-group col-6">
              <span id="generate1" onclick="code1()"  class="btn btn-success" name='generate_code' style="margin: 32px;">@lang('generate code')</span>
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
              <label>@lang('coupon_type')</label>
                <select class="form-control" name="coupon_type">
                  <option value="fixed" {{$coupon->coupon_type == 'fixed' ? 'selected' : ''}}>@lang('fixed')</option>
                  <option value="percent" {{$coupon->coupon_type == 'percent' ? 'selected' : ''}}>@lang('percent')</option>
                </select>
            </div>
            <div class="form-group col-6">
              <label>@lang("max_used")</label>
              <input type="text" class="form-control" name='max_used' value="{{$coupon->max_used}}">
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
@section('scripts')
  <script>
    function code1() {
      var generate1 = document.getElementById('generate1');
      var text = "";
      var possible = "AB0123456789CDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
      for (var i = 0; i < 6; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));
      document.getElementById('code1').value=text;

    }
  </script>
@endsection
