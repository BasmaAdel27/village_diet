@extends('website.layout')

@section('content')

<section class="sub-header">
  <div class="container general-pattern right-left-pattern">
    <div class="heading">
      <h1>
        {{ $staticPage->title }}
      </h1>
    </div>
  </div>
</section>

<section class="trainer">
  <div class="container">
    <div class="row">
      <div class="col-12 mb-4">
        <div class="image-sheet-meals-content">
          <img src="{{ $staticPage->image }}" loading="lazy" alt="" />
        </div>
        <p class="desc">
          {{ $staticPage->content }}
        </p>
      </div>
    </div>
  </div>
</section>

@endsection
