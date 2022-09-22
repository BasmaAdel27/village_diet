@extends('admin.app')
@section('title')@lang('reports_coupons')@endsection
@section('content')

<div class="card mt-5">
  <div class="card-header">
    @include('admin.reports._date_search')
  </div>
  <div class="card-body table-responsive">
    {!! $dataTable->table([
    'class' => 'table table-striped table-hover Main-List',
    'id' => 'print_this'
    ],true) !!}
  </div>
</div>

@endsection

@section('scripts')
{!! $dataTable->scripts() !!}
@endsection
