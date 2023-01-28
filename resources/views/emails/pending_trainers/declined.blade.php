@extends('emails.master')
@section('content')
  @php $setting = \App\Models\Setting::first(); @endphp
  <img src="{{ asset('/website/assets/images/logo/icon.png')}}"
       style=" display: block;margin-left: auto;margin-right: auto;" alt="">

  Dear {{ $trainer->user->first_name .' '. $trainer->user->last_name }} <br>
  <p>
    Welcome to Village Diet .
    Your request declined because of  <h2>{{$reason}}</h2>
  <p>
    Best Regards.
  </p>

  <div>
    <img src="{{ $logo }}">
    <p>Connect with the Village Diet!</p>
    <ul class="socail-media">
      @if(isset($setting->twitter))
        <li>
          <a href="{{ $setting->twitter }}" target="_blank">
            <img src="{{ $twitter }}" loading="lazy" alt=""/>
          </a>
        </li>
      @endif
      @if(isset($setting->instagram))
        <li>
          <a href="{{ $setting->instagram }}" target="_blank">
            <img src="{{ $instagram }}" loading="lazy" alt=""/>
          </a>
        </li>
      @endif
      @if(isset($setting->tiktok))
        <li>
          <a href="{{ $setting->tiktok }}" target="_blank">
            <img src="{{ $tiktok }}" loading="lazy" alt=""/>
          </a>
        </li>
      @endif
    </ul>
  </div>
@endsection
