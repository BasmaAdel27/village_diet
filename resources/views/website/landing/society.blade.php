<section class="socaity">
  <div class="container">
    <div class="row">
      <div class="col-lg-5 col-12 mobile-order-1">
        <div class="image-content">
          <img src="{{asset('website/assets/images/socaity.webp')}}" loading="lazy" alt="" />
        </div>
      </div>

      <div class="col-lg-7 col-12 mb-4 mobile-order-0">
        <div class="contain">
          <h1>
            @lang('communities')
            <span> @lang('website_title')</span>
          </h1>
          <p>
            @lang('socitey_section_breif')
          </p>
          <ul class="list">
            @foreach (__('site.society_list') as $item)
            <li>{{ $item }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
