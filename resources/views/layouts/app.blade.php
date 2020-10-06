<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Centro Oftamologico - Cuenta {{-- {{ config('app.name', 'Laravel') }} --}}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!----font awesome---->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.1/css/all.css"
        integrity="sha384-xxzQGERXS00kBmZW/6qxqJPyxW3UR0BPsL4c8ILaIWXva5kFi7TxkIIaMiKtqV1Q" crossorigin="anonymous">

    <!-- Styles bootstrapp-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{--  <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> --}}

    {{--  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}"> --}}

    @yield('link')

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!---necesario--->

    @livewireStyles
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div id="app"> {{-- navbar navbar-expand-lg navbar-light bg-light --}}
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <div class="container mt-2 mb-2">
                    {{-- <a class="navbar-brand" href="{{ url('/evento') }}">
                    {{ config('app.name', 'Laravel') }}
                    </a> --}}


                    @if (isset($menu) )
                    @include('layouts.sidebar')
                    @yield('openSidebar')
                    @endif


                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Registro</a>
                            </li>
                            @endif
                            @else

                            {{-- @include('paciente.menu-paciente') --}}

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-primary" href="#"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    <strong> {{ Auth::user()->name }}</strong> <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                        <strong>{{ __('Cerrar sesión') }}</strong>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <!----sweetalert2-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        @livewireScripts

        <main>
            @yield('content')
            @yield('medicos-centro')
            @yield('sidebar')
            @yield('crearRol')
            @yield('asignarRolUser')
            @yield('editar-datos')
            @yield('foto-perfil')
            @yield('medico-horario')
            @yield('crearUsuario')
            @yield('motivo-cita')
            @yield('consultorios')
            @yield('citas-agendadas')
        </main>
    </div>


    @yield('scripts')
    @yield('scripts_Crear_Rol')
    @yield('scripts_Asginar_Rol')


    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
</body>

</html>