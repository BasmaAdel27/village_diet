@extends('layouts.layout')
@section('content')

<div class="row w-100 mx-0" dir="rtl" >
  <div class="col-lg-4 mx-auto" >
    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
      <div class="brand-logo">
        <img src="{{asset('storage/'.$setting->logo)}}" alt="logo">
      </div>
{{--      <h4 dir="rtl">مرحبا بك !</h4>--}}
{{--      <h6 class="font-weight-light">Sign in to continue.</h6>--}}
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
          <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email"
            id="exampleInputEmail1" placeholder="البريد الإلكتروني" value="{{ old('email') }}" required
            autocomplete="email" autofocus>
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group">
          <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
            id="exampleInputPassword1" placeholder="كلمه المرور" name="password" required
            autocomplete="current-password">
          @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="mt-3">
          <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">تسجيل الدخول</button>
        </div>
        <div class="my-2 d-flex justify-content-between align-items-center">
          <div class="form-check">
            <label class="form-check-label text-muted">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember')
                ? 'checked' : '' }}>
             تذكرني
            </label>
          </div>
          @if (Route::has('password.request'))
          <a class="auth-link text-black" href="{{ route('password.request') }}">
        نسيت كلمه المرور؟
          </a>
          @endif
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
