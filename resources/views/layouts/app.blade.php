<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta name="description" content="mapp.">
    <link rel="icon" href="favicon.ico">
    <title>{{ config('app.name', 'Mapp | Editor') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header">
        <a class="app-header__logo" href="/editor">MAPP</a>
        <!-- Sidebar toggle button-->
        <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">

        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            {{-- <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-cog fa-lg"></i> Settings</a></li> --}}
            <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="fa fa-user fa-lg"></i> Perfil</a></li>
            {{-- <li><a class="dropdown-item" href="page-login.html"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li> --}}
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="{{ asset('/image/default.png') }}" alt="User Image" width="40">
        <div>
          <p class="app-sidebar__user-name">{{ Auth::user()->name }}</p>
          <p class="app-sidebar__user-designation">Editor</p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item" href="{{ route('editor') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li><a class="app-menu__item" href="{{ route('post.index') }}"><i class="app-menu__icon fa fa-newspaper-o"></i><span class="app-menu__label">Post</span></a></li>
        <li><a class="app-menu__item" href="{{ route('postcategory.index') }}"><i class="app-menu__icon fa fa-clone"></i><span class="app-menu__label">Categorias</span></a></li>
      </ul>
    </aside>
    <main class="app-content" id="editorapp">
      @yield('content')
    </main>

    <script src="{{ asset('js/app.js') }}"></script>

    @yield('scripts')
  </body>
</html>
