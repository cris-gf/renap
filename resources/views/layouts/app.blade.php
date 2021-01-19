<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Registro Nacional de las Personas</title>
    <link rel="icon" type="image/png" href="https://www.renap.gob.gt/sites/default/files/huella.png"/>
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="background: url(https://fondosmil.com/fondo/457.png);">
    <div id="app">
        <!--Navbar-->
        <nav class="navbar navbar-dark bg-primary shadow-sm">
                <a href="/">
                    <img src="https://egob.renap.gob.gt/FrontEnd/img/plantilla/renap-login.png" style="width: 300px; height: 50px; margin-left:30px">
                </a>
                <div  id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}" style="margin-right: 30px;">Iniciar Sesión (Administrador)</a>
                                </li>
                            @endif
                        @else
                            <span style="display: inline;" class="nav-link">
                                {{ Auth::user()->name }}
                                <a
                                    class="btn btn-primary my-2 my-sm-0"
                                    href="{{ route('logout') }}"
                                    style="margin-left: 10px; margin-right: 30px; padding-bottom: 13px"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-power" viewBox="0 0 16 16" onclick="return confirm('¿Desea cerrar la sesión actual?')">
                                        <path d="M7.5 1v7h1V1h-1z"/>
                                        <path d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z"/>
                                      </svg>
                                </a>
                            </span>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>        
                        @endguest
                    </ul>
                </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
