<!DOCTYPE html>
<html lang="en" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
  <title>@lang('admin-panel') - @yield('title')</title>
  @include('admin.layout.styles')
</head>

<body>
  <div class="container-scroller">
    @include('admin.layout.navbar')
    <div class="container-fluid page-body-wrapper">
      @include('admin.layout.sidebar')
      <div class="main-panel">
        <div class="content-wrapper">
          @yield('content')
          <div class="row">
            <footer class="footer" style="margin: 0 auto">
              <span class="text-muted d-block text-center">
                Copyright © village Diet 2022</span>
            </footer>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('admin.layout.scripts')
  @include('admin.layout.flash.errors')
  @include('admin.layout.flash.success')
  @include('admin.layout.helpers.delete_script')
</body>

</html>
