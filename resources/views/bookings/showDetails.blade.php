@extends('layouts.panel')

@section('title-nav')
    Detalles de la reserva
@endsection

@section('main-content')

    <div class="col-md-6 offset-3 mt-4">
        <div class="card">
            <div class="card-header">

                <a href="{{url('/bookings')}}" class="btn btn-sm btn-outline-danger float-right">
                    Regresar
                </a>

                @if ($booking->idState == "1" || $booking->idState == "2")
                    <a href="{{url('/bookings/'.$booking->id.'/edit')}}"
                       class="btn btn-sm btn-outline-warning mx-2 float-right">
                        Editar esta reserva
                    </a>
                @endif
            </div>
            <div class="card-body text-center">

                <div class="row mb-5">
                    <div class="col">
                        <h4 class="mt-2">Nombre del cliente</h4>
                        <p class="card-text">{{$booking->customerName}}</p>
                    </div>
                    <div class="col">
                        <h4 class=" mt-2">Evento</h4>
                        <p class="card-text">{{($booking->idEvent == null) ? 'sin evento' : $booking->eventName}}</p>
                    </div>
                    <div class="col">
                        @if ($booking->idState == "3")
                            <h4 class=" mt-2">Fecha final de la reserva</h4>
                            <p class="card-text">{{$booking->final_date->isoFormat('dddd D MMMM YYYY, h:mm a')}}</p>
                        @endif

                        <h4 class=" mt-2">Estado</h4>
                        @if ($booking->idState == 1)
                                <span class="badge badge-danger">Cancelada <i class="fa-solid fa-x"></i></span>
                        @endif
                        @if ($booking->idState == 2)
                                <span class="badge badge-primary">En proceso <i class="fa-solid fa-clock"></i></span>
                        @endif
                        @if ($booking->idState == 3)
                                <span class="badge badge-success">Aprobada <i class="fa-solid fa-check"></i></span>

                            @endif
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col">
                        <h4 class=" mt-2">Fecha de la reserva</h4>
                        <p class="card-text">{{$booking->start_date->isoFormat('dddd D MMMM YYYY, h:mm a')}}</p>
                    </div>
                    <div class="col">
                        <h4 class=" mt-2">Cantidad de personas</h4>
                        <p class="card-text">{{$booking->amount_people}}</p>
                    </div>
                </div>
            </div>
        </div>

@endsection
