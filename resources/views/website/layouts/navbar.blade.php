<div class="container">
  <div class="contain">
    <div class="hamburger">
      <span class="line"></span>
      <span class="line"></span>
      <span class="line"></span>
    </div>

    <a href="/" class="brand-name">
      <img src="{{asset('website/assets/images/logo/logo.svg')}}" loading="lazy" alt="" />
    </a>

    <ul class="navbar-nav">
      <li class="nav-item">
        <a href="index.html" class="nav-link"> نبذة عنا </a>
      </li>

      <li class="nav-item">
        <a href="questions.html" class="nav-link"> أسئلة شائعة </a>
      </li>

      <li class="nav-item">
        <a href="sheet-meals.html" class="nav-link"> الوصفات الغذائية </a>
      </li>

      <li class="nav-item">
        <a href="/trainers" class="nav-link"> @lang('trainers') </a>
      </li>

      <li class="nav-item">
        <a href="/customers_opinions" class="nav-link"> @lang('customer_opinions') </a>
      </li>

      <li class="nav-item">
        <a href="/contact_us" class="nav-link"> @lang('contact us') </a>
      </li>
    </ul>

    <div class="button-contain">
      <a href="#" class="lang">
        <span> En </span>
      </a>

      <a href="login.html" class="custom-btn primary-color">
        <img src="{{asset('website/assets/images/navbar/user.svg')}}" loading="lazy" alt="" />

        <span> التسجيل </span>
      </a>
    </div>
  </div>
</div>
