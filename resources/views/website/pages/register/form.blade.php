@extends('website.layout')

@section('content')

<section class="sub-header">
  <div class="container general-pattern right-left-pattern">
    <div class="heading">
      <h1>
        @lang('register_and_rejoin')
      </h1>
      <p>
        @lang('register_if_you_donot_have_one')
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
              @lang('register_new_account')
            </h1>
            <p>
              @lang('we_need_know_more')
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
                  @lang('submit')
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
