@extends('website.layout')

@section('content')

<section class="form-page">
  <div class="conatiner">
    <div class="row">
      <div class="col-lg-8 col-12 mx-auto">
        <div class="contain">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" id="tab-1-tab" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1"
                aria-selected="true">
                @lang('register')
              </a>
            </li>

            <li class="nav-item" role="presentation">
              <a class="nav-link" id="tab-2-tab" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2"
                aria-selected="false">
                @lang('resubscribe')
              </a>
            </li>
          </ul>

          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab-1-tab">
              <div class="heading">
                <h1>
                  @lang('register')
                </h1>

                <p>
                  @lang('if_you_join_village_for_first_time')
                </p>
              </div>

              <form action="{{ route('website.register.store') }}" class="form-contain" method="POST" id="registerForm">
                @csrf
                <h2 class="sub-title">
                  @lang('primary_information')
                </h2>

                <div class="row">
                  <div class="col-lg-6 col-12 px-2">
                    <div class="form-group">
                      <img src="{{ asset('website/assets/images/form/user.svg') }}" class="icon" loading="lazy"
                        alt="" />

                      <input type="text" name="first_name" value="{{ old('first_name') ?? '' }}"
                        class="form-control @error('first_name') is-invalid @enderror"
                        placeholder="@lang('first_name')" />
                      @error('first_name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6 col-12 px-2">
                    <div class="form-group">
                      <img src="{{ asset('website/assets/images/form/user.svg') }}" class="icon" loading="lazy"
                        alt="" />

                      <input type="text" name="last_name" value="{{ old('last_name') ?? '' }}"
                        class="form-control @error('first_name') is-invalid @enderror"
                        placeholder="@lang('last_name')" />
                      @error('last_name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6 col-12 px-2">
                    <div class="form-group">
                      <img src="{{ asset('website/assets/images/form/sms.svg') }}" class="icon" loading="lazy" alt="" />
                      <input type="text" name="email" value="{{ old('email') ?? '' }}"
                        class="form-control @error('email') is-invalid @enderror" placeholder="@lang('email')" />
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6 col-12 px-2">
                    <div class="form-group">
                      <img src="{{ asset('website/assets/images/form/sms.svg') }}" class="icon" loading="lazy" alt="" />

                      <input type="text" value="{{ old('email_confirmation') ?? '' }}" name="email_confirmation"
                        class="form-control @error('email_confirmation') is-invalid @enderror"
                        placeholder="@lang('email_confirmation')" />
                      @error('email_confirmation')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6 col-12 px-2">
                    <div class="form-group">
                      <img src="{{ asset('website/assets/images/form/phone.svg') }}" class="icon" loading="lazy"
                        alt="" />

                      <input type="tel" value="{{ old('phone') ?? '' }}" name="phone"
                        class="form-control @error('email_confirmation') is-invalid @enderror"
                        placeholder="@lang('phone')" />
                      @error('phone')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6 col-12 px-2">
                    <div class="form-group">
                      <img src="{{ asset('website/assets/images/form/calendar.svg') }}" class="icon" loading="lazy"
                        alt="" />
                      <input type="date" name="date_of_birth"
                        class="form-control @error('date_of_birth') is-invalid @enderror"
                        placeholder="@lang('date_of_birth')" dir="rtl" />
                      @error('date_of_birth')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                </div>

                <h2 class=" sub-title section-contain">
                  @lang('address_info')
                </h2>

                <div class="row">
                  <div class="col-lg-6 col-12 px-2">
                    <div class="form-group select">
                      <img src="{{ asset('website/assets/images/form/flag.svg') }}" class="icon" loading="lazy"
                        alt="" />
                      <select class="form-control @error('country_id') is-invalid @enderror" name="country_id"
                        id="country">
                        <option value="" hidden>
                          @lang('country')
                        </option>
                        @foreach ($countries as $id => $name)
                        <option value="{{ $id }}" {{ $id==old('country_id') ? 'selected' : '' }}>{{ $name }}
                        </option>
                        @endforeach
                      </select>
                      @error('country_id')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-6 col-12 px-2">
                    <div class="form-group">
                      <img src="{{ asset('website/assets/images/form/location.svg') }}" class="icon" loading="lazy"
                        alt="" />
                      <input type="text" value="{{ old('city') }}" name="city"
                        class="form-control @error('city') is-invalid @enderror" placeholder="@lang('city')" />
                      @error('city')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group text-area no-margin">
                      <textarea name="address" class="form-control @error('address') is-invalid @enderror"
                        placeholder="@lang('address')" id="" cols="30" rows="10">
                      {{ old('address') ?? '' }}
                      </textarea>
                      @error('address')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                </div>

                <h2 class="sub-title section-contain">
                  @lang('social_accounts')
                </h2>

                <div class="form-group">
                  <img src="{{ asset('website/assets/images/form/instagram_twotone.svg') }}" loading="lazy" alt=""
                    class="icon" />

                  <input type="text" value="{{ old('insta_link') ?? '' }}" name="insta_link"
                    class="form-control @error('insta_link') is-invalid @enderror" placeholder="@lang('instagram')" />
                  @error('insta_link')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

                <div class="section-seprate">
                  <div class="wrapper">
                    <input type="radio" value="1" name="is_postal" class="radio-check" />
                    <label class="radio-title bold-text">
                      @lang('join_news_letters')
                    </label>
                  </div>
                </div>

                <div class="message">
                  <img src="{{ asset('website/assets/images/form/system.svg') }}" loading="lazy" alt="" />

                  <p>
                    @lang('system_append_on_automatic_rejoin')
                  </p>
                </div>

                <div class="button-contain">
                  <a href="#!" type="button" class="custom-btn" onclick="$('#registerForm').submit()">
                    <img src="{{ asset('website/assets/images/icons/arrow.svg') }}" loading="lazy" alt="" />
                    <span>
                      @lang('register')
                    </span>
                  </a>
                </div>
              </form>
            </div>

            <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab-2-tab">
              <div class="heading">
                <h1>
                  @lang('resubscribe')
                </h1>
                <p>
                  @lang('messages_welcome')
                </p>
              </div>
              <form action="{{ route('website.renew') }}" method="POST" class="form-contain">@csrf
                <div class="form-group">
                  <img src="{{ asset('website/assets/images/form/idnoac.svg') }}" class="icon" loading="lazy" alt="" />
                  <input type="text" name="user_number" class="form-control" placeholder="@lang('user_number')" />
                </div>
                <div class="button-contain">
                  <a href="#" type="button" class="custom-btn" id="submit_renew">
                    <img src="{{ asset('website/assets/images/icons/arrow.svg') }}" loading="lazy" alt="" />
                    <span>
                      @lang('renew')
                    </span>
                  </a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="renew_subscription" tabindex="-1" aria-labelledby="renew_subscription" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div class="contain">
          <div class="pop-icon red">
            <img src="{{ asset('website/assets/images/popup/suspended.svg') }}" loading="lazy" alt="" />
          </div>
          <h1 id="title">
          </h1>
          <p id="message">
          </p>
          <div class="button-contain">
            <a href="{{ route('home') }}" class="custom-btn">
              <img src="{{ asset('website/assets/images/icons/arrow.svg') }}" loading="lazy" alt="" />
              <span>
                @lang('continue')
              </span>
            </a>
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
      $('#submit_renew').on('click',function(){
        form = $(this).closest('form');
        $.ajax({
          url: $(form).attr('action'),
          type: $(form).attr('method'),
          data : $(form).serialize(),
          success: function (result) {
            if(result.status == 'in_active'){
              window.location.href = result.message;
            }
            $('#title').text(result.title)
            $('#message').text(result.message)
            $('#renew_subscription').modal('show')
          }

        })

      });
    });
</script>
@endsection
