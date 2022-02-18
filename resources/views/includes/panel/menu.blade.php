@if(auth()->user()->role == 'admin')
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{url('/home')}}">
                <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
        </li>
    </ul>
@endif

<h6 class="navbar-heading text-muted">
    Gestionar
</h6>
<ul class="navbar-nav">


    @if(auth()->user()->role == 'empleado' || auth()->user()->role == 'admin')
        <li class="nav-item">
            <a class="nav-link" href="{{url('/home')}}">
                <i class="ni ni-circle-08 text-primary"></i>Usuarios
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/home')}}">
                <i class="ni ni-shop text-danger"></i> Menú
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/home')}}">
                <i class="ni ni-cart text-info"></i> Ventas
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/home')}}">
                <i class="fa-solid fa-star"></i> Eventos
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/home')}}">
                <i class="fa-solid fa-circle-user text-warning"></i> Clientes
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/home')}}">
                <i class="fa-solid fa-clipboard-list text-blue"></i> Reservas
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/home')}}">
                <i class="fa-solid fa-user-gear text-danger"></i> Roles
            </a>
        </li>
    @endif


</ul>

@if(auth()->user()->role == 'admin')
    <hr class="my-3">
    <h6 class="navbar-heading text-muted">Reports</h6>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{url('/home')}}">
                <i class="ni ni-collection text-blue"></i> Appointment frecuency
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/home')}}">
                <i class="ni ni-spaceship text-red"></i> Most active doctors
            </a>
        </li>

        <hr class="my-3">
    </ul>
@endif

