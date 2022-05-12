
    @extends('layouts.panel')


@section('title-nav')
Detalles del usuario {{$user->name}}
@endsection

@section('main-content')

    <div class="col-md-7 offset-2 my-2">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col text-right">
                        <a href="{{url('/users/'.$user->id.'/edit')}}" class="btn btn-sm btn-outline-warning">
                            Editar esta usuario
                        </a>
                        <a href="{{url('/users')}}" class="btn btn-sm btn-outline-danger">
                            Regresar
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body d-block m-auto text-center">
                <h4 class="card-subtitle mt-2">Nombre del usuario</h4>
                <p class="card-text">{{$user->name}}</p>
                <h4 class="card-subtitle mt-2 mb-3">Apellidos</h4>
                <p class="card-text">{{$user->last_name}}</p>
                <h4 class="card-subtitle mt-2 mb-3">Correo electrónico</h4>
                <p class="card-text">{{$user->email}}</p>
                <h4 class="card-subtitle mt-2 mb-3">Teléfono</h4>
                <p class="card-text">{{$user->phone}}</p>
                <h4 class="card-subtitle mt-2 mb-3">Rol</h4>
                <p class="card-text">{{$user->rol}}</p>
                
                <h4 class="card-subtitle mt-2">Estado</h4>
                @if ($user->state == 0)
                    <span class="badge badge-danger">No activo</span>
                @else
                    <span class="badge badge-success">Activo</span>
                @endif
            </div>


        </div>


@endsection

  
 



{{-- @extends('layouts.panel') 


@section('title-nav')
    
@endsection

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

@endsection --}}