@extends('layouts.panel') 

@section('title-nav')
    Detalles de la reserva
@endsection

@section('main-content')

<div class="col-md-6 offset-3 mt-4">
    <div class="card">
      <div class="card-header">
        <a href="{{url('/bookings')}}" class="btn btn-sm btn-outline-danger float-right"  data-toggle="tooltip" data-placement="top" title="Volver al listado de reservas">
          Regresar
      </a>
        <h2 class="">Detalles de la reserva</h2>
      </div>
        <div class="card-body">
          <h5 class="card-subtitle  ">Nombre del cliente</h5>
          <p class="card-text">{{$booking->customerName}}</p>
          
          <h5 class="card-subtitle mt-2">Evento</h5>
          <p class="card-text">{{($booking->idEvent == null) ? 'sin evento' : $booking->eventName}}</p>

          <h5 class="card-subtitle mt-2">cantidad de personas</h5>
          <p class="card-text">{{$booking->amount_people}}</p>

          <h5 class="card-subtitle mt-2">Fecha de inicio</h5>
          <p class="card-text">{{$booking->start_date->isoFormat('dddd D MMMM YYYY, h:mm a')}}</p>

          @if ($booking->idState == "3")
          <h5 class="card-subtitle mt-2">fecha de la reserva</h5>
          <p class="card-text">{{$booking->final_date->isoFormat('dddd D MMMM YYYY, h:mm a')}}</p>
          @endif

          <h5 class="card-subtitle mt-2">Estado</h5>
          @if ($booking->idState == 1)
          <p class="card-text">Cancelada <span class="text-danger"><i class="fa-solid fa-x"></i></span></p>
          @endif
          @if ($booking->idState == 2)
          <p class="card-text">En proceso <span class="text-warning"><i class="fa-solid fa-clock"></i></span></p>
          @endif
          @if ($booking->idState == 3)
          <p class="card-text">Aprobada <span class="text-success"><i class="fa-solid fa-check"></i></span></p>
          @endif

          @if ($booking->idState == "1" || $booking->idState == "2")
          <a href="{{url('/bookings/'.$booking->id.'/edit')}}" class="btn btn-sm btn-outline-warning float-right"  data-toggle="tooltip" data-placement="top" title="Editar esta reserva">
            editar esta reserva
        </a>    
          @endif
        </div>

        
</div>

@endsection