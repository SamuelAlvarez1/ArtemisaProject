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
            <div class="card-body text-center">
                <div class="row mb-3">
                    <div class="col">
                        <h4 class="mt-2">Nombre del usuario</h4>
                        <p class="card-text">{{$user->name}}</p>
                    </div>
                    <div class="col">
                        <h4 class="mt-2 ">Apellidos</h4>
                        <p class="card-text">{{$user->last_name}}</p>
                    </div>

                </div>
                <div class="row mb-3">
                    <div class="col">
                        <h4 class="mt-2 ">Teléfono</h4>
                        <p class="card-text">{{$user->phone}}</p>
                    </div>

                    <div class="col">
                        <h4 class="mt-2 ">Correo electrónico</h4>
                        <p class="card-text">{{$user->email}}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <h4 class="mt-2 ">Rol</h4>
                        <p class="card-text"><a class="text-dark"
                                                href="{{url('/roles/'.$user->idRol)}}"><u>{{$user->rol}}</u></a></p>
                    </div>
                    <div class="col">
                        <h4 class="mt-2">Estado</h4>
                        @if ($user->state == 0)
                            <span class="badge badge-danger">No activo</span>
                        @else
                            <span class="badge badge-success">Activo</span>
                        @endif
                    </div>
                </div>


            </div>


        </div>


@endsection
