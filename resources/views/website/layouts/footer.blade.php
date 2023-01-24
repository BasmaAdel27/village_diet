@php
$aboutUs = \App\Models\StaticPage\StaticPage::where('programing_name','about-village-diet')->first();
$food_recipes= \App\Models\StaticPage\StaticPage::Where('programing_name', 'Food-Recipes')->first();

@endphp

<div class="container">
  <form action="{{ route('website.subscribe') }}" class="form-contain" method="POST">@csrf
    <div class="form-title">
      <p>@lang('subscription_list')</p>
    </div>
    <div class="form-group">
      <img src="{{asset('website/assets/images/form/sms.svg')}}" class="icon" loading="lazy" alt="" />
      <input type="text" class="form-control" placeholder="@lang('enter_email')" name="email" />
      <a href="#!" class="custom-btn primary-color" onclick="$(this).closest('form').submit()">
        <img src="{{asset('website/assets/images/navbar/user.svg')}}" loading="lazy" alt="" />
        <span onclick="$(this).closest('form').submit()">@lang('subscribe')</span>
      </a>
    </div>
  </form>
  <div class="row">
    <div class="col-lg-4 col-12 mb-4">
      <div class="contain">
        <a href="/" class="brand-name">
          <img src="{{ asset('storage/'.$setting->logo) }}" loading="lazy" alt="" />
        </a>
        <p>
          @lang('start_now')
        </p>
        <ul class="socail-media">

          @if(isset($setting->twitter))
          <li>
            <a href="{{ $setting->twitter }}" target="_blank">
              <img src="{{asset('website/assets/images/footer/twitter.svg')}}" loading="lazy" alt="" />
            </a>
          </li>
          @endif
          @if(isset($setting->instagram))
          <li>
            <a href="{{ $setting->instagram }}" target="_blank">
              <img src="{{ asset('website/assets/images/footer/instagram.svg') }}" loading="lazy" alt="" />
            </a>
          </li>
          @endif
          @if(isset($setting->tiktok))
          <li>
            <a href="{{ $setting->tiktok }}" target="_blank">
              <img src="{{asset('website/assets/images/footer/tik-tok.svg')}}" loading="lazy" alt="" />
            </a>
          </li>
          @endif
          @if(isset($setting->linkedin))
          <li>
            <a href="{{ $setting->linkedin }}" target="_blank">
              <img src="{{asset('website/assets/images/footer/linkedin.svg')}}" loading="lazy" alt="" />
            </a>
          </li>
          @endif
          @if(isset($setting->snapchat))
          <li>
            <a href="{{ $setting->snapchat }}" target="_blank">
              <img src="{{asset('website/assets/images/footer/snapchat.svg')}}" loading="lazy" alt="" />
            </a>
          </li>
          @endif
          @if(isset($setting->facebook))
          <li>
            <a href="{{ $setting->facebook }}" target="_blank">
              <img src="{{ asset('website/assets/images/footer/facebook.svg') }}" loading="lazy" alt="" />
            </a>
          </li>
          @endif
          @if(isset($setting->youtube))
          <li>
            <a href="{{ $setting->youtube }}">
              <img src="{{asset('website/assets/images/footer/youtube.svg')}}" loading="lazy" alt="" />
            </a>
          </li>
          @endif
        </ul>
      </div>
    </div>

    <div class="col-lg-4 col-12 mb-4">
      <div class="contain padding-contain">
        <h1>@lang('website_menu')</h1>

        <div class="flex-link">
          <ul class="links">
            <li>
              <a href="{{ route('website.home') }}">@lang('home')</a>
            </li>
            <li>
              <a href="{{ route('website.static_pages.show',$aboutUs->id) }}">{{ $aboutUs->title }}</a>
            </li>
            <li>
              <a href="{{ route('website.faqs') }}">@lang('faq')</a>
            </li>
            <li>
              <a href="{{ route('website.food_recipes') }}">{{$food_recipes->title}}</a>
            </li>
            <li>
              <a href=" {{ route('website.trainers.index') }}">@lang('our_trainers')</a>
            </li>
          </ul>
          <ul class="links">
            <li>
              <a href="{{ route('website.customers_opinions.index') }}">@lang('customer_opinions')</a>
            </li>
            <li>
              <a href="{{ route('website.contact_us.index') }}">@lang('contact_us')</a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-12 mb-4">
      <div class="contain">
        <div class="flex-data">
          @if (isset($staticPages) && count($staticPages))
          <div>
            <h1>@lang('important_links')</h1>
            <ul class="links">
              @foreach ($staticPages as $page)
              <li><a href="{{ route('website.static_pages.show',$page->id) }}">{{ $page->title }}</a></li>
              @endforeach
            </ul>
          </div>
          @endif
          <div>
            <h1>@lang('trainers')</h1>

            <ul class="links">
              <li>
                <a href="{{ route('website.register_trainer.create') }}">@lang('register')</a>
              </li>
            </ul>
          </div>
        </div>

        <ul class="payment">
          <li>
            <a>
              <img src="{{asset('website/assets/images/footer/visa.webp')}}" loading="lazy" alt="" />
            </a>
          </li>

          <li>
            <a>
              <img src="{{asset('website/assets/images/footer/mastercard.webp')}}" loading="lazy" alt="" />
            </a>
          </li>

          <li>
            <a>
              <img src="{{asset('website/assets/images/footer/mada.webp')}}" loading="lazy" alt="" />
            </a>
          </li>

          <li>
            <a>
              <img src="{{asset('website/assets/images/footer/pay.webp')}}" loading="lazy" alt="" />
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="copyrights">
    <p>
      {{ $setting->footer }}
    </p>
  </div>
</div>
