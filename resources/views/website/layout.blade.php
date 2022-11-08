<!DOCTYPE html>
<html dir="rtl">

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
  <footer>
    @include('website.layouts.footer')
  </footer>
  @include('website.layouts.foot_scripts')
</body>

</html>
