
@extends('admin.app')
@section('styles')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title')@lang('countries')@endsection
@section('content')


  <div class="card mt-5">
    <div class="card-header d-flex justify-content-between">
      <h2 class="mb-4">@lang('countries')</h2>
      <a href="{{ route('admin.countries.index')}}"
         class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
    </div>
    <div class="card-body table-responsive">
      <form action="{{ route('admin.countries.update',$country->id) }}" method="post" enctype="multipart/form-data">@csrf @method('PUT')
        <div class="row">
          @foreach ($locales as $locale)
            <div class="form-group col-6">
              <label>@lang("country_name_$locale")</label>
              <input class="form-control" name={{ $locale }}[name]
                        value='{{old("$locale.name",$country->translate($locale)->name)}}'>
            </div>
          @endforeach

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

