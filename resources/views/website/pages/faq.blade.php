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
      @foreach($faqs as $faq)
      <div class="card">
        <div class="card-header" id="heading-{{$faq->id}}">
          <h2 class="mb-0">
            <button class="btn btn-block" type="button" data-toggle="collapse" data-target="#collapse-{{$faq->id}}" onclick="event.preventDefault()"
                    @if($loop->first) aria-expanded="true"
                    @endif  aria-controls="collapse-{{$faq->id}}">
              {{$faq->question}}
            </button>
          </h2>
        </div>

        <div id="collapse-{{$faq->id}}" @if($loop->first) class="collapse show" @else class="collapse" @endif aria-labelledby="heading-{{$faq->id}}" data-parent="#accordionExample">
          <div class="card-body">
            <p>
              {{$faq->answer}}
            </p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

@endsection
