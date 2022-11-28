<style>
   .stars {
    width: 100%;
    display: flex;
    align-items: center;
    align-content: center;
    justify-content: center;
    margin: 15px 0px;
  }
  .stars li {
    -webkit-margin-end: 3px;
    margin-inline-end: 3px;
  }
 .stars li:last-child {
    -webkit-margin-start: 0px;
    margin-inline-start: 0px;
  }
 .stars li a {
    width: 24px;
    height: 24px;
    display: flex;
  }
 .stars li a img {
    width: 100%;
    height: 100%;
    -o-object-fit: contain;
    object-fit: contain;
    filter: invert(100%) sepia(23%) saturate(1%) hue-rotate(194deg) brightness(119%) contrast(85%);
  }
 .stars li a.active img {
    filter: invert(78%) sepia(37%) saturate(754%) hue-rotate(12deg) brightness(92%) contrast(93%);
  }
 li{
   list-style: none;
 }
</style>
<ul class="stars">
  @if(isset($query->user->ratings))
    @for ($i = 0; $i < 5; $i++)
      @if ($i < $query->user->averageRating)
        <li>
          <a class="active">
            <img src="{{asset('website/assets/images/trainer/stars.svg')}}" loading="lazy" alt="" />
          </a>
        </li>
      @else
        <li>
          <a>
            <img src="{{asset('website/assets/images/trainer/stars.svg')}}" loading="lazy" alt="" />
          </a>
        </li>
      @endif
    @endfor
  @else
    @for ($i = 0; $i < 5; $i++)
      <li>
        <a>
          <img src="{{asset('website/assets/images/trainer/stars.svg')}}" loading="lazy" alt="" />
        </a>
      </li>
    @endfor
  @endif
</ul>
