@if($setting->show_workWay == 1)
<section class="work">
  <div class="container general-pattern left-pattern">
    <div class="heading">
      <h1>
        @lang('work_way')
    </h1>
    </div>
    <div class="row">
      @foreach ($workWaySteps as $step)
      <div class="col-lg-3 col-12 mb-4 px-0">
        <a href="{{$step->url}}">
        <div class="box {{ $loop->iteration == 1 ? 'first-box' : '' }}">
          <span> 0{{ $step->ordering }} </span>
          <img src="{{ $step->image }}" loading="lazy" alt="" />
          <h2>
            {{ $step->title }}
          </h2>
          <p>{{ $step->description }}</p>
        </div>
        </a>

      </div>
      @endforeach
    </div>
  </div>
</section>
@endif
