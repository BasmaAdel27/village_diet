@php
$page = \App\Models\StaticPage\StaticPage::where('slug','advantages')->first();
@endphp

<section class="socaity">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-12 mb-12 mobile-order-0">
        <div class="contain">
{{--          <h1>--}}
{{--            {{ $page->title }}--}}
{{--          </h1>--}}
          <p class="list">
            {!! $page->content !!}
          </p>
        </div>
      </div>
    </div>
  </div>
</section>
