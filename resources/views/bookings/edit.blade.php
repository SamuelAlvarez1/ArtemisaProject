@extends('layouts.panel') 


@section('title-nav')
    Editar reserva
@endsection

@section('main-content')

@if(count($errors)>0)
  <div class="alert alert-danger" role="alert">
    <ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>
  </div>
@endif

<div class="col-md-6 offset-3 mt-4">
        <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">editar reserva</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{url('bookings')}}" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Regresar a la lista de reservas">
                                Regresar
                            </a>
                        </div>
                    </div>
                </div>
        <div class="card-body">
            
            <form action="{{url('/bookings/' . $booking->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label for="idCustomer" class="col-md-4 col-form-label text-md-end">{{ __('Cliente') }}</label>

                    <div class="col-md-6">
                        <select name="idCustomer" id="idCustomer" class="form-control" data-toggle="tooltip" data-placement="right" title="Seleccionar el cliente">
                            <option value="">seleccione el cliente</option>
                            @foreach ($customers as $customer)
                                <option value="{{$customer->id}}" {{($customer->id == $booking->idCustomer ? 'selected' : '')}}>{{$customer->name}}</option>
                            @endforeach
                        </select>

                        
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="idEvent" class="col-md-4 col-form-label text-md-end">{{ __('Evento') }}</label>

                    <div class="col-md-6">
                        <select name="idEvent" id="idEvent" class="form-control" data-toggle="tooltip" data-placement="right" title="Seleccione el evento">
                            <option value="">seleccione el evento</option>
                            @foreach ($events as $event)
                                <option value="{{$event->id}}" {{($event->id == $booking->idEvent ? 'selected' : '')}}>{{$event->name}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="amount_people" class="col-md-4 col-form-label text-md-end">{{ __('Cantidad de personas') }}</label>

                    <div class="col-md-6">
                        <input id="amount_people" type="text" class="form-control" name="amount_people" value="{{ $booking->amount_people }}" required autocomplete="amount_people" data-toggle="tooltip" data-placement="right" title="Digite la cantidad de personas">

                       
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="booking_date" class="col-md-4 col-form-label text-md-end">{{ __('Fecha inicial') }}</label>
                    
                    <div class="col-md-6">
                        <input id="booking_date" type="date" class="form-control" name="booking_date" value="" required autocomplete="booking_date" data-toggle="tooltip" data-placement="right" title="Fecha dia/mes/año de la reserva">
                    </div>
                </div>    
                <div class="row mb-3">
                    <label for="booking_hour" class="col-md-4 col-form-label text-md-end">{{ __('Hora de la reserva') }}</label>
                    <div class="col-md-6">
                        
                        <select name="booking_hour" id="booking_hour" class="form-control" data-toggle="tooltip" data-placement="right" title="Hora solicitada para la reserva">
                            <option value="1">1 AM</option>
                            <option value="2">2 AM</option>
                            <option value="3">3 AM</option>
                            <option value="4">4 AM</option>
                            <option value="5">5 AM</option>
                            <option value="6">6 AM</option>
                            <option value="7">7 AM</option>
                            <option value="8">8 AM</option>
                            <option value="9">9 AM</option>
                            <option value="10">10 AM</option>
                            <option value="11">11 AM</option>
                            <option value="00">12 AM</option>
                            <option value="13">1 PM</option>
                            <option value="14">2 PM</option>
                            <option value="15">3 PM</option>
                            <option value="16">4 PM</option>
                            <option value="17">5 PM</option>
                            <option value="18">6 PM</option>
                            <option value="19">7 PM</option>
                            <option value="20">8 PM</option>
                            <option value="21">9 PM</option>
                            <option value="22">10 PM</option>
                            <option value="23">11 PM</option>
                            <option value="12">12 PM</option>
                        </select>
                        
                        
                    </div>
                </div>    
                <div class="row mb-3">
                    <label for="booking_minutes" class="col-md-4 col-form-label text-md-end">{{ __('Minutos de la reserva') }}</label>
                    <div class="col-md-6">
                        
                        <input id="booking_minutes" type="text" class="form-control" name="booking_minutes" value="{{ old('booking_minutes') }}" required autocomplete="booking_minutes" data-toggle="tooltip" data-placement="right" title="Minutos solicitados de la reserva">
                        
                    </div>
                </div>    

                <button type="submit" class="btn btn-primary mt-2">
                    Editar reserva
                </button>
            </form>
        </div>
    </div>
</div>

@endsection