<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Artemisa">
    <meta name="description" content="resto-bar">
    <meta name="author" content="Artemisa restobar">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Artemisa</title>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Favicon -->
    <link href="{{asset('img/brand/favicon.png')}}" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="{{asset('vendor/nucleo/css/nucleo.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
          integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- Argon CSS -->
    <link type="text/css" href="{{asset('css/argon.css?v=1.0.0')}}" rel="stylesheet">

    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />

    @yield('styles')
</head>

<body>
<!-- Sidenav -->
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-dark bg-dark" id="sidenav-main"
     aria-label="side-nav">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
                aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand text-white" href="{{url('/')}}" data-toggle="tooltip" data-placement="right"
           title="Ir a la página de bienvenida">
            <img src="{{asset('img/landing/navbar-logo.png')}}" alt="Logo">
            Artemisa
        </a>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{url('/')}}" class="text-dark">
                            Artemisa
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                                data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                                aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Navigation -->

            @include('includes.panel.menu')


            <!-- Heading -->

        </div>
    </div>
</nav>
<div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-white" id="navbar-main" aria-label="top-nav">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="h4 mb-0 text-dark text-uppercase d-none d-lg-inline-block" href="">@yield('title-nav')</a>

            <!-- User -->
            <ul class="navbar-nav align-items-center d-none d-md-flex">
                <li class="nav-item dropdown" title="Ver reservas y ventas desde tu ultimo cierre de sesión">
                    <a id="navbarDropdown" class="nav-link" href="#" role="button"
                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i aria-hidden="true" class="ni ni-bell-55"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right"
                         aria-labelledby="navbar-default_dropdown_1">
                        <div class=" dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Desde la ultima sesión</h6>
                        </div>
                        <a class="dropdown-item" href="{{url('sales/')}}">Ventas: <span class="badge badge-danger"
                                                                                        id="salesCount">
                            </span></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{url('bookings')}}">Reservas: <span class="badge badge-danger"
                                                                                            id="bookingsCount">
                            </span></a>
                    </div>
                </li>
                @if(auth()->user()->idRol == 1)
                    <li class="nav-item dropdown" title="Ver ultimos 2 mensajes enviados por los clientes">
                        <a id="navbarDropdown" class="nav-link" href="#" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i aria-hidden="true" class="fa-solid fa-comments"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-arrow dropdown-menu-right"
                             aria-labelledby="navbar-default_dropdown_2" id="lastMessages-body">
                            {{--  Last messages  --}}
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Aún no hay mensajes</h6>
                            </div>
                        </div>
                    </li>
                @endif
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" id="navbarDropdown" class="nav-link" href="#" role="button"
                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="{{asset('img/theme/avatar.jpg')}}">
                </span>
                            <div class="media-body ml-2 d-none d-lg-block">
                                <span class="mb-0 text-sm  font-weight-bold">{{auth()->user()->name}}</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu active dropdown-menu-arrow dropdown-menu-right">
                        <div class=" dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Bienvenido!</h6>
                        </div>
                        <a href="/users/profile/{{auth()->user()->id}}" class="dropdown-item">
                            <i aria-hidden="true" class="ni ni-single-02"></i>
                            <span>Mi perfil</span>
                        </a>
                        <a href="{{url("/users/".auth()->user()->id."/edit")}}" class="dropdown-item">
                            <i aria-hidden="true" class="ni ni-settings-gear-65"></i>
                            <span>Configuración</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="" class="dropdown-item"
                           onclick="event.preventDefault(); document.getElementById('form-logout').submit();">
                            <i aria-hidden="true" class="ni ni-user-run"></i>
                            <span>Cerrar sesion</span>
                        </a>
                        <form action="{{route('logout')}}" method="post" style="display: none;" id="form-logout">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Header -->
    <div class="header bg-white pb-2 pt-6 pt-md-6">

    </div>
    <div class="container-fluid mt-5 div-alerts">
        @include('includes.errors')
        @yield('main-content')
        @include('includes.panel.footer')
    </div>
</div>
<!-- Argon Scripts -->
<!-- Core -->
<script src="{{asset('vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('vendor\bootstrap-datepicker\dist\js\bootstrap-datepicker.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
<script src="{{asset('vendor/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Argon JS -->
@yield('scripts')
<script>
    $.ajax({
        url: `/sales/getSalesCount`,
        type: 'GET',
        success: function (platesCount) {
            $("#salesCount").html(platesCount);
        }
    });
    $.ajax({
        url: `/bookings/getBookingsCount`,
        type: 'GET',
        success: function (bookingsCount) {
            $("#bookingsCount").html(bookingsCount);
        }
    });

    @if(auth()->user()->idRol == 1)
    $.ajax({
        url: `/contact/lastMessages`,
        type: 'GET',
        success: function (lastMessages) {
            var content = '';
            $(function () {
                $.each(lastMessages, function (index, lastMessages) {
                    content += `<a href="/contact/${lastMessages.id}" class="dropdown-item">
                        <div class="media">
                        <img style="width:50px" src="{{asset("img/theme/avatar.jpg")}}" alt="User Avatar" class="rounded-circle mr-3 img-circle">
                        <div class="media-body">
                        <h4 class="dropdown-item-title">${lastMessages.name}</h4>
                        <p class="text-sm">${lastMessages.message.substring(0, 18)}...</p>
                        </div>
                        </div>
                        </a>
                        <div class="dropdown-divider"></div>`
                });
                if (content !== '') {
                    content += `<div class=" dropdown-header text-center noti-title">
                                    <a href="/contact">Ver todos los mensajes</a>
                                </div>`
                    $("#lastMessages-body").html(content);
                }
            })
        }
    });
    @endif
</script>
<script src="{{asset('js/argon.js?v=1.0.0')}}"></script>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

</body>

</html>
