@extends('emails.master')
@section('content')
  @php $setting = \App\Models\Setting::first(); @endphp
  <img src="{{ asset('/website/assets/images/logo/icon.png')}}"
       style=" display: block;margin-left: auto;margin-right: auto;" alt="">

  @if(app()->getLocale() == 'en')

    <div dir="ltr">
     Dear {{ $trainer->user->first_name .' '. $trainer->user->last_name }} <br>
     <p>
       Welcome to Village Diet.
       <br>
       You can access your control panel through this link
       <a href="https://thevillagediet.com/login">Dashboard</a>
       <br>
       Your Credentials :
       <br>
       Email : {{$email}}<br>
       Password : {{$password}}<br>
     <p>
       Best regards,<br>
       The Village Diet Team
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
   </div>
  @else
    <div dir="rtl">
      اهلا {{ $trainer->user->first_name .' '. $trainer->user->last_name }} <br>
      <p>
        اهلا بيك في فيلج دايت.
        <br>
        يمكنك الدخول الي لوحة التحكم الخاصة بك من خلال هذا الرابط
        <a href="https://thevillagediet.com/login">لوحة التحكم</a>
        <br>
        بيانات الدخول :
        <br>
        البريد الالكتروني : {{$email}} <br>
        كلمة المرور : {{$password}}<br>
      <p>
        مع خالص التحيات,<br>
        فريق فيلج دايت.
      </p>

      <div>
        <img src="{{ $logo }}">
        <p>تواصلوا مع فيلج دايت!</p>
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
    </div>
  @endif
@endsection
