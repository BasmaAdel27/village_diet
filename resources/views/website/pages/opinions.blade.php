@extends('website.layout')

@section('content')

<section class="sub-header">
  <div class="container general-pattern right-left-pattern">
    <div class="heading">
      <h1>
        @lang('customer_opinions')
      </h1>
    </div>
  </div>
</section>

<section class="trainer">
  <div class="container">
    <div class="row">
      @if($opinions->isNotEmpty())
      @foreach($opinions as $opinion)
      <div class="col-lg-6 col-12 mb-4">
        <div class="testimonails-box">
          <p>
            {{$opinion->content}}
          </p>
          <div class="user-data">
            <img src="{{$opinion->getImageAttribute()}}" loading="lazy" alt="" />

            <h2>
              {{$opinion->name}}
            </h2>
          </div>
        </div>
      </div>
      @endforeach
      @else
      <div class="heading">
        <p>
          @lang('empty_opinions')
        </p>
      </div>
      @endif
    </div>
  </div>
</section>

@endsection
