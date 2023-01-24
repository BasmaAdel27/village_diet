@extends('emails.master')
@section('content')
  @php $setting = \App\Models\Setting::first(); @endphp
  @if(app()->getLocale() == 'en')

    <div dir="ltr">
      <p>
        We are thrilled that you have invested in your health and in the Village Diet!
        <br><br>
        Your User Number for the Village Diet Application is 123123
        <br><br>
        Please download the Village Diet App for iOS (Apple App Store) and Android (Google Play Store).
        <br><br>
        Be sure to add <a href="mailto:info@thevillagediet.com">
          info@thevillagediet.com </a> to your contacts so that you don't miss any of our emails in the future!
        <br>
        You may also call the team at <a href="tel:00966557250398">00966557250398</a>.
        <br><br>
        Best regards,
        The Village Diet Team
      </p>

      <div class="align-content-center text-center">
        <img src="{{ asset('website/assets/images/logo/logo.svg') }}"><br>
        <p>Connect with the Village Diet!</p><br>
        <ul class="socail-media">

          @if(isset($setting->twitter))
            <li>
              <a href="{{ $setting->twitter }}" target="_blank">
                <img src="{{asset('website/assets/images/footer/twitter.svg')}}" loading="lazy" alt=""/>
              </a>
            </li>
          @endif
          @if(isset($setting->instagram))
            <li>
              <a href="{{ $setting->instagram }}" target="_blank">
                <img src="{{ asset('website/assets/images/footer/instagram.svg') }}" loading="lazy" alt=""/>
              </a>
            </li>
          @endif
          @if(isset($setting->tiktok))
            <li>
              <a href="{{ $setting->tiktok }}" target="_blank">
                <img src="{{asset('website/assets/images/footer/tik-tok.svg')}}" loading="lazy" alt=""/>
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
        رقم المستخدم الخاص بك لتطبيق فيلج دايت هو 123123
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
        مع خالص التحيات
        فريق فيلج دايت
      </p>
      <div class="align-content-center text-center">
        <img src="/website/assets/images/logo/logo.svg"><br>
        <p>تواصلوا مع فيلج دايت!</p><br>
        <ul class="socail-media">
          @if(isset($setting->twitter))
            <li>
              <a href="{{ $setting->twitter }}" target="_blank">
                <img src="/website/assets/images/footer/twitter.svg" loading="lazy" alt=""/>
              </a>
            </li>
          @endif
          @if(isset($setting->instagram))
            <li>
              <a href="{{ $setting->instagram }}" target="_blank">
                <img src="/website/assets/images/footer/instagram.svg" loading="lazy" alt=""/>
              </a>
            </li>
          @endif
          @if(isset($setting->tiktok))
            <li>
              <a href="{{ $setting->tiktok }}" target="_blank">
                <img src="/website/assets/images/footer/tik-tok.svg" loading="lazy" alt=""/>
              </a>
            </li>
          @endif
        </ul>
      </div>
    </div>
  @endif
@endsection
