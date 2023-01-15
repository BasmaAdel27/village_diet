<section class="register-now">
  <div class="container">
    <div class="contain">
      <div class="row">
        <div class="col-lg-8 col-12">
          <div class="data">
{{--            <h1>--}}
{{--              @lang('register_in')--}}
{{--              <span>@lang('website_title')</span>--}}
{{--            </h1>--}}
            <p>
              @lang('register_brief')
            </p>
          </div>
        </div>

        <div class="col-lg-4 col-12">
          <div class="button-contain">
            <a href="{{ route('website.register') }}" class="custom-btn gray-color">
              <span>@lang('register_now')</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
