@extends('layouts.panel')


@section('title-nav')
Detalles del rol
@endsection

@section('main-content')

<div class="col-md-7 offset-2 my-2">
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col text-right">
                    <a href="{{url('/roles/'.$rol->id.'/edit')}}" class="btn btn-sm btn-outline-warning">
                        Editar esta rol
                    </a>
                    <a href="{{url('/roles')}}" class="btn btn-sm btn-outline-danger">
                        Regresar
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body text-center">
            <div class="row mb-5">
                <div class="col">
                    <h4 class="mt-2">Nombre del rol</h4>
                    <p class="card-text">{{$rol->name}}</p>
                </div>
                <div class="col">
                    <h4 class="mt-2">Descripción</h4>
                    <p class="card-text">{{$rol->description}}</p>
                </div>
                <div class="col">
                    <h4 class="mt-2">Estado</h4>
                    @if ($rol->state == 0)
                    <span class="badge badge-danger">No activo</span>
                    @else
                    <span class="badge badge-success">Activo</span>
                    @endif
                </div>
            </div>

            <div class="row">
              
                <div class="col">
                <h4 class="mb-3">Usuarios con este rol</h4>

                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Nombre completo</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(sizeof($users) > 0)
                            @foreach ($users as $user)
                            <tr>
                                <td>{{$user->name}} {{$user->last_name}}</td>
                                <td>{{$user->email}}</td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="2" class="text-center">
                                    Sin información
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>


    </div>


    @endsection