@extends('admin.app')
@section('title')@lang('common_questions')@endsection
@section('content')


    <div class="card mt-5">
      <div class="card-header d-flex justify-content-between">
        <h2 class="mb-4">@lang('common_questions')</h2>
        <a href="{{ route('admin.common_questions.index') }}"
           class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
      </div>
      <div class="card-body table-responsive">
        <form action="{{ route('admin.common_questions.update',$commonQuestion->id) }}" method="post" enctype="multipart/form-data">@csrf @method('PUT')
          <div class="row">
            @foreach ($locales as $locale)
              <div class="form-group col-6">
                <label>@lang("question_$locale")</label>
                <textarea class="form-control" name={{ $locale }}[question]
                          rows="10">{{$commonQuestion->translate($locale)->question}}</textarea>
              </div>
            @endforeach
            @foreach ($locales as $locale)
              <div class="form-group col-6">
                <label>@lang("answer_$locale")</label>
                <textarea class="form-control" name={{ $locale }}[answer]
                          rows="10">{{$commonQuestion->translate($locale)->answer}}</textarea>
              </div>
            @endforeach
            <div class="form-group col-6">
              <label>@lang('status')</label>
              <select name="is_active" class="form-control">
                <option value="">@lang('select')</option>
                <option value="1" {{$commonQuestion->is_active == '1' ? 'selected' : '' }}>@lang('active')</option>
                <option value="0" {{$commonQuestion->is_active == '0' ? 'selected' : '' }}>@lang('inactive')</option>
              </select>
            </div>

          </div>
          <div class="row">
            <div class="form-group col-6">
              <input type="submit" class="btn btn-dark" value="@lang('submit')">
            </div>
          </div>
        </form>
      </div>
    </div>


@endsection
