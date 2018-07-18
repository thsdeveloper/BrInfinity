
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>

</head>
<body>
  <div id="app">
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">

          <!-- Collapsed Hamburger -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <!-- Branding Image -->
          <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
          </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
          <!-- Left Side Of Navbar -->
          <ul class="nav navbar-nav">
            &nbsp;
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
            @guest
              <li><a href="{{ route('login') }}">Login</a></li>
              <li><a href="{{ route('register') }}">Register</a></li>
            @else
              <li><a href="{{ url('cotacao') }}"><i class="fas fa-clipboard-list"></i> Cotação</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                  Cadastros <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="{{ url('seguradoras') }}"><i class="fas fa-building"></i> Seguradoras</a></li>
                  <li><a href="{{ url('corretoras') }}"><i class="fas fa-briefcase"></i> Corretoras</a></li>
                  <li><a href="{{ url('usuarios') }}"><i class="fas fa-users"></i> Usuários</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                  Produção <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="{{ url('producao') }}"><i class="far fa-list-alt"></i> Geral</a></li>
                  {{-- <li><a href="{{ url('relacionar-producao') }}"><i class="far fa-list-alt"></i> Relacionar Produção</a></li> --}}
                  <li><a href="{{ url('relatorio') }}"><i class="fas fa-chart-pie"></i> Relatório Anual</a></li>
                  <li><a href="{{ url('relatorio/mensal') }}"><i class="fas fa-chart-pie"></i> Relatório Mensal</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                  {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu">
                  <li><a href="{{ url('configuracoes') }}"><i class="fas fa-cog"></i> Configurações</a></li>
                  <li>
                    <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Sair do sistema
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                </li>
              </ul>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <div class="title m-b-md">
      <h2><i class="fas fa-angle-right"></i> @yield('title')</h2>
    </div>
    @yield('content')
  </div>
  <div class="container-fluid">
    @yield('content-fluid')
  </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.js"></script>
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
</body>
</html>
