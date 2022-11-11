@extends('website.layout')

@section('content')

<section class="sub-header">
  <div class="container general-pattern right-left-pattern">
    <div class="heading">
      <h1>
        @lang("contact us")
      </h1>

      <p>
        @lang('contact_desc')
      </p>
    </div>
  </div>
</section>

<section class="form-page">
  <div class="conatiner">
    <div class="row">
      <div class="col-lg-6 col-12 mx-auto">
        <div class="contain">
          <div class="heading no-top-margin">
            <h1>
              @lang('sending_message')
            </h1>

            <p>
              @lang("contactus_desc")
            </p>
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
                  <textarea name="content" class="form-control" placeholder="@lang('message_content')..." id="" cols="30"
                    rows="10"></textarea>
                </div>
              </div>
            </div>

            <div class="button-contain">
              <button   type="submit" class="custom-btn" data-toggle="modal" data-target="#popdone">
                <img src="{{asset('website/assets/images/icons/arrow.svg')}}" loading="lazy" alt="" />

                <span>
                  @lang('send_message')
                </span>
              </button>
            </div>
          </form>
        </div>
        <div class="map-contain">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d54708.5528184499!2d{{$setting->longitude}}!3d{{$setting->latitude}}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2seg!4v1667855570043!5m2!1sen!2seg"
            style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" ></iframe>
        </div>

        <div class="contact-info">
          <div class="row">
            <div class="col-lg-4 col-12 mb-3">
              <a href="#">
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
              <a href="#" class="padding">
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
              <a href="#">
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
