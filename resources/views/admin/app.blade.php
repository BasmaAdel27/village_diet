<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@lang('site.admin-panel') - @yield('title')</title>
  @include('admin.layout.styles')
</head>

<body>
  <div class="container-scroller">
    @include('admin.layout.navbar')
    <div class="container-fluid page-body-wrapper">
      @include('admin.layout.sidebar')
      @yield('content')
    </div>
  </div>
  @include('admin.layout.scripts')
</body>

</html>
