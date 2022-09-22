@extends('admin.app')
@section('title')@lang('reports_subscriptions')@endsection
@section('content')

<div class="card mt-5">
  <div class="card-header">
    @include('admin.reports._date_search')
  </div>
  <div class="card-body table-responsive">
    <table class="table table-striped table-hover Main-List" id="print_this">
      <thead>
        <th>@lang('countOfUsers')</th>
        <th>@lang('sumOfSubscriptions')</th>
        <th>@lang('sumOftaxs')</th>
        <th>@lang('sumOfCoupons')</th>
        <th>@lang('total')</th>
      </thead>
      <tbody>
        <td>{{ $data['countOfUsers'] ?? 0 }}</td>
        <td>{{ $data['sumOfSubscriptions'] ?? 0 }}</td>
        <td>{{ $data['sumOftaxs'] ?? 0 }}</td>
        <td>{{ $data['sumOfCoupons'] ?? 0 }}</td>
        <td>{{ $data['total'] ?? 0 }}</td>
      </tbody>
    </table>
  </div>
</div>

@endsection
