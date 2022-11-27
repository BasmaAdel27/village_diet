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
            <input type="text" class="form-control" name='first_name'>
          </div>
          <div class="form-group col-6">
            <label>@lang("last_name")</label>
            <input type="text" class="form-control" name='last_name'>
          </div>
          <div class="form-group col-6">
            <label>@lang("phone")</label>
            <input type="text" class="form-control" name='phone'>
          </div>
          <div class="form-group col-6">
            <label>@lang("email")</label>
            <input type="email" class="form-control" name='email'>
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
            <select name="countries" id="country" class="form-control">
              <option value="">@lang('select')</option>
              @foreach ($countries as $id => $name)
              <option value="{{$id}}">{{trans($name)}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group col-6">
            <label>@lang('states')</label>
            <select name="states" id='state' class="form-control">

            </select>
          </div>

          <div class="form-group col-6">
            <label>@lang("address")</label>
            <input type="text" class="form-control" name='address'>
          </div>

          <div class="form-group col-6">
            <label>@lang("instagram")</label>
            <input type="text" class="form-control" name='instagram'>
          </div>

          <div class="form-group col-6">
            <label>@lang("twitter")</label>
            <input type="text" class="form-control" name='twitter'>
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
            <input type="text" class="form-control" name='current_job'>
          </div>

          <div class="form-group col-6">
            <label>@lang('body shape')</label>
            <select name="body_shape" class="form-control" name="body_shape">
              <option value="">@lang('select')</option>
              <option value="slim">@lang('slim')</option>
              <option value="sportsman">@lang('sportsman')</option>
              <option value="Stretchy muscles">@lang('Stretchy_muscles')</option>
              <option value="Medium build">@lang('Medium_build')</option>
              <option value="Slightly overweight">@lang('Slightly_overweight')</option>
              <option value="overweight">@lang('overweight')</option>
            </select>
          </div>
          <div class="form-group col-6">
            <label>@lang("reason to join us")</label>
            <textarea class="form-control" name='join_request_reason'></textarea>
          </div>
          <div class="form-group col-6">
            <label>@lang("bio")</label>
            <textarea class="form-control" name='bio'></textarea>
          </div>
          <div class="form-group col-6">
            <label>@lang('is licensed?')</label>
            <select name="is_certified" class="form-control" id="license">
              <option value="">@lang('select')</option>
              <option value="1">@lang('yes')</option>
              <option value="0">@lang('no')</option>
            </select>
          </div>
          <div class="form-group col-6" id="license_img">
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
              <option value="1">@lang('active')</option>
              <option value="0">@lang('inactive')</option>
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
  $(document).ready(function () {
    $('#country').on('change', function () {
      var country_id = this.value;
      $("#state").html('');
      $.ajax({
        url: "{{ route('admin.states') }}",
        type : "get",
        data : {
          'country_id' : country_id
        },
        success: function (result) {
          $('#state').html('<option value="">اختر المدينة</option>');
          $.each(result, function (key, value) {
            $("#state").append('<option value="' + key + '">' + value + '</option>');

          });

        }

      })
    });
  });
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
