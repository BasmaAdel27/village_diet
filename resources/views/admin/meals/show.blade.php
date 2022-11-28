@extends('admin.app')
@section('title') @lang('meals') @endsection
@section('content')

  <div class="card mt-5">
    <div class="card-header d-flex justify-content-between">
      <h2 class="mb-4">@lang('meals')</h2>
      <a href="{{ route('admin.meals.index') }}" class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
    </div>
    <div class="card-body">
      <div class="row">
          @foreach ($locales as $locale)
            <div class="form-group col-6">
              <label><strong>@lang("breakfast_meal_$locale") :</strong></label>
             {{$meal->translate($locale)->breakfast}}
            </div>
          @endforeach
            @foreach ($locales as $locale)
              <div class="form-group col-6">
                <label><strong>@lang("lunch_meal_$locale") :</strong></label>
                {{$meal->translate($locale)->lunch}}
              </div>
            @endforeach
            @foreach ($locales as $locale)
              <div class="form-group col-6">
                <label><strong>@lang("dinner_meal_$locale") :</strong></label>
                {{$meal->translate($locale)->dinner}}
              </div>
            @endforeach
        <div class="col-6">
          <label><strong>@lang('show_day') : </strong></label>
         {{trans($meal->day->title)}}
        </div>
            <div class="col-6">
          <label><strong>@lang('status') : </strong></label>
          @if($meal->is_active == 1)
            @lang('active')
          @else
            @lang('inactive')
          @endif
        </div>
      </div>
    </div>
  </div>

@endsection
