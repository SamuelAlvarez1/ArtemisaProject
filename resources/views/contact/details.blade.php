@extends('layouts.panel')


@section('title-nav', 'Detalles del mensaje')

@section('main-content')

    <div class="col-md-9 mx-auto my-2">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h2>Detalles del mensaje</h2>
                    </div>
                    <div class="col text-right">
                        <a href="{{url('/home')}}" class="btn mt-2 btn-sm btn-danger">Regresar</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h4 class="card-subtitle mt-2">Nombre del remitente</h4>
                <p class="card-text">{{$message->name}}</p>
                <h4 class="card-subtitle mt-2">Email del remitente</h4>
                <p class="card-text">{{$message->email}}</p>
                <h4 class="card-subtitle mt-2">Mensaje</h4>
                <p class="card-text">{{$message->message}}</p>
                <h4 class="card-subtitle mt-2">Fecha de envío</h4>
                <p class="card-text">{{$message->created_at}}</p>
                <h4 class="card-subtitle mt-2">Estado</h4>
                @if ($message->read == 0)
                    <span class="badge badge-warning">No leído</span>
                @else
                    <span class="badge badge-primary">Leído</span>
                @endif
            </div>


        </div>


@endsection
