@extends('layouts.panel') 
@section('main-content')

<div class="col-md-4 offset-4 mt-4">
    <div class="card">
        <div class="card-body">
          <h2 class="card-title">Detalles del usuario</h2>
          <h5 class="card-subtitle mt-2">Nombre</h5>
          <p class="card-text">{{$usuario->name}}</p>
          
          <h5 class="card-subtitle mt-2">Apellidos</h5>
          <p class="card-text">{{$usuario->apellidos}}</p>

          <h5 class="card-subtitle mt-2">Email</h5>
          <p class="card-text">{{$usuario->email}}</p>

          <h5 class="card-subtitle mt-2">Teléfono</h5>
          <p class="card-text">{{$usuario->telefono}}</p>

          <h5 class="card-subtitle mt-2">Rol</h5>
          <p class="card-text">{{$usuario->rol}}</p>

          <h5 class="card-subtitle mt-2">Estado</h5>
          @if ($usuario->estado == 1)
          <p class="card-text">Activo <span class="text-success"><i class="fa-solid fa-check"></i></span></p>
          @else
          <p class="card-text">No activo <span class="text-danger" style="font-weight: 800"><b><i class="fa-solid fa-x"></i></span></b></p>
          @endif
        </div>
</div>

@endsection