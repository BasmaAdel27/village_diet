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
        <form action="{{ route('admin.coupons.store') }}" method="post" >@csrf
          <div class="row">
            <div class="form-group col-6">
              <label>@lang("code")</label>
              <input type="text" class="form-control" name='code' id="code">
            </div>
            <div class="form-group col-6">
              <span id="generate" onclick="code()"  class="btn btn-success" name='generate_code' style="margin: 32px;">@lang('generate code')</span>
            </div>
            <div class="form-group col-6">
              <label for="date_from">@lang('activate_date')</label>
              <input type="date" class="form-control" id="date_from" name="activate_date"
                     value="{{ (request()->date_from) ? date('Y-m-d H:i:s',strtotime(request('date_from'))): '' }}">
            </div>
            <div class="form-group col-6">
              <label for=" date_to">@lang('end_date')</label>
              <div class="input-group">
                <input type="date" class="form-control" id="date_to" name="end_date"
                       value="{{ (request()->date_to) ? date('Y-m-d H:i:s', strtotime(request('date_to'))): '' }}">
              </div>
            </div>

            <div class="form-group col-6">
              <label>@lang("amount")</label>
              <input type="text" class="form-control" name='amount'>
            </div>
            <div class="form-group col-6">
              <label>@lang('coupon_type')</label>
              <select class="form-control" name="coupon_type">
                <option value="fixed">@lang('fixed')</option>
                <option value="percent">@lang('percent')</option>
              </select>
            </div>
            <div class="form-group col-6">
              <label>@lang("max_used")</label>
              <input type="text" class="form-control" name='max_used'>
            </div>

            <div class="form-group col-6">
              <label>@lang("used_times")</label>
              <input type="text" class="form-control" name='used_times'>
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
    function code() {
      var generate = document.getElementById('generate');
      var text = "";
      var possible = "AB0123456789CDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
      for (var i = 0; i < 6; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));
      document.getElementById('code').value=text;

    }
  </script>
@endsection
