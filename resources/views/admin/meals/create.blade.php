@extends('admin.app')
@section('content')
  <div class="container">

    <div class="card mt-5">
      <div class="card-header d-flex justify-content-between">
        <h2 class="mb-4">@lang('meals')</h2>
        <a href="{{ route('admin.meals.index') }}"
           class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
      </div>
      <div class="card-body table-responsive">
        <form action="{{ route('admin.meals.store') }}" method="post" enctype="multipart/form-data">@csrf
          <div class="row">
            @foreach ($locales as $locale)
              <div class="form-group col-6">
                <label>@lang("breakfast_meal_$locale")</label>
                <textarea class="form-control" name={{ $locale }}[breakfast]
                          rows="10"></textarea>
              </div>
            @endforeach
            @foreach ($locales as $locale)
              <div class="form-group col-6">
                <label>@lang("lunch_meal_$locale")</label>
                <textarea class="form-control" name={{ $locale }}[lunch]
                          rows="10"></textarea>
              </div>
            @endforeach
            @foreach ($locales as $locale)
              <div class="form-group col-6">
                <label>@lang("dinner_meal_$locale")</label>
                <textarea class="form-control" name={{ $locale }}[dinner]
                          rows="10"></textarea>
              </div>
            @endforeach
              <div class="form-group col-6">
                <label>@lang('show_day')</label>
                <select name="day_id" class="form-control">
                  <option value="">@lang('select')</option>
                  @foreach ($days as $id => $name)
                    <option value="{{ $id }}">{{ trans($name) }}</option>
                  @endforeach
                </select>
              </div>
            <div class="form-group col-6">
              <label>@lang('status')</label>
              <select name="is_active" class="form-control">
                <option value="">@lang('select')</option>
                <option value="1" >@lang('active')</option>
                <option value="0" >@lang('inactive')</option>
              </select>
            </div>

          </div>
          <div class="row">
            <div class="form-group col-6">
              <input type="submit" class="btn btn-dark" value="@lang('submit')">
            </div>
          </div>        </form>
      </div>
    </div>
  </div>

@endsection
