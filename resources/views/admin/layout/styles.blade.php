<link rel="stylesheet" href={{ asset('adminPanel/vendors/mdi/css/materialdesignicons.min.css') }}>
<link rel="stylesheet" href={{ asset('adminPanel/vendors/base/vendor.bundle.base.css') }}>
<link rel="stylesheet" href={{ asset('adminPanel/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}>
<link rel="stylesheet" href={{ asset('adminPanel/css/style.css') }}>
<link rel="shortcut icon" href={{ asset('storage/'.$setting->logo) }} />
<link rel="stylesheet" href={{asset('adminPanel/css/select2.min.css')}} />
<style rel="stylesheet" href={{asset('js/sweetalert/sweetalert2.css')}}></style>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@if (app()->getLocale() == 'ar')
<link rel="stylesheet" href="{{ asset('adminPanel/vendors/bootstrap-rtl/bootstrap-rtl.css') }}">
<link rel="stylesheet" href={{ asset('adminPanel/css/ar-style.css') }}>
@endif
<link rel="stylesheet" href={{ asset('adminPanel/css/chat.css') }}>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@yield('styles')
