@extends('admin.app')
@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title')@lang('trainers')@endsection
@section('content')

  <div class="card mt-5">
    <div class="card-header d-flex justify-content-between">
      <h2 class="mb-4">@lang('trainers')</h2>
      <a href="{{ route('admin.trainers.index') }}"
        class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
    </div>
    <div class="card-body table-responsive">
      <form action="{{ route('admin.trainers.update',$trainer->id) }}" method="post" enctype="multipart/form-data">@csrf
        @method('PUT')
        <div class="row">
          <div class="form-group col-6">
            <label>@lang("first_name")</label>
            <input type="text" class="form-control" name='first_name' value="{{old('first_name',$trainer->user->first_name)}}">
          </div>
          <div class="form-group col-6">
            <label>@lang("last_name")</label>
            <input type="text" class="form-control" name='last_name' value="{{old('last_name',$trainer->user->last_name)}}">
          </div>
          <div class="form-group col-6">
            <label>@lang("phone")</label>
            <input type="text" class="form-control" name='phone' value="{{old('phone',$trainer->user->phone)}}">
          </div>
          <div class="form-group col-6">
            <label>@lang("email")</label>
            <input type="email" class="form-control" name='email' value="{{old('email',$trainer->user->email) }}">
          </div>
          <div class="form-group col-6">
            <label>@lang('select_image')</label>
            <input type="file" name="image" class="file-upload-default" id="image">
            <div class="input-group col-xs-12">
              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
              <span class="input-group-append">
                <button class="file-upload-browse btn btn-primary" type="button">@lang('upload')</button>
              </span>
            </div>
          </div>
          <div class="form-group col-6">
            <label>@lang('countries')</label>
            <select name="countries" id="country1" class="form-control">
              <option value="">@lang('select')</option>
              @foreach ($countries as $id => $name)
              <option value="{{$id}}" {{$id== old('countries',$trainer->user->country_id) ?'selected': '' }}>{{trans($name)}}</option>
              @endforeach
            </select>
          </div>


          <div class="form-group col-6">
            <label>@lang("city")</label>
            <input type="text" class="form-control" name='city' value="{{old('city',$trainer->user->city)}}">
          </div>
          <div class="form-group col-6">
            <label>@lang("address")</label>
            <input type="text" class="form-control" name='address' value="{{old('address',$trainer->user->address)}}">
          </div>

          <div class="form-group col-6">
            <label>@lang("instagram")</label>
            <input type="text" class="form-control" name='instagram' value="{{old('instagram',$trainer->user->insta_link)}}">
          </div>

          <div class="form-group col-6">
            <label>@lang("twitter")</label>
            <input type="text" class="form-control" name='twitter' value="{{old('twitter',$trainer->user->twitter_link)}}">
          </div>

          <div class="form-group col-6">
            <label>@lang("current job")</label>
            <input type="text" class="form-control" name='current_job' value="{{old('current_job',$trainer->current_job)}}">
          </div>

          <div class="form-group col-6">
            <label>@lang('body shape')</label>
            <select name="body_shape" class="form-control" name="body_shape">
              <option value="">@lang('select')</option>
              <option value="slim" {{'slim'==old('body_shape',$trainer->body_shape) ?'selected': '' }} >@lang('slim')</option>
              <option value="sportsman" {{'sportsman'==old('body_shape',$trainer->body_shape)  ?'selected': '' }}>@lang('sportsman')
              </option>
              <option value="Stretchy muscles" {{'Stretchy muscles'==old('body_shape',$trainer->body_shape)  ?'selected': ''
                }}>@lang('Stretchy_muscles')</option>
              <option value="Medium build" {{'Medium build'==old('body_shape',$trainer->body_shape)  ?'selected': '' }}>
                @lang('Medium_build')</option>
              <option value="Slightly overweight" {{'Slightly overweight'==old('body_shape',$trainer->body_shape)  ?'selected': '' }}
                >@lang('Slightly_overweight')</option>
              <option value="overweight" {{'overweight'==old('body_shape',$trainer->body_shape)  ?'selected': '' }}>@lang('overweight')
              </option>
            </select>
          </div>
          <div class="form-group col-6">
            <label>@lang("reason to join us")</label>
            <textarea class="form-control" name='join_request_reason'>{{old('join_request_reason',$trainer->join_request_reason)}}</textarea>
          </div>
          <div class="form-group col-6">
            <label>@lang("bio")</label>
            <textarea class="form-control" name='bio'>{{old('bio',$trainer->bio)}}</textarea>
          </div>
          <div class="form-group col-6">
            <label>@lang('is licensed?')</label>
            <select name="is_certified" class="form-control" id="certificate">
              <option value="">@lang('select')</option>
              <option value="1" {{old('is_certified',$trainer->is_certified) == 1 ?'selected':''}} >@lang('yes')</option>
              <option value="0" {{old('is_certified',$trainer->is_certified) == 0 ?'selected':''}}>@lang('no')</option>
            </select>
          </div>
          <div class="form-group col-6" id="licenseImg">
            <label>@lang('licensed_image')</label>
            <input type="file" name="confidental_image" class="file-upload-default" id="image">
            <div class="input-group col-xs-12">
              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
              <span class="input-group-append">
                <button class="file-upload-browse btn btn-primary" type="button">@lang('upload')</button>
              </span>
            </div>
          </div>

          <div class="form-group col-6">
            <label>@lang('cv')</label>
            <input type="file" name="cv" class="file-upload-default" id="image">
            <div class="input-group col-xs-12">
              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
              <span class="input-group-append">
                <button class="file-upload-browse btn btn-primary" type="button">@lang('upload')</button>
              </span>
            </div>
          </div>

          <div class="form-group col-6">
            <label>@lang('show in our trainer page')</label>
            <select name="show_inPage" class="form-control">
              <option value="">@lang('select')</option>
              <option value="1" {{old('show_inPage', $trainer->show_inPage )== 1 ?'selected': '' }} >@lang('active')</option>
              <option value="0" {{ old('show_inPage', $trainer->show_inPage ) == 0 ?'selected': '' }}>@lang('inactive')</option>
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
@section('scripts')
<script>

  $("#certificate").change(function () {
    var selected_option = $('#certificate').val();
    if (selected_option == 1) {
      $('#licenseImg').show();
    }
    if (selected_option != 1) {
      $("#licenseImg").hide();
    }
  })

</script>
@endsection
