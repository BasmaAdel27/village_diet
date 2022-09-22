@extends('admin.app')
@section('title')@lang('reports_trainers')@endsection
@section('content')

<div class="card mt-5">
  <div class="card-header">
    @include('admin.reports._date_search')
  </div>
  <div class="card-body table-responsive">
    <table class="table table-striped table-hover Main-List">
      <thead>
        <th>@lang('activeTrainers')</th>
        <th>@lang('inactiveTrainers')</th>
        <th>@lang('societyCount')</th>
        <th>@lang('totalOfTrainers')</th>
      </thead>
      <tbody>
        <td>{{ $data['activeTrainers'] ?? 0 }}</td>
        <td>{{ $data['inactiveTrainers'] ?? 0 }}</td>
        <td>{{ $data['societyCount'] ?? 0 }}</td>
        <td>{{ $data['totalOfTrainers'] ?? 0 }}</td>
      </tbody>
    </table>
  </div>
</div>

@endsection
