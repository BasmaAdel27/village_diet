@extends('admin.app')
@section('title')@lang('users')@endsection
@section('content')

<div class="card mt-5">
  <div class="card-header d-flex justify-content-between">
    <h2 class="mb-4">@lang('users')</h2>
  </div>
  <div class="card-body table-responsive">
    <form action="{{ route('admin.users.post_data',$survey) }}" method="post">@csrf
      <div class="form-group">
        <label>@lang('user_name')</label>
        <select name="user_id" class="form-control">
          <option value="">@lang('select')</option>
          @foreach ($users as $id => $name)
          <option value="{{ $id }}">{{ $name }}</option>
          @endforeach
        </select>
      </div>
      @include('survey::standard', ['survey' => $survey])
    </form>
  </div>
</div>

@endsection
