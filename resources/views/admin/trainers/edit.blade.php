@extends('admin.app')
@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="container">
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
            <input type="text" class="form-control" name='first_name' value="{{$trainer->user->first_name}}">
          </div>
          <div class="form-group col-6">
            <label>@lang("last_name")</label>
            <input type="text" class="form-control" name='last_name' value="{{$trainer->user->last_name}}">
          </div>
          <div class="form-group col-6">
            <label>@lang("phone")</label>
            <input type="text" class="form-control" name='phone' value="{{$trainer->user->phone}}">
          </div>
          <div class="form-group col-6">
            <label>@lang("email")</label>
            <input type="email" class="form-control" name='email' value="{{$trainer->user->email}}">
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
              <option value="{{$id}}" {{$id==$trainer->user->country_id ?'selected': '' }}>{{trans($name)}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group col-6">
            <label>@lang('states')</label>
            <select name="states" id='state' class="form-control">
              @foreach ($states as $id => $name)
              <option value="{{$id}}" {{$id==$trainer->user->state_id ?'selected': '' }}>{{trans($name)}}</option>

              @endforeach
            </select>
          </div>

          <div class="form-group col-6">
            <label>@lang("address")</label>
            <input type="text" class="form-control" name='address' value="{{$trainer->user->address}}">
          </div>

          <div class="form-group col-6">
            <label>@lang("instagram")</label>
            <input type="text" class="form-control" name='instagram' value="{{$trainer->user->instagram}}">
          </div>

          <div class="form-group col-6">
            <label>@lang("twitter")</label>
            <input type="text" class="form-control" name='twitter' value="{{$trainer->user->twitter}}">
          </div>

          <div class="form-group col-6">
            <label>@lang("current job")</label>
            <input type="text" class="form-control" name='current_job' value="{{$trainer->current_job}}">
          </div>

          <div class="form-group col-6">
            <label>@lang('body shape')</label>
            <select name="body_shape" class="form-control" name="body_shape">
              <option value="">@lang('select')</option>
              <option value="slim" {{'slim'==$trainer->body_shape ?'selected': '' }} >@lang('slim')</option>
              <option value="sportsman" {{'sportsman'==$trainer->body_shape ?'selected': '' }}>@lang('sportsman')
              </option>
              <option value="Stretchy muscles" {{'Stretchy muscles'==$trainer->body_shape ?'selected': ''
                }}>@lang('Stretchy_muscles')</option>
              <option value="Medium build" {{'Medium build'==$trainer->body_shape ?'selected': '' }}>
                @lang('Medium_build')</option>
              <option value="Slightly overweight" {{'Slightly overweight'==$trainer->body_shape ?'selected': '' }}
                >@lang('Slightly_overweight')</option>
              <option value="overweight" {{'overweight'==$trainer->body_shape ?'selected': '' }}>@lang('overweight')
              </option>
            </select>
          </div>
          <div class="form-group col-6">
            <label>@lang("reason to join us")</label>
            <textarea class="form-control" name='join_request_reason'>{{$trainer->join_request_reason}}</textarea>
          </div>
          <div class="form-group col-6">
            <label>@lang("bio")</label>
            <textarea class="form-control" name='bio'>{{$trainer->bio}}</textarea>
          </div>
          <div class="form-group col-6">
            <label>@lang('is licensed?')</label>
            <select name="is_certified" class="form-control">
              <option value="">@lang('select')</option>
              <option value="1" {{$trainer->is_certified == 1 ?'selected':''}} >@lang('yes')</option>
              <option value="0" {{$trainer->is_certified == 0 ?'selected':''}}>@lang('no')</option>
            </select>
          </div>
          <div class="form-group col-6">
            <label>@lang('licensed_image')</label>
            <label>@lang('select_image')</label>
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
              <option value="1" {{ $trainer->show_inPage == 1 ?'selected': '' }} >@lang('active')</option>
              <option value="0" {{ $trainer->show_inPage == 0 ?'selected': '' }}>@lang('in_active')</option>
            </select>
          </div>
          <div class="form-group col-6">
            <label>@lang('status')</label>
            <select name="status" class="form-control">
              <option value="">@lang('select')</option>
              <option value="DONE" {{ $trainer->status == 'DONE' ?'selected': '' }}>@lang('active')</option>
              <option value="PENDING" {{ $trainer->status == 'PENDING' ?'selected': '' }}>@lang('in active')</option>
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
        // console.log(idCountry);
        $("#state").html('');
        $.ajax({
          url: "{{url('http://127.0.0.1:8000/states')}}",
          method: "POST",
          data: {
            country_id: country_id,
            "_token": $('#token').val()
          },
          dataType: 'json',
          success: function (result) {
            // console.log(result);
            $('#state').html('<option value="">-- Select State --</option>');
            $.each(result, function (key, value) {
              console.log(key,value)
              $("#state").append('<option value="' + key + '">' + value + '</option>');

            });

          }

        })
      });
    });


</script>
@endsection
