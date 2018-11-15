<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#343A40" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!--<script src="{{ asset('js/app.js') }}" defer></script>-->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">


    <link rel="stylesheet" href="{{ asset('css/fontello.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('styles')
    <!-- Styles -->
    <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">-->
</head>

<body class="bg-dashboar">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-2">
        <a class="navbar-brand" href=""{{ url('/home') }}"">SSCD</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav">
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}"><i class="icon-plug"></i>&nbsp;Iniciar Sesión</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}"><i class="icon-user"></i>&nbsp;Registrarse</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="#!">ss</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownConfigUsers" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-users"></i>Administrar usuarios
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownConfigUsers">
                        <a class="dropdown-item" href="{{ route('usuarios') }}">Usuarios</a>
                        <a class="dropdown-item" href="{{ route('usuario_establecimiento') }}">Asignar usuario a establecimiento</a>
                    </div>
                </li>
                <!--Drop Config-->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownConfigTurism" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-wrench"></i>Configurar
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownConfigTurism">
                        <a class="dropdown-item" href="{{ route('tipos-establecimientos') }}">Tipos de establecimientos</a>
                        <a class="dropdown-item" href="{{ route('establecimientos') }}">Establecimientos</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('paises') }}">Paises</a>
                        <a class="dropdown-item" href="{{ route('tipos-documentos') }}">Tipos de documentos</a>
                        <a class="dropdown-item" href="{{ route('profesiones') }}">Profesiones</a>
                        <a class="dropdown-item" href="{{ route('nacionalidades') }}">Nacionalidades</a>
                    </div>
                </li>
                <!--Drop Login-->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownLogin" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-user-outline"></i>Cuenta
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownLogin">
                    <a class="dropdown-item" href="#">{{ Auth::user()->name }}</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Salir') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </nav>
    <div class="p-2">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="{{ URL::asset('js/alert4mk.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    @yield('scripts')
</body>

</html>