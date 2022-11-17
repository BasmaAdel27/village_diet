@extends('trainer.layout')
@section('title') @lang('common_questions') @endsection
@section('content')

  <div class="card mt-5">
    <div class="card-header d-flex justify-content-between">
      <h2 class="mb-4">@lang('common_questions')</h2>
      <a href="{{ route('admin.common_questions.index') }}" class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
    </div>
    <div class="card-body">
      <div class="row">
          @foreach ($locales as $locale)
            <div class="form-group col-6">
              <label><strong>@lang("question_$locale") :</strong></label>
             {{$commonQuestion->translate($locale)->question}}
            </div>
          @endforeach
            @foreach ($locales as $locale)
              <div class="form-group col-6">
                <label><strong>@lang("answer_$locale") :</strong></label>
                {{$commonQuestion->translate($locale)->answer}}
              </div>
            @endforeach
        <div class="col-6">
          <label><strong>@lang('status') : </strong></label>
          @if($commonQuestion->is_active == 1)
            @lang('active')
          @else
            @lang('inactive')
          @endif
        </div>
      </div>
    </div>
  </div>

@endsection
