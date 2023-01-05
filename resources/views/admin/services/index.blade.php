@extends('admin.app')
@section('title')@lang('services')@endsection
@section('content')

<div class="card mt-5">
  <div class="card-header d-flex justify-content-between">
    <h2 class="mb-4">{{request()->query('type')=='Store'? trans('store'):trans('work_way')}}</h2>
    @can('admin.services.store')
    <a href="{{ request()->query('type')=='Store' ? route('admin.services.create',['type'=>'Store']) : route('admin.services.create',['type'=>'WorkWay'])}}"
      class="btn btn-outline-primary btn-lg font-weight-bold">@lang('add')</a>
    @endcan
  </div>
  @include('admin.services.datatable.status')

  <div class="card-body table-responsive">


    {!! $dataTable->table([
    'class' => 'table table-striped table-hover Main-List'
    ],true) !!}

</div>
</div>

@endsection

@section('scripts')
{!! $dataTable->scripts() !!}
@endsection
