@extends('layouts.panel') 

@section('title-nav')
  Detalles del rol
@endsection

@section('main-content')

<div class="col-md-4 offset-4 mt-4">
    <div class="card">
        <div class="card-body">
          <h2 class="card-title">Detalles del rol</h2>
          <h5 class="card-subtitle mt-2">Nombre</h5>
          <p class="card-text">{{$rol->name}}</p>
          
          <h5 class="card-subtitle mt-2">Descripcion</h5>
          <p class="card-text">{{$rol->description}}</p>

          <h5 class="card-subtitle mt-2">Estado</h5>
          @if ($rol->state == 1)
          <p class="card-text">Activo <span class="text-success"><i class="fa-solid fa-check"></i></span></p>
          @else
          <p class="card-text">No activo <span class="text-danger" style="font-weight: 800"><b><i class="fa-solid fa-x"></i></span></b></p>
          @endif
        </div>
</div>

@endsection