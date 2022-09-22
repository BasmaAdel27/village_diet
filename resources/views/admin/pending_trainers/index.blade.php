@extends('admin.app')
@section('title')@lang('pending trainers')@endsection
@section('content')

  <div class="card mt-5">
    <div class="card-header d-flex justify-content-between">
      <h2 class="mb-4">@lang('pending trainers')</h2>

    </div>
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
