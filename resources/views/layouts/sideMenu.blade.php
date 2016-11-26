@section('side_menu')
<div class="col-xs-2">
  <nav class="menu-raq">
      <div class="">
          <div class="header-raq clearfix">
              <div class="circle col-xs-6"></div>
              <span class="name col-xs-6">{{ Auth::user()->name }}</span>
              <!-- Collapsed Hamburger -->
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                  <span class="sr-only">Toggle Navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <!--  -->
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
                  <li>
                      <a href="{{ url('/logout') }}"
                          onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                                   <i class="material-icons">exit_to_app</i>
                          Выйти
                      </a>

                      <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                  </li>


              </ul>
          </div>
      </div>
  </nav>
  </div>
  @endsection
