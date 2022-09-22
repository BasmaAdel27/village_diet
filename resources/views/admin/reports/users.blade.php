@extends('admin.app')
@section('title')@lang('reports_users')@endsection
@section('content')

<div class="card mt-5">
  <div class="card-header">
    @include('admin.reports._date_search')
  </div>
  <div class="card-body table-responsive">
    <table class="table table-striped table-hover Main-List" id="print_this">
      <thead>
        <th>@lang('activeSubscripersCount')</th>
        <th>@lang('finishedSubscripersCount')</th>
        <th>@lang('inactiveSubscripersCount')</th>
        <th>@lang('totalSubscripers')</th>
      </thead>
      <tbody>
        <td>{{ $data['activeSubscripersCount'] ?? 0 }}</td>
        <td>{{ $data['finishedSubscripersCount'] ?? 0 }}</td>
        <td>{{ $data['inactiveSubscripersCount'] ?? 0 }}</td>
        <td>{{ $data['total'] ?? 0 }}</td>
      </tbody>
    </table>
  </div>
</div>

@endsection
