@extends('admin.app')
@section('content')
  <div class="container">

    <div class="card mt-5">
      <div class="card-header d-flex justify-content-between">
        <h2 class="mb-4">@lang('trainers')</h2>
        <a href="{{ route('admin.trainers.index') }}"
           class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
      </div>
      <div class="card-body table-responsive">
        <form action="{{ route('admin.trainers.store') }}" method="post" enctype="multipart/form-data">@csrf
          <div class="form-group col-6">
            <label>@lang("first name")</label>
            <input type="text" class="form-control" name='first_name'>
          </div>

        </form>
      </div>
    </div>
  </div>

@endsection
