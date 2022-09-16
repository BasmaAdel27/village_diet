@extends('trainer.layout')
@section('content')

<div class="card mt-5">
  <div class="card-header d-flex justify-content-between">
    <h2 class="mb-4">@lang('users')</h2>
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
