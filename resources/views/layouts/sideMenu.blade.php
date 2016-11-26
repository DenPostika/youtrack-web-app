@section('side_menu')
<div class="col-xs-2">
  <nav class="menu-raq">
      <div class="">
          <div class="header-raq clearfix">
              <div class="circle"></div>
              <!-- Collapsed Hamburger -->
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                  <span class="sr-only">Toggle Navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <ul class="nav navbar-raq">
              <!-- Branding Image -->
              <!-- Authentication Links -->
              @if (Auth::guest())
                  <li><a href="{{ url('/login') }}">Login</a></li>
                  <li><a href="{{ url('/register') }}">Register</a></li>
              @else
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                          {{ Auth::user()->name }} <span class="caret"></span>
                      </a>

                      <ul class="dropdown-menu" role="menu">
                          <li>
                              <a href="{{ url('/logout') }}"
                                  onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                  Logout
                              </a>

                              <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                  {{ csrf_field() }}
                              </form>
                          </li>
                      </ul>
                  </li>
              @endif
              </ul>
          </div>

          <div class="collapse navbar-collapse" id="app-navbar-collapse">
              <!-- Left Side Of Navbar -->
              <ul class="nav nav-pils nav-stacked navbar-raq">
                <li class="active">
                    <a class="" href="{{ url('/') }}">
                      <i class="material-icons">dashboard</i>
                      dashboard
                    </a>
                </li>
              </ul>

              <!-- Right Side Of Navbar -->
              <ul class="nav nav-pils nav-stacked navbar-raq">

                  <li>
                    <a href="{{ url('/tracker') }}">
                    <i class="material-icons">timer</i>
                    Трекер</a></li>
                  <li><a href="{{ url('/projects') }}">
                    <i class="material-icons">featured_play_list</i>
                    Проекты</a></li>
                  <li>
                    <a href="{{ url('/settings') }}">
                    <i class="material-icons">settings</i>
                    Настройки</a></li>



              </ul>
          </div>
      </div>
  </nav>
  </div>
  @endsection
