@extends('layouts.panel')


@section('title-nav')
    Detalles del cliente
@endsection

@section('main-content')

    <div class="col-md-7 offset-2 my-2">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h2>Detalles del cliente</h2>
                    </div>
                    <div class="col text-right">
                        <a href="{{url('/customers/'.$customer->id.'/edit')}}" class="btn btn-sm btn-warning">
                            Editar este cliente
                        </a>
                        <a href="{{url('/customers')}}" class="btn btn-sm btn-danger">
                            Regresar
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h4 class="card-subtitle mt-2">Nombre del evento</h4>
                <p class="card-text">{{$customer->name}}</p>
                <h4 class="card-subtitle mt-2">Descripción</h4>
                <p class="card-text">{{$customer->document}}</p>
                <h4 class="card-subtitle mt-2">Precio de decoración</h4>
                <p class="card-text">{{$customer->phoneNumber}}</p>
                <h4 class="card-subtitle mt-2">Precio de entrada</h4>
                <p class="card-text">{{$customer->address}}</p>
                <h4 class="card-subtitle mt-2">Fecha de creación del cliente</h4>
                <p class="card-text">{{$customer->created_at}}</p>
                <h4 class="card-subtitle mt-2">Ultima actualización del cliente</h4>
                <p class="card-text">{{$customer->updated_at}}</p>
                <h4 class="card-subtitle mt-2">Usuario que creó el Cliente</h4>
                <ul>
                    <li><p class="card-text">Nombre: {{$user->name.' '.$user->last_name}}</p></li>
                    <li><p class="card-text">Número de telefono: {{$user->phone}}</p></li>
                    <li><p class="card-text">Rol: {{$role->name}}</p></li>
                </ul>
                <h4 class="card-subtitle mt-2">Estado</h4>
                @if ($customer->state == 0)
                    <span class="badge badge-danger">No activo</span>
                @else
                    <span class="badge badge-success">Activo</span>
                @endif
            </div>


        </div>


@endsection
