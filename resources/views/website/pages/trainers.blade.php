@extends('website.layout')

@section('content')

<section class="sub-header">
  <div class="container general-pattern right-left-pattern">
    <div class="heading">
{{--      <h1>--}}
{{--        @lang('trainers')--}}
{{--      </h1>--}}
    </div>
  </div>
</section>

<section class="trainer">
  <div class="container">
    <div class="heading no-top-margin">
      <h1>
        @lang("example_videos")
      </h1>
    </div>
    <div class="row">
      <div class="col-lg-4 col-12 mb-4">
        <div class="box">
          <div class="front-data">
            <iframe src="https://drive.google.com/file/d/1LgJQ5gfsyBTgeppzrevpi1_F7rWPsd_v/preview" frameborder="0"
              width="640" height="250" allow="accelerometer; autoplay; encrypted-media; gyroscope;"
              allowfullscreen></iframe>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-12 mb-4">
        <div class="box">
          <div class="front-data">
            <iframe src="https://drive.google.com/file/d/1IRUH7wYpfjCDSbYQMGNhww3RniGcpYNB/preview"" frameborder=" 0"
              width="640" height="250" allow="accelerometer; autoplay; encrypted-media; gyroscope;"
              allowfullscreen></iframe>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-12 mb-4">
        <div class="box">
          <div class="front-data">
            <iframe src="https://drive.google.com/file/d/15z27MeiEBl3_omPtunRO2r41AU_EHj2F/preview" frameborder=" 0"
              width="640" height="250" allow="accelerometer; autoplay; encrypted-media; gyroscope;"
              allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </div>

    <section class="register-now pb-5">
      <div class="container">
        <div class="contain">
          <div class="row">
            <div class="col-lg-8 col-12">
              <div class="data">
                <h1>
                  @lang('register_in')
                  <span>@lang('website_title')</span>
                </h1>
                <h3 style="color: rgba(255, 255, 255, 0.7);font-size: 16px;font-weight: 900;margin-top:20px">
                  @lang('do_you_want_join_as_trainer')
                </h3>
              </div>
            </div>

            <div class="col-lg-4 col-12">
              <div class="button-contain">
                <a href="{{ route('website.register_trainer.create') }}" class="custom-btn gray-color">
                  <span>@lang('register_now')</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="heading no-top-margin">
      <h1>
        @lang("our_trainers")
      </h1>
    </div>
    <div class="row">
      @if($trainers->isNotEmpty())
      @foreach($trainers as $trainer)
      <div class="col-lg-3 col-12 mb-4">
        <div class="box">
          <div class="front-data">
            <div class="user-img">
              <img src="{{$trainer->user->image}}" loading="lazy" alt="" />
            </div>

            <h2>
              {{$trainer->user->first_name}} {{$trainer->user->last_name}}
            </h2>
            <ul class="stars">
              @if(isset($trainer->user->ratings))
              @for ($i = 0; $i < 5; $i++) @if ($i < $trainer->user->averageRating)
                <li>
                  <a class="active">
                    <img src="{{asset('website/assets/images/trainer/stars.svg')}}" loading="lazy" alt="" />
                  </a>
                </li>
                @else
                <li>
                  <a>
                    <img src="{{asset('website/assets/images/trainer/stars.svg')}}" loading="lazy" alt="" />
                  </a>
                </li>
                @endif
                @endfor
                @else
                @for ($i = 0; $i < 5; $i++) <li>
                  <a>
                    <img src="{{asset('website/assets/images/trainer/stars.svg')}}" loading="lazy" alt="" />
                  </a>
                  </li>
                  @endfor

                  @endif
            </ul>

            <div class="custom-btn">
              @if($trainer->is_certified == 1)
              <span>
                @lang('trainer') @lang('licensed')
              </span>
              @else
              <span>
                @lang('trainer') @lang('not_licensed')
              </span>
              @endif
            </div>
          </div>

          <div class="back-data">
            <img src="{{$trainer->user->image}}" loading="lazy" class="bk-img" alt="" />

            <h2>
              {{$trainer->user->first_name}} {{$trainer->user->last_name}}
            </h2>

            <ul class="stars">
              @if(isset($trainer->user->ratings))
              @for ($i = 0; $i < 5; $i++) @if ($i < $trainer->user->averageRating)
                <li>
                  <a class="active">
                    <img src="{{asset('website/assets/images/trainer/stars.svg')}}" loading="lazy" alt="" />
                  </a>
                </li>
                @else
                <li>
                  <a>
                    <img src="{{asset('website/assets/images/trainer/stars.svg')}}" loading="lazy" alt="" />
                  </a>
                </li>
                @endif
                @endfor
                @else
                @for ($i = 0; $i < 5; $i++) <li>
                  <a>
                    <img src="{{asset('website/assets/images/trainer/stars.svg')}}" loading="lazy" alt="" />
                  </a>
                  </li>
                  @endfor
                  @endif
            </ul>

            <p>
              {{$trainer->bio}}
            </p>
          </div>
        </div>
      </div>
      @endforeach
      @else
      <div class="heading">
        <p>
          @lang('empty_trainers')
        </p>
      </div>
      @endif
    </div>
  </div>
</section>

@endsection
