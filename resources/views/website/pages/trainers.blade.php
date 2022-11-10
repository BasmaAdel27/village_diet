@extends('website.layout')

@section('content')

<section class="sub-header">
  <div class="container general-pattern right-left-pattern">
    <div class="heading">
      <h1>
        المدربين
      </h1>

      <p>
        نخبة من المدربين الموجودين على منصة فيلج دايت
      </p>
    </div>
  </div>
</section>

<section class="trainer">
  <div class="container">
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
                  @for ($i = 0; $i < 5; $i++)
                    @if ($i < $trainer->user->averageRating)
                  <li>
                    <a href="#" class="active">
                      <img src="{{asset('website/assets/images/trainer/stars.svg')}}" loading="lazy" alt="" />
                    </a>
                  </li>
                    @else
                      <li>
                        <a href="#">
                          <img src="{{asset('website/assets/images/trainer/stars.svg')}}" loading="lazy" alt="" />
                        </a>
                      </li>
                    @endif
                  @endfor
                @else
                  @for ($i = 0; $i < 5; $i++)
                    <li>
                      <a href="#">
                        <img src="{{asset('website/assets/images/trainer/stars.svg')}}" loading="lazy" alt="" />
                      </a>
                    </li>
                  @endfor

                  @endif
              </ul>

              <div class="custom-btn">
                @if($trainer->is_certified == 1)
                <span>
                  مدرب مرخص
                </span>
                @else
                  <span>
                  مدرب غير مرخص
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
                  @for ($i = 0; $i < 5; $i++)
                    @if ($i < $trainer->user->averageRating)
                      <li>
                        <a href="#" class="active">
                          <img src="{{asset('website/assets/images/trainer/stars.svg')}}" loading="lazy" alt="" />
                        </a>
                      </li>
                    @else
                      <li>
                        <a href="#">
                          <img src="{{asset('website/assets/images/trainer/stars.svg')}}" loading="lazy" alt="" />
                        </a>
                      </li>
                    @endif
                  @endfor
                @else
                    @for ($i = 0; $i < 5; $i++)
                      <li>
                        <a href="#">
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
            لا يوجد مدربين حاليا
          </p>
        </div>
      @endif
    </div>
  </div>
</section>

@endsection
