<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    @can('home')
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.dashboard') }}">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    @endcan
    @can('admin.roles.index')
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.roles.index') }}">
        <i class="mdi mdi-key menu-icon"></i>
        <span class="menu-title">@lang('roles')</span>
      </a>
    </li>
    @endcan
    @can('admin.admins.index')
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.admins.index') }}">
        <i class="mdi mdi-account-multiple menu-icon"></i>
        <span class="menu-title">@lang('admins')</span>
      </a>
    </li>
    @endcan
    @can('admin.contactUs.index')
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.contactUs.index') }}">
        <i class="mdi mdi-phone-classic menu-icon"></i>
        <span class="menu-title">@lang('contact us')</span>
      </a>
    </li>
    @endcan
    @can('admin.sliders.index')
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.sliders.index') }}">
        <i class="mdi mdi-image-multiple menu-icon"></i>
        <span class="menu-title">@lang('sliders')</span>
      </a>
    </li>
    @endcan
    @can('admin.societies.index')
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.societies.index') }}">
        <i class="mdi mdi-human menu-icon"></i>
        <span class="menu-title">@lang('societies')</span>
      </a>
    </li>
    @endcan
    @can('admin.users.index')
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.users.index') }}">
        <i class="mdi mdi-account-multiple menu-icon"></i>
        <span class="menu-title">@lang('users')</span>
      </a>
    </li>
    @endcan
    @can('admin.static_pages.index')
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.static_pages.index') }}">
        <i class="mdi mdi-file-multiple menu-icon"></i>
        <span class="menu-title">@lang('static_pages')</span>
      </a>
    </li>
    @endcan
    @can('admin.videos.index')
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.videos.index') }}">
        <i class="mdi mdi-video menu-icon"></i>
        <span class="menu-title">@lang('videos')</span>
      </a>
    </li>
    @endcan
  </ul>
</nav>


{{-- <div class="collapse" id="auth">
  <ul class="nav flex-column sub-menu">
    <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
    <li class="nav-item"> <a class="nav-link" href="pages/samples/login-2.html"> Login 2 </a></li>
    <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
    <li class="nav-item"> <a class="nav-link" href="pages/samples/register-2.html"> Register 2 </a></li>
    <li class="nav-item"> <a class="nav-link" href="pages/samples/lock-screen.html"> Lockscreen </a></li>
  </ul>
</div> --}}
