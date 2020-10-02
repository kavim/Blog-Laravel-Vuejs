<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta name="description" content="mapp.">
    <!-- Twitter meta-->
    {{-- <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya"> --}}
    <!-- Open Graph Meta-->
    {{-- <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular."> --}}
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
        <a class="app-header__logo" href="index.html">MAPP</a>
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
    <main class="app-content" id="app">
      @yield('content')
    </main>

    <script src="{{ asset('js/app.js') }}"></script>

    @yield('scripts')
    <!-- Essential javascripts for application to work-->
    {{-- <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script> --}}
    <!-- The javascript plugin to display page loading on top-->
    {{-- <script src="js/plugins/pace.min.js"></script> --}}
    <!-- Page specific javascripts-->
    <!-- Google analytics script-->
    {{-- <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
      	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      	ga('create', 'UA-72504830-1', 'auto');
      	ga('send', 'pageview');
      }
    </script> --}}
  </body>
</html>
