<div class="container">
  <div class="contain">
    <div class="hamburger">
      <span class="line"></span>
      <span class="line"></span>
      <span class="line"></span>
    </div>

    <a href="/" class="brand-name">
      <img src="{{ asset('storage/'.$setting->logo) }}" loading="lazy" alt="" />
    </a>

    <ul class="navbar-nav">
      <li class="nav-item">
        <a href="{{ route('website.home') }}#about-us" class="nav-link">@lang('about_us')</a>
      </li>

      <li class="nav-item">
        <a href="{{ route('website.faqs') }}" class="nav-link">@lang('faq')</a>
      </li>

      <li class="nav-item">
        <a href="{{ route('website.food_recipes') }}" class="nav-link">@lang('food_recipes')</a>
      </li>
      <li class="nav-item">
        <a href="{{ route('website.trainers.index') }}" class="nav-link"> @lang('trainers') </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('website.customers_opinions.index') }}" class="nav-link"> @lang('customer_opinions') </a>
      </li>
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
      <a href="login.html" class="custom-btn primary-color">
        <img src="{{asset('website/assets/images/navbar/user.svg')}}" loading="lazy" alt="" />
        <span>@lang('register')</span>
      </a>
    </div>
  </div>
</div>
