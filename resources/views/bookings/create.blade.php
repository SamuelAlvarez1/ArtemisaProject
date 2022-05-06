@extends('layouts.panel')

@section('title-nav')
    Crear reserva
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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">Crear reserva</h3>
                                </div>
                                <div class="col text-right">
                                    <a href="{{url('bookings')}}" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Regresar a la lista de reservas">
                                        Regresar
                                    </a>
                                </div>
                            </div>
                        </div>

                <div class="card-body">
                    <form method="POST" action="{{ url('bookings') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="idCustomer" class="col-md-4 col-form-label text-md-end">{{ __('Cliente') }}<b class="text-danger">*</b></label>

                            <div class="col-md-6">
                                <select name="idCustomer" id="idCustomer" class="form-control" data-toggle="tooltip" data-placement="right" title="Seleccionar el cliente">
                                    <option value="">seleccione el cliente</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{$customer->id}}" {{($customer->id == old('idCustomer') ? 'selected' : '')}}>{{$customer->name}}</option>
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
                                        <option value="{{$event->id}}" {{($event->id == old('idEvent') ? 'selected' : '')}}>{{$event->name}}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="amount_people" class="col-md-4 col-form-label text-md-end">{{ __('Cantidad de personas') }}<b class="text-danger">*</b></label>

                            <div class="col-md-6">
                                <input id="amount_people" type="text" class="form-control" name="amount_people" value="{{ old('amount_people') }}" required autocomplete="amount_people" data-toggle="tooltip" data-placement="right" title="Digite la cantidad de personas">

                               
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="start_date" class="col-md-4 col-form-label text-md-end">{{ __('Fecha inicial') }}<b class="text-danger">*</b></label>

                            <div class="col-md-6">
                                <input id="booking_date" type="date" class="form-control" name="booking_date" value="{{ old('booking_date') }}" required autocomplete="booking_date" data-toggle="tooltip" data-placement="right" title="Fecha dia/mes/año de la reserva">
                            </div>
                        </div>    
                        <div class="row mb-3">
                            <label for="booking_hour" class="col-md-4 col-form-label text-md-end">{{ __('Hora de la reserva') }}<b class="text-danger">*</b></label>
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
                            <label for="booking_minutes" class="col-md-4 col-form-label text-md-end">{{ __('Minutos de la reserva') }}<b class="text-danger">*</b></label>
                            <div class="col-md-6">
                                
                                <input id="booking_minutes" type="text" class="form-control" name="booking_minutes" value="{{ old('booking_minutes') }}" required autocomplete="booking_minutes" data-toggle="tooltip" data-placement="right" title="Minutos solicitados de la reserva">
                                
                            </div>
                        </div>    
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">Crear</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection