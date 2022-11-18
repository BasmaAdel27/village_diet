<header>
  <div class="container">
    <div class="row">
      <div class="col-lg-5 col-12 mb-4">
        <div class="swiper swiper-header">
          <div class="swiper-wrapper">
            @foreach ($sliders as $slide)
            <div class="swiper-slide">
              <div class="contain">
                <h1>
                  {{ $slide->title }}
                  <span>{{ $setting->web_title }}</span>
                </h1>
                <p>
                  {{ $slide->description }}
                </p>
                <a href="{{ $slide->link }}" class="custom-btn secondary-color">
                  <img src="{{asset('website/assets/images/icons/arrow.svg')}}" loading="lazy" alt="" />
                  <span>@lang('more_than')</span>
                </a>
              </div>
            </div>
            @endforeach
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </div>
  </div>
</header>
