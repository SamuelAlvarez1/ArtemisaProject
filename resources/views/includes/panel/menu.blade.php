
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{url('/home')}}"  data-delay="300" data-toggle="tooltip" data-placement="right" title="Ver reportes del restaurante">
                <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
        </li>
    </ul>


<h6 class="navbar-heading text-muted">
    Gestionar
</h6>
<ul class="navbar-nav">

    <li class="nav-item">
        <a class="nav-link" href="{{url('/sales')}}">
            <i class="ni ni-cart text-info"></i> Ventas
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('/bookings')}}">
            <i class="fa-solid fa-clipboard-list text-blue"></i> Reservas
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('/events')}}"  >
            <i class="fa-solid fa-star"></i> Eventos
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{url('/customers')}}">
            <i class="fa-solid fa-circle-user text-warning"></i> Clientes
        </a>
    </li>
    @if (auth()->user()->idRol == 1)
    <li class="nav-item">
        <a class="nav-link" href="{{url('/categories')}}">
            <i class="fa-solid fa-utensils"></i> Categorías
        </a>
    </li>
    @endif

    @if(auth()->user()->idRol == 2 || auth()->user()->idRol == 1)
    @if (auth()->user()->idRol == 1)
            <li class="nav-item">
                <a class="nav-link" href="{{url('/plates')}}">
                    <i class="ni ni-shop text-danger"></i> Menú
                </a>
            </li>

        <li class="nav-item">
            <a class="nav-link" href="{{url('/users')}}">
                <i class="ni ni-circle-08 text-primary"></i>Usuarios
            </a>
        </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/roles')}}">
                    <i class="fa-solid fa-user-gear text-danger"></i> Roles
                </a>
            </li>
        @endif




    @endif


</ul>



