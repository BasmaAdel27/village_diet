@extends('website.layout')

@section('content')

<section class="sub-header">
  <div class="container general-pattern right-left-pattern">
    <div class="heading">
{{--      <h1>--}}
{{--        @lang("contact us")--}}
{{--      </h1>--}}

{{--      <p>--}}
{{--        @lang('contact_desc')--}}
{{--      </p>--}}
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
              @lang("contact_with_village")
            </h1>
          </div>

          <form action="{{route('website.contact_us.store')}}" class="form-contain" method="post">
            @csrf
            <div class="row">
              <div class="col-lg-6 col-12 px-2">
                <div class="form-group">
                  <img src="{{asset('website/assets/images/form/user.svg')}}" class="icon" loading="lazy" alt="" />

                  <input type="text" class="form-control" name="full_name" placeholder="@lang('full_name')" />
                </div>
              </div>

              <div class="col-lg-6 col-12 px-2">
                <div class="form-group select">
                  <img src="{{asset('website/assets/images/form/user.svg')}}" class="icon" loading="lazy" alt="" />

                  <select class="form-control" name="user_type" id="">
                    <option value="" hidden>
                      @lang('user_type')
                    </option>

                    <option value="trainer">
                      @lang('trainer')
                    </option>

                    <option value="user">
                      @lang('user')
                    </option>
                  </select>
                </div>
              </div>

              <div class="col-lg-6 col-12 px-2">
                <div class="form-group">
                  <img src="{{asset('website/assets/images/form/sms.svg')}}" class="icon" loading="lazy" alt="" />

                  <input type="text" class="form-control" name="email" placeholder="@lang('email')" />
                </div>
              </div>

              <div class="col-lg-6 col-12 px-2">
                <div class="form-group select">
                  <img src="{{asset('website/assets/images/form/user.svg')}}" class="icon" loading="lazy" alt="" />

                  <select class="form-control" name="message_type" id="">
                    <option value="" hidden>
                      @lang('message_address')
                    </option>

                    <option value="complaint">
                      @lang('complaint')
                    </option>

                    <option value="inquiry">
                      @lang('inquiry')
                    </option>
                    <option value="suggestion">
                      @lang('suggestion')
                    </option>
                  </select>
                </div>
              </div>

              <div class="col-12">
                <div class="form-group text-area">
                  <textarea name="content" class="form-control" placeholder="@lang('message_content')..." cols="30"
                    rows="10"></textarea>
                </div>
              </div>
            </div>

            <div class="button-contain">
              <button type="submit" class="custom-btn">
                <img src="{{asset('website/assets/images/icons/arrow.svg')}}" loading="lazy" alt="" />

                <span>
                  @lang('send_message')
                </span>
              </button>
            </div>
          </form>
        </div>


        <div class="contact-info">
          <div class="row">
            <div class="col-lg-4 col-12 mb-3">
              <a href="mailto:{{$setting->email}}">
                <img src="{{asset('website/assets/images/contact/message.svg')}}" loading="lazy" alt="" />

                <div>
                  <h2>
                    @lang('email')
                  </h2>

                  <p>
                    {{$setting->email}}
                  </p>
                </div>
              </a>
            </div>

            <div class="col-lg-4 col-12 mb-3">
              <a href="https://api.whatsapp.com/send?phone={{$setting->whatsapp_number}}" class="padding">
                <img src="{{asset('website/assets/images/contact/whatsapp.svg')}}" loading="lazy" alt="" />

                <div>
                  <h2>
                    @lang('whatsapp_number')
                  </h2>

                  <p>
                    {{$setting->whatsapp_number}}
                  </p>
                </div>
              </a>
            </div>

            <div class="col-lg-4 col-12 mb-3">
              <a href="tel:{{$setting->phone}}">
                <img src="{{asset('website/assets/images/contact/call.svg')}}" loading="lazy" alt="" />

                <div>
                  <h2>
                    @lang('phone')
                  </h2>

                  <p>
                    {{$setting->phone}}
                  </p>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
