<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8" />
  <meta name="description" content="...." />
  <meta name="author" content="misara adel" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>فيلج دايت</title>
  @include('website.layouts.head_styles')
</head>

<body>
  <nav class="navbar">
    @include('website.layouts.navbar')
  </nav>
  <main>
    @yield('content')
  </main>
  @include('website.layouts.modals.register')
  @include('website.layouts.modals.subscription')
  <footer>
    @include('website.layouts.footer')
  </footer>
  @include('website.layouts.foot_scripts')
  @include('website.layouts.flash.errors')
  @include('website.layouts.flash.success')
  @include('website.layouts.modals.done_subscribed')
  @include('website.layouts.modals.error_modal')
</body>

</html>
