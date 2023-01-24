@php
  $aboutUs = \App\Models\StaticPage\StaticPage::where('slug','about-village-diet')->first();
  $privacy = \App\Models\StaticPage\StaticPage::where('slug','privacy-policy')->first();
  $terms = \App\Models\StaticPage\StaticPage::where('slug','terms-of-use')->first();
  $food_recipes= \App\Models\StaticPage\StaticPage::Where('slug', 'Food-Recipes')->first();
@endphp

<div class="container">
  <div class="contain">
    <div class="hamburger">
      <span class="line"></span>
      <span class="line"></span>
      <span class="line"></span>
    </div>

    <a href="/" class="brand-name">
      <img src="{{ asset('storage/'.$setting->logo) }}" loading="lazy" alt=""/>
    </a>

    <ul class="navbar-nav">
      <li class="nav-item">
        <a href="{{ route('website.static_pages.show',$aboutUs->id) }}" class="nav-link">{{ $aboutUs->title }}</a>
      </li>

      <li class="nav-item">
        <a href="{{ route('website.faqs') }}" class="nav-link">@lang('faq')</a>
      </li>

      <li class="nav-item">
        <a href="{{ route('website.food_recipes') }}" class="nav-link">{{$food_recipes->title}}</a>
      </li>
      <li class="nav-item">
        <a href="{{ route('website.trainers.index') }}" class="nav-link"> @lang('trainers') </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('website.customers_opinions.index') }}" class="nav-link"> @lang('customer_opinions') </a>
      </li>
      @foreach ($staticPages as $page)
        @if( !in_array($page->id,[$terms->id,$privacy->id]))
          <li class="nav-item">
            <a href="{{ route('website.static_pages.show',$page->id) }}" class="nav-link"> {{ $page->title }} </a>
          </li>
        @endif
      @endforeach

      <li class="nav-item">
        <a href="{{ route('website.contact_us.index') }}" class="nav-link"> @lang('contact us') </a>
      </li>
    </ul>

    <div class="button-contain">
      @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        @if ($localeCode != LaravelLocalization::getCurrentLocale())
          <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="lang">
            <span> {{ $localeCode }}</span>
          </a>
        @endif
      @endforeach
      <a href="{{ route('website.register') }}" target="_blank" class="custom-btn primary-color">
        <img src="{{asset('website/assets/images/navbar/user.svg')}}" loading="lazy" alt=""/>
        <span>@lang('register')</span>
      </a>

      </a>
    </div>
  </div>
</div>
