@extends('website.layout')

@section('content')

<section class="sub-header">
  <div class="container general-pattern right-left-pattern">
    <div class="heading">
      <h1>
        @lang('register_as_trainer')
      </h1>

    </div>
  </div>
</section>

<section class="form-page">
  <div class="conatiner">
    <div class="row">
      <div class="col-lg-8 col-12 mx-auto">
        <div class="contain">
          <div class="heading no-top-margin">
            <h1>
              @lang('register_as_trainer')
            </h1>
            <p>
              @lang('trainer_desc')
            </p>
          </div>
          <form method="post" enctype="multipart/form-data" class="form-contain" id="form"
            action="register_trainer/store">
            @csrf
            <h2 class="sub-title">
              @lang('basic_informations')
            </h2>
            <div class="row">
              <div class="col-lg-6 col-12 px-2 py-3">
                <div class="form-group">
                  <img src="{{ asset('website/assets/images/form/user.svg') }}" class="icon" loading="lazy" alt="" />

                  <input type="text" class="form-control" placeholder="@lang('first_name')"
                    value="{{old('first_name')}}" name="first_name" />
                </div>
              </div>
              <div class="col-lg-6 col-12 px-2 py-3">
                <div class="form-group">
                  <img src="{{ asset('website/assets/images/form/user.svg') }}" class="icon" loading="lazy" alt="" />
                  <input type="text" class="form-control" placeholder="@lang('last_name')" name="last_name"
                    value="{{old('last_name')}}" />
                </div>
              </div>
              <div class="col-lg-6 col-12 px-2 py-3">
                <div class="form-group">
                  <img src="{{ asset('website/assets/images/form/sms.svg') }}" class="icon" loading="lazy" alt="" />
                  <input type="text" class="form-control" placeholder="@lang('email')" name="email"
                    value="{{old('email')}}" />
                </div>
              </div>
              <div class="col-lg-6 col-12 px-2 py-3">
                <div class="form-group">
                  <img src="{{ asset('website/assets/images/form/phone.svg') }}" class="icon" loading="lazy" alt="" />
                  <input type="tel" value="{{ old('phone') ?? '' }}" name="phone" class="form-control"
                    placeholder="@lang('phone')" />
                </div>
              </div>
              <div class="col-lg-12 col-12 px-2">
                <div class="form-group">
                  <img src="{{ asset('website/assets/images/form/idnoac.svg') }}" class="icon" loading="lazy" alt="" />
                  <input type="text" class="form-control" placeholder="@lang('current_job')" name="current_job"
                    value="{{old('current_job')}}" />
                </div>
              </div>
              <div class="col-lg-6 col-12 px-2 py-3">
                <div class="form-data">
                  <label for="">
                    @lang('image')
                  </label>
                  <div class="file-upload">
                    <input type="file" name="image" id="uploadFile" value="{{old('image')}}" />
                    <label for="uploadFile" class="file-upload-section">
                      <img src="{{ asset('website/assets/images/form/document_upload.svg') }}" alt="">
                      <h2>
                        @lang('attach_image')
                      </h2>
                      <p>
                        @lang('max_size') : 2MB
                      </p>
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-12 px-2 py-3">
                <div class="form-data">
                  <label for="">
                    @lang('cv')
                  </label>
                  <div class="file-upload">
                    <input type="file" name="cv" id="uploadFile2" value="{{old('cv')}}" />
                    <label for="uploadFile2" class="file-upload-section">
                      <img src="{{ asset('website/assets/images/form/document_upload.svg') }}" alt="">
                      <h2>
                        @lang('attach_cv')
                      </h2>
                      <p>
                        @lang('pdf_or_word')
                      </p>
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group text-area">
                  <textarea name="bio" class="form-control" placeholder=" @lang('write_about') ... " id="" cols="30"
                    rows="10">{{old('bio')}}</textarea>
                </div>
              </div>
            </div>
            <h2 class="sub-title section-contain">
              @lang('location_information')
            </h2>
            <div class="row">
              <div class="col-lg-6 col-12 px-2 py-3">
                <div class="form-group select">
                  <img src="{{ asset('website/assets/images/form/flag.svg') }}" class="icon" loading="lazy" alt="" />
                  <select class="form-control" name="country_id" id="country">
                    <option value="" hidden>
                      @lang('country')
                    </option>
                    @foreach ($countries as $id => $name)
                    <option value="{{$id}}" {{$id==old('country_id') ? 'selected' :''}}>{{trans($name)}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-lg-6 col-12 px-2 py-3">
                <div class="form-group  state">
                  <img src="{{ asset('website/assets/images/form/location.svg') }}" class="icon" loading="lazy"
                    alt="" />
                  <input type="text" name="city" class="form-control" value="" placeholder="@lang('city')"
                    value="{{old('city')}}">
                  </select>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group text-area no-margin">
                  <textarea name="address" class="form-control" placeholder=" ... @lang('detailed_address')" id=""
                    cols="30" rows="10">{{old('address')}}</textarea>
                </div>
              </div>
            </div>
            <h2 class="sub-title section-contain">
              @lang('social_media_accounts')
            </h2>
            <div class="row">
              <div class="col-lg-6 col-12 px-2 py-3">
                <div class="form-group">
                  <img src="{{ asset('website/assets/images/form/instagram_twotone.svg') }}" loading="lazy" alt=""
                    class="icon" />
                  <input type="text" class="form-control" name="instagram" placeholder="@lang('instagram')"
                    value="{{old('instagram')}}" />
                </div>
              </div>
              <div class="col-lg-6 col-12 px-2 py-3">
                <div class="form-group">
                  <img src="{{ asset('website/assets/images/form/twitter.svg') }}" loading="lazy" alt="" class="icon" />

                  <input type="text" class="form-control" name="twitter" placeholder="@lang('twitter')"
                    value="{{old('twitter')}}" />
                </div>
              </div>
            </div>
            <h2 class="sub-title section-contain">
              @lang('body shape')
            </h2>
            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" name="body_shape" value="slim" {{old('body_shape')=='slim'
                ? 'checked' :''}} />
              <label class="radio-title">
                @lang('slim')
              </label>
            </div>
            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" name="body_shape" value="sportsman"
                {{old('body_shape')=='sportsman' ? 'checked' :''}} />
              <label class="radio-title">
                @lang('sportsman')
              </label>
            </div>
            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" name="body_shape" value="Stretchy muscles"
                {{old('body_shape')=='Stretchy muscles' ? 'checked' :''}} />

              <label class="radio-title">
                @lang('Stretchy_muscles')
              </label>
            </div>
            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" name="body_shape" value="Medium build"
                {{old('body_shape')=='Medium build' ? 'checked' :''}} />

              <label class="radio-title">
                @lang('Medium_build')
              </label>
            </div>
            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" name="body_shape" vlaue="Slightly overweight"
                {{old('body_shape')=='Slightly overweight' ? 'checked' :''}} />

              <label class="radio-title">
                @lang('Slightly_overweight')
              </label>
            </div>
            <div class="wrapper mb-1">
              <input type="radio" class="radio-check" name="body_shape" value="overweight"
                {{old('body_shape')=='overweight' ? 'checked' :''}} />
              <label class="radio-title">
                @lang('overweight')
              </label>
            </div>
            <h3 class="sub-head">
              @lang('is licensed?')
            </h3>
            <div class="flex-data">
              <div class="wrapper mb-1">
                <input type="radio" class="radio-check" name="is_certified" value="1" id="license"
                  {{old('is_certified')==1 ? 'checked' :''}} />

                <label class="radio-title">
                  @lang('yes')
                </label>
              </div>
              <div class="wrapper mb-1">
                <input type="radio" class="radio-check" name="is_certified" value="0" id="license1"
                  {{old('is_certified')==0 ? 'checked' :''}} />
                <label class="radio-title">
                  @lang('no')
                </label>
              </div>
            </div>
            <div class="form-data" id="license_img">
              <label for="">
                @lang('licensed_image')
              </label>
              <div class="file-upload">
                <input type="file" name="confidental_image" id="uploadFile3" value="{{old('confidental_image')}}" />
                <label for="uploadFile3" class="file-upload-section">
                  <img src="{{ asset('website/assets/images/form/document_upload.svg') }}" alt="">
                  <h2>
                    @lang('attach_confidental_image')
                  </h2>
                  <p>
                    @lang('max_size') : 2MB
                  </p>
                </label>
              </div>
            </div>
            <div class="form-group text-area">
              <textarea name="join_request_reason" class="form-control" placeholder=" @lang(" reason to join
                us").... " id="" cols=" 30" rows="10">{{old('join_request_reason')}}</textarea>
            </div>

            <div class="button-contain">
              <button type="submit" class="custom-btn" data-toggle="modal" id="btn-job-submit">
                <img src="{{ asset('website/assets/images/icons/arrow.svg') }}" loading="lazy" alt="" />
                <span>
                  @lang('register')
                </span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
@section('scripts')
<script>
  $(document).ready(function () {
      $("#license_img").hide();
      $("input[name$='is_certified']").click(function() {
        var test = $(this).val();
        if (test == 1) {
          $('#license_img').show();
        }
        if (test != 1) {
          $("#license_img").hide();
        }
      });

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $("#btn-job-submit").click(function (event) {
        var form=document.getElementById('form');
        event.preventDefault();
        var data = new FormData(form);
        $.ajax({
          type: "POST",
          url: "{{route('website.register_trainer.store')}}",
          data: data,
          success: function (data) {
            $('#popdone2').modal('show');

            $('#form')[0].reset();
          },
          contentType: false,
          processData: false,
          error: function(message,error)
          {
            $.each(message.responseJSON.errors,function(field_name,error){
              $(document).find('[name='+field_name+']')
              .not('[type="radio"]')
              .last()
              .after('<span style="width: 100%;margin-top: 0.25rem;font-size: 80%;color: #dc3545;" role="alert"><strong>'
                + error[0] +
                '</strong></span>')
            })

          }
        });

      });
    });


</script>
@endsection
