@extends('layouts.panel') 

@section('title-nav')
    Detalles de la reserva
@endsection

@section('main-content')

<div class="col-md-4 offset-4 mt-4">
    <div class="card">
        <div class="card-body">
          <a href="{{url('/bookings')}}" class="btn btn-sm btn-danger float-right">
            Regresar
        </a>
          @if ($booking->state == "0" || $booking->state == "1")
          <a href="{{url('/bookings/'.$booking->id.'/edit')}}" class="btn btn-sm btn-warning float-right">
            editar esta reserva
        </a>    
          @endif
          <h2 class="card-title">Detalles de la reserva</h2>
          <h5 class="card-subtitle mt-2">Nombre del cliente</h5>
          <p class="card-text">{{$booking->customerName}}</p>
          
          <h5 class="card-subtitle mt-2">Evento</h5>
          <p class="card-text">{{($booking->idEvent == null) ? 'sin evento' : $booking->eventName}}</p>

          <h5 class="card-subtitle mt-2">cantidad de personas</h5>
          <p class="card-text">{{$booking->amount_people}}</p>

          <h5 class="card-subtitle mt-2">Fecha de inicio</h5>
          <p class="card-text">{{$booking->start_date}}</p>

          <h5 class="card-subtitle mt-2">fecha de la reserva</h5>
          <p class="card-text">{{$booking->final_date}}</p>

          <h5 class="card-subtitle mt-2">Estado</h5>
          @if ($booking->state == 0)
          <p class="card-text">Cancelada <span class="text-danger"><i class="fa-solid fa-x"></i></span></p>
          @endif
          @if ($booking->state == 1)
          <p class="card-text">En proceso <span class="text-warning"><i class="fa-solid fa-clock"></i></span></p>
          @endif
          @if ($booking->state == 2)
          <p class="card-text">Aprobada <span class="text-success"><i class="fa-solid fa-check"></i></span></p>
          @endif
        </div>

        
</div>

@endsection