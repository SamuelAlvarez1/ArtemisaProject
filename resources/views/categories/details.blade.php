@extends('layouts.panel')


@section('title-nav')
    Detalles de la categoría
@endsection

@section('main-content')

    <div class="col-md-7 offset-2 my-2">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col text-right">
                        <a href="{{url('/categories/'.$category->id.'/edit')}}" class="btn btn-sm btn-outline-warning">
                            Editar esta categoría
                        </a>
                        <a href="{{url('/categories')}}" class="btn btn-sm btn-outline-danger">
                            Regresar
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body d-block m-auto text-center">
                <h4 class="card-subtitle mt-2">Nombre de la categoría</h4>
                <p class="card-text">{{$category->name}}</p>
                <h4 class="card-subtitle mt-2 mb-3">Usuario que creó la categoría</h4>
                <p class="card-text"><b>Nombre: </b>{{$user->name.' '.$user->last_name}}</p>
                <p class="card-text"><b>Número de telefono: </b>{{$user->phone}}</p>
                <p class="card-text"><b>Rol:</b> {{$role->name}}</p>

                <h4 class="card-subtitle mt-2">Estado</h4>
                @if ($category->state == 0)
                    <span class="badge badge-danger">No activo</span>
                @else
                    <span class="badge badge-success">Activo</span>
                @endif
            </div>


        </div>


@endsection
