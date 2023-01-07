<!DOCTYPE html>
<html lang="en" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
              <span class="text-muted d-block text-center"> {{ $setting->footer }}</span>
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
  @include('admin.layout.helpers.active_script')
  @include('admin.layout.helpers.cancel_script')
  @include('admin.layout.helpers.inactive_script')
  @include('admin.layout.helpers.showSection_script')
  @include('admin.layout.helpers.diasbleSection_script')
  <script>
    $(document).ready(function(){
      // Initialize select2
      $("#country").select2();
    });
  </script>
</body>

</html>
