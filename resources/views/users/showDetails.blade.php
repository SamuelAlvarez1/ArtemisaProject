@extends('layouts.panel') 
@section('main-content')

<div class="col-md-4 offset-4 mt-4">
    <div class="card">
        <div class="card-body">
          <h2 class="card-title">Detalles del usuario</h2>
          <h5 class="card-subtitle mt-2">Nombre</h5>
          <p class="card-text">{{$user->name}}</p>
          
          <h5 class="card-subtitle mt-2">Apellidos</h5>
          <p class="card-text">{{$user->last_name}}</p>

          <h5 class="card-subtitle mt-2">Email</h5>
          <p class="card-text">{{$user->email}}</p>

          <h5 class="card-subtitle mt-2">Teléfono</h5>
          <p class="card-text">{{$user->phone}}</p>

          <h5 class="card-subtitle mt-2">Rol</h5>
          <p class="card-text">{{$user->rol}}</p>

          <h5 class="card-subtitle mt-2">Estado</h5>
          @if ($user->state == 1)
          <p class="card-text">Activo <span class="text-success"><i class="fa-solid fa-check"></i></span></p>
          @else
          <p class="card-text">No activo <span class="text-danger" style="font-weight: 800"><b><i class="fa-solid fa-x"></i></span></b></p>
          @endif
        </div>
</div>

@endsection