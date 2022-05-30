
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
                        <a href="{{url()->previous()}}" class="btn btn-sm btn-outline-danger">
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
                <p class="card-text"><a class="text-dark" href="{{url('/roles/'.$user->idRol)}}"><u>{{$user->rol}}</u></a></p>
                <h4 class="card-subtitle mt-2">Estado</h4>
                @if ($user->state == 0)
                    <span class="badge badge-danger">No activo</span>
                @else
                    <span class="badge badge-success">Activo</span>
                @endif
            </div>


        </div>


@endsection
