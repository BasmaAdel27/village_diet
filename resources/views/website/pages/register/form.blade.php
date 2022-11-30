@extends('website.layout')

@section('content')

<section class="sub-header">
  <div class="container general-pattern right-left-pattern">
    <div class="heading">
      <h1>
        التسجيل وإعادة الإشتراك
      </h1>

      <p>
        قم بالتسجيل في حالة عدم وجود حساب لديك أو إعادة الإشتراك في حالة إنهائه أو تعطيله
      </p>
    </div>
  </div>
</section>

<section class="form-page">
  <div class="conatiner">
    <div class="row">
      <div class="col-lg-8 col-12 mx-auto">
        <div class="contain">
          <div class="heading no-top-margin">
            <h1>
              تسجيل حساب
            </h1>

            <p>
              نحن نرغب في معرفة المزيد عنك لكي نتمكن من خدمتك بشكل أفضل
            </p>
          </div>

          <form action="{{ route('website.healthy.store',['user' => $user,'survey' => $survey]) }}" class="form-contain"
            method="POST" id="dataForm">
            @csrf
            @include('website.pages.register.survey.standard', ['survey' => $survey])
            <div class="button-contain">
              <a href="#!" type="button" class="custom-btn" onclick="$('#dataForm').submit()">
                <img src="{{ asset('website/assets/images/icons/arrow.svg') }}" loading="lazy" alt="" />
                <span>
                  حفظ
                </span>
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
