@extends('website.layout')

@section('content')

<section class="sub-header">
  <div class="container general-pattern right-left-pattern">
    <div class="heading">
      <h1>
        @lang('faq')
      </h1>
    </div>
  </div>
</section>

<section class="trainer">
  <div class="container">
    <div class="accordion" id="accordionExample">
      @foreach ($faqs as $faq)
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-block" type="button" data-toggle="collapse" data-target="#collapseOne"
              aria-expanded="true" aria-controls="collapseOne">
              {{ $faq->question }}
            </button>
          </h2>
        </div>
        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">
            <p>
              {{ $faq->answer }}
            </p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

@endsection
