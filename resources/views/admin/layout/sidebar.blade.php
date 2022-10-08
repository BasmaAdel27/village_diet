<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    @role('trainer')
    @can('trainer.dashboard')
    <li class="nav-item">
      <a class="nav-link" href="{{ route('trainer.dashboard') }}">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">@lang('dashboard')</span>
      </a>
    </li>
    @endcan
    @can('trainer.users.index')
    <li class="nav-item">
      <a class="nav-link" href="{{ route('trainer.users.index') }}">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">@lang('users')</span>
      </a>
    </li>
    @endcan
    @can('trainer.societies.index')
    <li class="nav-item">
      <a class="nav-link" href="{{ route('trainer.societies.index') }}">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">@lang('societies')</span>
      </a>
    </li>
    @endcan
    @endrole

    @can('admin.home')
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.dashboard') }}">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">@lang('dashboard')</span>
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
    @can('admin.societies.index')
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.societies.index') }}">
        <i class="mdi mdi-human menu-icon"></i>
        <span class="menu-title">@lang('societies')</span>
      </a>
    </li>
    @endcan
    @canAny(['admin.users.index','admin.users.form_data'])
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#add_users" aria-expanded="false" aria-controls="add_users">
        <i class="mdi mdi-account-multiple menu-icon"></i>
        <span class="menu-title">@lang('add_users')</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="add_users">
        <ul class="nav flex-column sub-menu">
          @can('admin.users.index')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.users.index') }}">
              @lang('add_users')
            </a>
          </li>
          @endcan
          @can('admin.users.form_data')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.users.form_data') }}">
              @lang('health_info')
            </a>
          </li>
          @endcan
        </ul>
      </div>
    </li>
    @endcanany
    @canAny(['admin.trainers.index','admin.pending-trainers.index'])
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#add_trainers" aria-expanded="false"
        aria-controls="add_trainers">
        <i class="mdi mdi-account-multiple menu-icon"></i>
        <span class="menu-title">@lang('trainers')</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="add_trainers">
        <ul class="nav flex-column sub-menu">
          @can('admin.trainers.index')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.trainers.index') }}">
              @lang('trainers')
            </a>
          </li>
          @endcan
          @can('admin.pending-trainers.index')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.pending-trainers.index') }}">
              @lang('pending_trainers')
            </a>
          </li>
          @endcan
        </ul>
      </div>
    </li>
    @endcanany
    @can('admin.sliders.index')
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.sliders.index') }}">
        <i class="mdi mdi-image-multiple menu-icon"></i>
        <span class="menu-title">@lang('sliders')</span>
      </a>
    </li>
    @endcan
    @can('admin.coupons.index')
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.coupons.index') }}">
        <i class="mdi mdi-sale menu-icon"></i>
        <span class="menu-title">@lang('coupons')</span>
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
    @can('admin.meals.index')
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.meals.index') }}">
        <i class="mdi mdi-food menu-icon"></i>
        <span class="menu-title">@lang('meals')</span>
      </a>
    </li>
    @endcan
    @can('admin.ratings.index')
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.ratings.index') }}">
        <i class="mdi mdi-star-circle menu-icon"></i>
        <span class="menu-title">@lang('ratings')</span>
      </a>
    </li>
    @endcan
    @can('admin.notifications.index')
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.notifications.index') }}">
        <i class="mdi mdi-bell menu-icon"></i>
        <span class="menu-title">@lang('notifications')</span>
      </a>
    </li>
    @endcan
    @canAny(['admin.reports.subscriptions','admin.reports.users','admin.reports.trainers','admin.reports.copouns'])
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#reports" aria-expanded="false" aria-controls="reports">
        <i class="mdi mdi-file-document menu-icon"></i>
        <span class="menu-title">@lang('reports')</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="reports">
        <ul class="nav flex-column sub-menu">
          @can('admin.reports.subscriptions')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.reports.subscriptions') }}">@lang('subscriptions')</a>
          </li>
          @endcan
          @can('admin.reports.users')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.reports.users') }}"> @lang('users')</a>
          </li>
          @endcan
          @can('admin.reports.trainers')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.reports.trainers') }}">@lang('trainers')</a>
          </li>
          @endcan
          @can('admin.reports.copouns')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.reports.copouns') }}"> @lang('copouns')</a>
          </li>
          @endcan
        </ul>
      </div>
    </li>
    @endcanany
    @can('admin.contactUs.index')
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.contactUs.index') }}">
        <i class="mdi mdi-phone-classic menu-icon"></i>
        <span class="menu-title">@lang('contact us')</span>
      </a>
    </li>
    @endcan
    @canAny(['admin.postel_news.index','admin.templates.index'])
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#postel_news" aria-expanded="false" aria-controls="postel_news">
        <i class="mdi mdi-account-multiple menu-icon"></i>
        <span class="menu-title">@lang('postel_news')</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="postel_news">
        <ul class="nav flex-column sub-menu">
          @can('admin.postel_news.index')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.postel_news.index') }}">
              @lang('postel_news')
            </a>
          </li>
          @endcan
          @can('admin.templates.index')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.templates.index') }}">
              @lang('templates')
            </a>
          </li>
          @endcan
        </ul>
      </div>
    </li>
    @endcanany
    @can('admin.settings.index')
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.settings.index') }}">
        <i class="mdi mdi-settings menu-icon"></i>
        <span class="menu-title">@lang('settings')</span>
      </a>
    </li>
    @endcan

  </ul>
</nav>
