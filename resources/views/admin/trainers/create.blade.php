@extends('admin.app')
@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title')@lang('trainers')@endsection
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
        <div class="row">
          <div class="form-group col-6">
            <label>@lang("first_name")</label>
            <input type="text" class="form-control" name='first_name' value="{{old('first_name')}}">
          </div>
          <div class="form-group col-6">
            <label>@lang("last_name")</label>
            <input type="text" class="form-control" name='last_name' value="{{old('last_name')}}">
          </div>
          <div class="form-group col-6">
            <label>@lang("phone")</label>
            <input type="text" class="form-control" name='phone' value="{{old('phone')}}">
          </div>
          <div class="form-group col-6">
            <label>@lang("email")</label>
            <input type="email" class="form-control" name='email' value="{{old('email')}}">
          </div>
          <div class="form-group col-6">
            <label>@lang('select_image')</label>
            <input type="file" name="image" class="file-upload-default" id="image" value="{{old('image')}}">
            <div class="input-group col-xs-12">
              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
              <span class="input-group-append">
                <button class="file-upload-browse btn btn-primary" type="button">@lang('upload')</button>
              </span>
            </div>
          </div>
          <div class="form-group col-6">
            <label>@lang('countries')</label>
            <select name="countries" id="country" class="form-control">
              <option value="">@lang('select')</option>
              @foreach ($countries as $id => $name)
              <option value="{{$id}}" {{$id==old('countries')? 'selected':''}}>{{trans($name)}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group col-6">
            <label>@lang("city")</label>
            <input type="text" class="form-control" name='city' value="{{old('city')}}">
          </div>
          <div class="form-group col-6">
            <label>@lang("address")</label>
            <input type="text" class="form-control" name='address' value="{{old('address')}}">
          </div>

          <div class="form-group col-6">
            <label>@lang("instagram")</label>
            <input type="text" class="form-control" name='instagram' value="{{old('instagram')}}">
          </div>

          <div class="form-group col-6">
            <label>@lang("twitter")</label>
            <input type="text" class="form-control" name='twitter' value="{{old('twitter')}}">
          </div>
          <div class="form-group col-6">
            <label>@lang('password')</label>
            <input type="password" class="form-control" placeholder="@lang('password')" name="password">
          </div>
          <div class="form-group col-6">
            <label>@lang('password_confirmation')</label>
            <input type="password" class="form-control" placeholder="@lang('password_confirmation')"
              name="password_confirmation">
          </div>
          <div class="form-group col-6">
            <label>@lang("current job")</label>
            <input type="text" class="form-control" name='current_job' value="{{old('current_job')}}">
          </div>

          <div class="form-group col-6">
            <label>@lang('body shape')</label>
            <select name="body_shape" class="form-control" name="body_shape">
              <option value="">@lang('select')</option>
              <option value="slim" {{old('body_shape')=='slim' ?'selected':''}}>@lang('slim')</option>
              <option value="sportsman" {{old('body_shape')=='sportsman' ?'selected':''}}>@lang('sportsman')</option>
              <option value="Stretchy muscles" {{old('body_shape')=='Stretchy muscles' ?'selected':''}}>@lang('Stretchy_muscles')</option>
              <option value="Medium build" {{old('body_shape')=='Medium build' ?'selected':''}}>@lang('Medium_build')</option>
              <option value="Slightly overweight" {{old('body_shape')=='Slightly overweight' ?'selected':''}}>@lang('Slightly_overweight')</option>
              <option value="overweight" {{old('body_shape')=='overweight' ?'selected':''}}>@lang('overweight')</option>
            </select>
          </div>
          <div class="form-group col-6">
            <label>@lang("reason to join us")</label>
            <textarea class="form-control" name='join_request_reason'>{{old('join_request_reason')}}</textarea>
          </div>
          <div class="form-group col-6">
            <label>@lang("bio")</label>
            <textarea class="form-control" name='bio'>{{old('bio')}}</textarea>
          </div>
          <div class="form-group col-6">
            <label>@lang('is licensed?')</label>
            <select name="is_certified" class="form-control" id="license">
              <option value="">@lang('select')</option>
              <option value="1" {{old('is_certified')==1 ?'selected':''}}>@lang('yes')</option>
              <option value="0" {{old('is_certified')==0 ?'selected':''}}>@lang('no')</option>
            </select>
          </div>
          <div class="form-group col-6" id="license_img">
            <label>@lang('licensed_image')</label>
            <input type="file" name="confidental_image" class="file-upload-default" id="image" value="{{old('confidental_image')}}">
            <div class="input-group col-xs-12">
              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
              <span class="input-group-append">
                <button class="file-upload-browse btn btn-primary" type="button">@lang('upload')</button>
              </span>
            </div>
          </div>

          <div class="form-group col-6">
            <label>@lang('cv')</label>
            <input type="file" name="cv" class="file-upload-default" id="image" value="{{old('cv')}}">
            <div class="input-group col-xs-12">
              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image" >
              <span class="input-group-append">
                <button class="file-upload-browse btn btn-primary" type="button">@lang('upload')</button>
              </span>
            </div>
          </div>

          <div class="form-group col-6">
            <label>@lang('show in our trainer page')</label>
            <select name="show_inPage" class="form-control">
              <option value="">@lang('select')</option>
              <option value="1" {{old('show_inPage')==1 ?'selected':''}}>@lang('active')</option>
              <option value="0" {{old('show_inPage')==0 ?'selected':''}}>@lang('inactive')</option>
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
</div>

@endsection
@section('scripts')
<script>
  $("#license_img").hide();
  $("#license").change(function () {
    var selected_option = $('#license').val();
    if (selected_option == 1) {
      $('#license_img').show();
    }
    if (selected_option != 1) {
      $("#license_img").hide();
    }
  })
</script>
@endsection
