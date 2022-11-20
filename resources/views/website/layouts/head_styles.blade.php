<link rel="shortcut icon" href="{{ asset('website/assets/images/logo/icon.png') }}" type="image/x-icon" />
<link rel="stylesheet" href="{{ asset('website/assets/css/lib/all.min.css') }}" />
<link rel="stylesheet" href="{{ asset('website/assets/css/lib/animate.css') }}" />
@if (app()->getLocale() == 'ar')
<link rel="stylesheet" href="{{ asset('website/assets/css/lib/bootstrap-rtl.min.css') }}" />
@else
<link rel="stylesheet" href="{{ asset('website/assets/css/lib/bootstrap.css') }}" />
@endif
<link rel="stylesheet" href="{{ asset('website/assets/css/lib/swiper-bundle.min.css') }}" />
<link rel="stylesheet" href="{{ asset('website/assets/css/style.css') }}" />
<style rel="stylesheet" href={{asset('js/sweetalert/sweetalert2.css')}}></style>
<meta name="csrf-token" content="{{ csrf_token() }}">

