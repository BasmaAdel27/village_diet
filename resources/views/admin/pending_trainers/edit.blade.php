@extends('admin.app')
@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title')@lang('pending trainers')@endsection
@section('content')

  <div class="card mt-5">
    <div class="card-header d-flex justify-content-between">
      <h2 class="mb-4">@lang('pending_trainers')</h2>
      <a href="{{ route('admin.pending-trainers.index') }}"
        class="btn btn-outline-dark btn-lg font-weight-bold">@lang('back')</a>
    </div>
    <div class="card-body table-responsive">
      <div class="row">
        <div class="form-group col-6">
          <label>@lang("first_name")</label>
          <input type="text" class="form-control" name='first_name' value="{{$trainer->user->first_name}}" disabled>
        </div>
        <div class="form-group col-6">
          <label>@lang("last_name")</label>
          <input type="text" class="form-control" name='last_name' value="{{$trainer->user->last_name}}" disabled>
        </div>
        <div class="form-group col-6">
          <label>@lang("phone")</label>
          <input type="text" class="form-control" name='phone' value="{{$trainer->user->phone}}" disabled>
        </div>
        <div class="form-group col-6">
          <label>@lang("email")</label>
          <input type="email" class="form-control" name='email' value="{{$trainer->user->email}}" disabled>
        </div>
        <div class="form-group col-6">
          <label>@lang('personal image')</label>
          <img src="{{$trainer->user->getImageAttribute()}}" height="100px" width="100px">
        </div>
        <div class="form-group col-6">
          <label>@lang('countries')</label>
          <select name="countries" id="country2" class="form-control" disabled>
            <option value="">@lang('select')</option>
            @foreach ($countries as $id => $name)
            <option value="{{$id}}" {{$id==$trainer->user->country_id ?'selected': '' }}>{{trans($name)}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group col-6">
          <label>@lang('states')</label>
          <select name="states" id='state2' class="form-control" disabled>
            @foreach ($states as $id => $name)
            <option value="{{$id}}" {{$id==$trainer->user->state_id ?'selected': '' }}>{{trans($name)}}</option>

            @endforeach
          </select>
        </div>

        <div class="form-group col-6">
          <label>@lang("address")</label>
          <input type="text" class="form-control" name='address' value="{{$trainer->user->address}}" disabled>
        </div>

        <div class="form-group col-6">
          <label>@lang("instagram")</label>
          <input type="text" class="form-control" name='instagram' value="{{$trainer->user->insta_link}}" disabled>
        </div>

        <div class="form-group col-6">
          <label>@lang("twitter")</label>
          <input type="text" class="form-control" name='twitter' value="{{$trainer->user->twitter_link}}" disabled>
        </div>

        <div class="form-group col-6">
          <label>@lang("current job")</label>
          <input type="text" class="form-control" name='current_job' value="{{$trainer->current_job}}" disabled>
        </div>

        <div class="form-group col-6">
          <label>@lang('body shape')</label>
          <select name="body_shape" class="form-control" name="body_shape" disabled>
            <option value="">@lang('select')</option>
            <option value="slim" {{'slim'==$trainer->body_shape ?'selected': '' }} >@lang('slim')</option>
            <option value="sportsman" {{'sportsman'==$trainer->body_shape ?'selected': '' }}>@lang('sportsman')</option>
            <option value="Stretchy muscles" {{'Stretchy muscles'==$trainer->body_shape ?'selected': ''
              }}>@lang('Stretchy muscles')</option>
            <option value="Medium build" {{'Medium build'==$trainer->body_shape ?'selected': '' }}>@lang('Medium build')
            </option>
            <option value="Slightly overweight" {{'Slightly overweight'==$trainer->body_shape ?'selected': '' }}
              >@lang('Slightly overweight')</option>
            <option value="overweight" {{'overweight'==$trainer->body_shape ?'selected': '' }}>@lang('overweight')
            </option>
          </select>
        </div>
        <div class="form-group col-6">
          <label>@lang("reason to join us")</label>
          <textarea class="form-control" name='join_request_reason'
            disabled>{{$trainer->join_request_reason}}</textarea>
        </div>
        <div class="form-group col-6">
          <label>@lang("bio")</label>
          <textarea class="form-control" name='bio' disabled>{{$trainer->bio}}</textarea>
        </div>
        <div class="form-group col-6">
          <label>@lang('is licensed?')</label>
          <select name="is_certified" class="form-control" disabled>
            <option value="">@lang('select')</option>
            <option value="1" {{$trainer->is_certified == 1 ?'selected':''}} >@lang('yes')</option>
            <option value="0" {{$trainer->is_certified == 0 ?'selected':''}}>@lang('no')</option>
          </select>
        </div>
        <div class="form-group col-6">
          <label>@lang('licensed_image')</label>
          <a href="{{$trainer->getImageAttribute()}}" target="_blank"><img src="{{$trainer->getImageAttribute()}}"
              height="100px" width="100px"></a>
        </div>

        <div class="form-group col-6">
          <label>@lang('show in our trainer page')</label>
          <select name="show_inPage" class="form-control" disabled>
            <option value="">@lang('select')</option>
            <option value="1" {{ $trainer->show_inPage == 1 ?'selected': '' }} >@lang('active')</option>
            <option value="0" {{ $trainer->show_inPage == 0 ?'selected': '' }}>@lang('inactive')</option>
          </select>
        </div>
        <div class="form-group col-6">
          <label>@lang('status')</label>
          <select name="status" class="form-control" disabled>
            <option value="">@lang('select')</option>
            <option value="DONE" {{ $trainer->status == 'DONE' ?'selected': '' }}>@lang('active')</option>
            <option value="PENDING" {{ $trainer->status == 'PENDING' ?'selected': '' }}>@lang('inactive')</option>
          </select>
        </div>
        <div class="form-group col-6">
          <a href="{{$trainer->getCvAttribute()}}">@lang('my resume')</a>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-6">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
              @lang('ok')
          </button>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="post" action="{{route('admin.pending-trainers.submit',$trainer->id)}}">
                  @csrf
                <div class="modal-body">

                  <div class="row">
                    <div class="form-group col-12">
                      <label>@lang('email')</label>
                      <input type="email" name="email" class="form-control" value="{{$trainer->user->email}}">
                    </div>
                    <div class="form-group col-6">
                      <label>@lang("password")</label>
                      <input type="password" class="form-control" name='password' id="password">
                    </div>
                    <div class="form-group col-6">
                      <span id="generatePass" onclick="password()"  class="btn btn-success" name='generate_password' style="margin: 32px;">@lang('generate code')</span>
                    </div>

                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('close')</button>

                  <input type="submit" class="btn btn-dark"  value="@lang('submit')">
                </div>
                </form>

              </div>
            </div>
          </div>
        </div>

        <div class="form-group col-6">
          <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#decline">
            @lang('decline')
          </button>
          <div class="modal fade" id="decline" tabindex="-1" aria-labelledby="exampleLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="post" action="{{route('admin.pending-trainers.declined',$trainer->id)}}">
                  @csrf
                  <div class="modal-body">

                    <div class="row">
                      <div class="form-group col-12">
                        <label>@lang('decline_reason')</label>
                        <textarea class="form-control" name="reason"></textarea>
                      </div>

                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('close')</button>

                    <input type="submit" class="btn btn-dark"  value="@lang('decline')">
                  </div>
                </form>

              </div>
            </div>
          </div>

        </div>
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

  function password() {
    var generate = document.getElementById('generatePass');
    var text = "";
    var possible = "AB0123456789CDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    for (var i = 0; i < 8; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length));
    document.getElementById('password').value=text;

  }

</script>
@endsection
