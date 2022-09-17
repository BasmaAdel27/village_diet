@extends('admin.app')
@section('content')

  <div class="card mt-5">
    <div class="card-header d-flex justify-content-between">
      <h2 class="mb-4">@lang('postel_news')</h2>
      <a href="{{ route('admin.PostelNews.create') }}"
         class="btn btn-outline-primary btn-lg font-weight-bold">@lang('write email')</a>
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
