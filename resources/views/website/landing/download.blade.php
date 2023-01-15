<section class="download">
  <div class="conatiner general-pattern right-left-pattern">
    <div class="heading">
      <h1>
        @lang('download_app')
        @if (app()->getLocale() == 'ar')
          @lang('application')
        @endif
        <span> @lang('website_title')</span>
        @if (app()->getLocale() == 'en')
        @lang('application')
        @endif
        @lang('enjoy_website')
      </h1>
    </div>

    <div class="button-contain">
      <a href="{{ $setting->android_url }}" class="download-btn">
        <img src="{{asset('website/assets/images/donwload/play_store.webp')}}" alt="" />
      </a>

      <a href="{{ $setting->ios_url }}" class="download-btn">
        <img src="{{asset('website/assets/images/donwload/apple_store.webp')}}" alt="" />
      </a>
    </div>

    <img src="{{asset('website/assets/images/donwload/screens.webp')}}" class="screens" loading="lazy" alt="" />
  </div>
</section>
