@extends('layouts.panel')


@section('title-nav')
    Detalles del cliente
@endsection

@section('main-content')

    <div class="col-md-10 mx-auto my-2">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h2>Detalles del cliente</h2>
                    </div>
                    <div class="col text-right">
                        <a href="{{url('/customers/'.$customer->id.'/edit')}}" class="btn mt-2 btn-sm btn-warning">Editar
                            este cliente</a>
                        <a href="{{url('/customers')}}" class="btn mt-2 btn-sm btn-danger">Regresar</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4 row-cols-2">
                    <div class="col">
                        <h4 class="card-subtitle mt-2">Nombre del cliente:</h4>
                        <p class="card-text">{{$customer->name}}</p>
                        <h4 class="card-subtitle mt-2">Documento:</h4>
                        <p class="card-text">{{$customer->document}}</p>
                        <h4 class="card-subtitle mt-2">Número de teléfono:</h4>
                        <p class="card-text">{{$customer->phoneNumber}}</p>
                        <h4 class="card-subtitle mt-2">Dirección:</h4>
                        <p class="card-text">{{$customer->address}}</p>
                        <h4 class="card-subtitle mt-2">Fecha de creación del cliente:</h4>
                        <p class="card-text">{{$customer->created_at}}</p>
                    </div>
                    <div class="col">
                        <h4 class="card-subtitle mt-2">Ultima actualización de información:</h4>
                        <p class="card-text">{{$customer->updated_at}}</p>
                        <h4 class="card-subtitle mt-2">Usuario que creó el cliente:</h4>
                        <ul>
                            <li><p class="card-text">Nombre: {{$customer->user->name.' '.$customer->user->last_name}}</p></li>
                            <li><p class="card-text">Número de teléfono: {{$customer->user->phone}}</p></li>
                            <li><p class="card-text">Rol: {{$customer->user->role->name}}</p></li>
                        </ul>
                        <h4 class="card-subtitle mt-2">Cantidad de reservas:</h4>
                        <p class="card-text">{{$bookingsAmount}}</p>
                        <h4 class="card-subtitle mt-2">Cantidad de compras:</h4>
                        <p class="card-text">{{$salesAmount}}</p>
                        <h4 class="card-subtitle mt-2">Estado:</h4>
                        @if ($customer->state == 0)
                            <span class="badge badge-danger">No activo</span>
                        @else
                            <span class="badge badge-success">Activo</span>
                        @endif
                    </div>
                </div>
            </div>

        </div>

@endsection
