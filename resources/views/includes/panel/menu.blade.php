@if(auth()->user()->idRol == 1)
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{url('/home')}}" data-toggle="tooltip" data-placement="right" title="Entrar a ver los reportes del restaurante">
                <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
        </li>
    </ul>
@endif

<h6 class="navbar-heading text-muted">
    Gestionar
</h6>
<ul class="navbar-nav">

    <li class="nav-item">
        <a class="nav-link" href="{{url('/sales')}}" data-toggle="tooltip" data-placement="right" title="Entrar a ver el listado de ventas">
            <i class="ni ni-cart text-info"></i> Ventas
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('/bookings')}}" data-toggle="tooltip" data-placement="right" title="Entrar a ver el listado de reservas">
            <i class="fa-solid fa-clipboard-list text-blue"></i> Reservas
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('/events')}}" data-toggle="tooltip" data-placement="right" title="Entrar a ver el listado de eventos">
            <i class="fa-solid fa-star"></i> Eventos
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{url('/customers')}}" data-toggle="tooltip" data-placement="right" title="Entrar a ver el listado de clientes">
            <i class="fa-solid fa-circle-user text-warning"></i> Clientes
        </a>
    </li>
    @if (auth()->user()->idRol == 1)
    <li class="nav-item">
        <a class="nav-link" href="{{url('/categories')}}" data-toggle="tooltip" data-placement="right" title="Entrar a ver el listado de categorias">
            <i class="fa-solid fa-utensils"></i> Categorías
        </a>
    </li>    
    @endif
    
    @if(auth()->user()->idRol == 2 || auth()->user()->idRol == 1)
    @if (auth()->user()->idRol == 1)
            <li class="nav-item">
                <a class="nav-link" href="{{url('/plates')}}" data-toggle="tooltip" data-placement="right" title="Entrar a ver el listado de platillos">
                    <i class="ni ni-shop text-danger"></i> Menú
                </a>
            </li>

        <li class="nav-item">
            <a class="nav-link" href="{{url('/users')}}" data-toggle="tooltip" data-placement="right" title="Entrar a ver el listado de usuarios">
                <i class="ni ni-circle-08 text-primary"></i>Usuarios
            </a>
        </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/roles')}}" data-toggle="tooltip" data-placement="right" title="Entrar a ver el listado de roles">
                    <i class="fa-solid fa-user-gear text-danger"></i> Roles
                </a>
            </li>
        @endif




    @endif


</ul>



