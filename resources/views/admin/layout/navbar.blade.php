<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="navbar-brand-wrapper d-flex justify-content-center">
    <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
      <a class="navbar-brand brand-logo" href="index.html"><img src="{{ asset('adminPanel/images/logo.svg') }}"
          alt="logo" /></a>
      <a class="navbar-brand brand-logo-mini" href="index.html"><img
          src="{{ asset('adminPanel/images/logo-mini.svg') }}" alt="logo" /></a>
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="mdi mdi-sort-variant"></span>
      </button>
    </div>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
    <ul class="navbar-nav">
      <select name="locale" class="form-control" id="change-locale">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <option value="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" {{ app()->getLocale() ==
          $localeCode ? 'selected' : '' }}>@lang($localeCode)
        </option>
        @endforeach
      </select>
    </ul>
    {{-- @include('admin.layout.navbar.search') --}}
    <ul class="navbar-nav">
      {{-- @include('admin.layout.navbar.messages')
      @include('admin.layout.navbar.notifications') --}}
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
          <img src="{{ auth()->user()->image }}" alt="profile" />
          <span class="nav-profile-name">{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item">
            <i class="mdi mdi-settings text-primary"></i>
            @lang('profile')
          </a>
          <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <i class="mdi mdi-logout text-primary"></i>
            @lang('Logout')
          </a>
        </div>
      </li>
    </ul>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
      @csrf
    </form>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
      data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>
