@extends('layouts.panel')
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
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-subtitle mt-2">Nombre del evento</h5>
                <p class="card-text">{{$customer->name}}</p>
                <h5 class="card-subtitle mt-2">Descripción</h5>
                <p class="card-text">{{$customer->document}}</p>
                <h5 class="card-subtitle mt-2">Precio de decoración</h5>
                <p class="card-text">{{$customer->phoneNumber}}</p>
                <h5 class="card-subtitle mt-2">Precio de entrada</h5>
                <p class="card-text">{{$customer->address}}</p>
                <h5 class="card-subtitle mt-2">Fecha de creación del cliente</h5>
                <p class="card-text">{{$customer->created_at}}</p>
                <h5 class="card-subtitle mt-2">Ultima actualización del cliente</h5>
                <p class="card-text">{{$customer->updated_at}}</p>
                <h5 class="card-subtitle mt-2">Estado</h5>
                @if ($customer->state == 0)
                    <p class="card-text">No activo <span class="text-danger"><i class="fa-solid fa-x"></i></span></p>
                @else
                    <p class="card-text">Activo <span class="text-success"><i class="fa-solid fa-check"></i></span></p>
                @endif
            </div>


        </div>


@endsection
