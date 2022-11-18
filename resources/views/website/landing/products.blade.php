<section class="take-now">
  <div class="container general-pattern right-pattern">
    <div class="heading">
      <h1>
        @lang('product_breif')
        <span class="gray">@lang('website_title')</span>
      </h1>
    </div>

    <div class="row">
      @foreach ($products as $product)
      <div class="col-lg-3 col-12 mb-4 box-contain">
        <div class="box">
          <img src="{{ $product->image }}" loading="lazy" alt="" />
          <h2>{{ $product->title }}</h2>
          <p>{{ $product->description }}</p>
        </div>
      </div>
      @endforeach
      <div class="col-12">
        <div class="button-contain">
          <a href="{{ $setting->visit_store }}" class="custom-btn">
            <span> @lang('visite_store')</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
