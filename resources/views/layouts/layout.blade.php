<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>@lang('admin-panel')</title>
  <link rel="stylesheet" href="{{ asset('adminPanel/vendors/mdi/css/materialdesignicons.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('adminPanel/vendors/base/vendor.bundle.base.css') }}" />
  <link rel="stylesheet" href="{{ asset('adminPanel/css/style.css') }}" />
  <link rel="shortcut icon" href="{{ asset('storage/'.$setting->logo) }}" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        @yield('content')
      </div>
    </div>
  </div>

  <script src="{{ asset('adminPanel/vendors/base/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('adminPanel/js/off-canvas.js') }}"></script>
  <script src="{{ asset('adminPanel/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('adminPanel/js/template.js') }}"></script>
</body>

</html>
