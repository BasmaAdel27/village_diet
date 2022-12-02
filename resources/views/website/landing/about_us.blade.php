<section class="about-us" id="about-us">
  <div class="container general-pattern right-pattern">
    <div class="heading">
      <h1>@lang('who_us')</h1>
    </div>

    <div class="row">
      <div class="col-lg-3 col-12 mb-3">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link active" id="tab-1-tab" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1"
              aria-selected="true">
              <img src="{{asset('website/assets/images/about/about_1.svg')}}" loading="lazy" alt="" />

              <span>{{ $aboutPage->title }}</span>
            </a>
          </li>

          <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab-2-tab" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2"
              aria-selected="false">
              <img src="{{asset('website/assets/images/about/about_2.svg')}}" loading="lazy" alt="" />

              <span> {{ $ourVisionPage->title }} </span>
            </a>
          </li>
        </ul>
      </div>

      <div class="col-lg-9 col-12 mb-3">
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab-1-tab">
            <div class="contain">
              {{ $aboutPage->content }}
              <div class="button-contain">
                <a href="{{ route('website.food_recipes') }}" class="custom-btn secondary-color">
                  <img src="{{asset('website/assets/images/icons/arrow.svg')}}" loading="lazy" alt="" />

                  <span>@lang('more_than')</span>
                </a>

                <a href="#" class="video-play">
                  <img src="{{asset('website/assets/images/about/video.svg')}}" loading="lazy" alt="" />
                </a>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab-2-tab">
            <div class="contain">
              {{ $ourVisionPage->content }}
              <div class="button-contain">
                <a href="{{ route('website.food_recipes') }}" class="custom-btn secondary-color">
                  <img src="{{asset('website/assets/images/icons/arrow.svg')}}" loading="lazy" alt="" />
                  <span> @lang('more_than')</span>
                </a>
                <a href="#" class="video-play">
                  <img src="{{asset('website/assets/images/about/video.svg')}}" loading="lazy" alt="" />
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
