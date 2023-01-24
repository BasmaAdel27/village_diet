@extends('emails.master')
@section('content')
  @php $setting = \App\Models\Setting::first(); @endphp
  <img src="{{ asset('/website/assets/images/logo/icon.png')}}" style=" display: block;margin-left: auto;margin-right: auto;" alt="">
  @if(app()->getLocale() == 'en')
    <div dir="ltr">
      <p>
        We are thrilled that you have invested in your health and in the Village Diet!
        <br><br>
        Your User Number for the Village Diet Application is {{ $user->user_number }}
        <br><br>
        Please download the Village Diet App for iOS (Apple App Store) and Android (Google Play Store).
        <br><br>
        Be sure to add <a href="mailto:info@thevillagediet.com">
          info@thevillagediet.com </a> to your contacts so that you don't miss any of our emails in the future!
        <br>
        You may also call the team at <a href="tel:00966557250398">00966557250398</a>.
        <br><br>
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
      <p>
        يسعدنا أنك استثمرت في صحتك وفي فيلج دايت!
        <br><br>
        رقم المستخدم الخاص بك لتطبيق فيلج دايت هو {{ $user->user_number }}
        <br><br>
        يرجى تحميل تطبيق Village Diet لنظام iOS (متجر تطبيقات Apple) ولنظام Android (متجر Google Play).
        <br><br>
        تأكد من إضافة <a href="mailto:info@thevillagediet.com">
          info@thevillagediet.com </a> إلى جهات التواصل الخاصة بك حتى لا تفوتك أي من رسائل البريد الإلكتروني في
        المستقبل!
        <br>
        يمكنك أيضا الاتصال بفريق العمل على
        <a href="tel:00966557250398">00966557250398</a>.
        <br><br>
        مع خالص التحيات,<br>
        فريق فيلج دايت
      </p>
      <div>
        <img src="{{ $logo }}">
        <p>تواصلوا مع فيلج دايت!</p>
        <ul class="socail-media">
          @if(isset($setting->twitter))
            <li>
              <a href="{{ $setting->twitter }}" target="_blank">
                <img src="{{ $twitter  }}" loading="lazy" alt=""/>
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
