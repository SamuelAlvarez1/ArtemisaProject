@extends('layouts.forms')

@section('title-nav')
    Crear reserva
@endsection

@section('form')


    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Crear reserva</h3>
            </div>
            <div class="col text-right">
                <a href="{{url('bookings')}}" class="btn btn-sm btn-outline-danger">
                    Regresar
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        @if(count($errors)>0)
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ url('bookings') }}">
            @csrf

            <div class="form-group">
                <label for="idCustomer">{{ __('Cliente') }}
                    <b class="text-danger"> *</b></label>

                <select name="idCustomer" id="idCustomer"
                        class="form-control @error('idCustomer') is-invalid @enderror">
                    <option value="">seleccione el cliente</option>
                    @foreach ($customers as $customer)
                        <option
                            value="{{$customer->id}}" {{($customer->id == old('idCustomer') ? 'selected' : '')}}>{{$customer->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="idEvent">{{ __('Evento') }}</label>
                <select name="idEvent" id="idEvent" class="form-control @error('idEvent') is-invalid @enderror">
                    <option value="">seleccione el evento</option>
                    @foreach ($events as $event)
                        <option
                            value="{{$event->id}}" {{($event->id == old('idEvent') ? 'selected' : '')}}>{{$event->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="row mb-4">
                <div class="col">
                    <label for="amount_people"
                    >{{ __('Cantidad de personas') }}<b
                            class="text-danger"> *</b></label>

                    <input id="amount_people" type="number" class="form-control @error('amount_people') is-invalid @enderror" name="amount_people"
                           value="{{ old('amount_people') }}" required autocomplete="amount_people">
                </div>
                <div class="col">
                    <label for="start_date"
                    >{{ __('Fecha inicial') }}<b
                            class="text-danger"> *</b></label>
                    <input id="booking_date" type="date" class="form-control @error('booking_date') is-invalid @enderror" name="booking_date"
                           value="{{ old('booking_date') }}" required autocomplete="booking_date">
                </div>
            </div>

            <div class="row mb-4">
                <div class="col">
                    <label for="booking_hour"
                    >{{ __('Hora de la reserva') }}<b
                            class="text-danger"> *</b></label>
                    <select name="booking_hour" id="booking_hour" class="form-control @error('booking_hour') is-invalid @enderror">
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
                <div class="col">
                    <label for="booking_minutes"
                    >{{ __('Minutos de la reserva') }}<b
                            class="text-danger"> *</b></label>

                    <input id="booking_minutes" type="number" max="60" min="0" class="form-control @error('booking_minutes') is-invalid @enderror"
                           name="booking_minutes" value="{{ old('booking_minutes') }}" required
                           autocomplete="booking_minutes">
                </div>
            </div>



                <div class="row mx-auto">
                    <button type="submit" class="btn btn-outline-success">
                        {{ __('Crear') }}
                    </button>
            </div>
        </form>
    </div>

@endsection
