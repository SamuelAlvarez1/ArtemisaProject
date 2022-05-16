@extends('layouts.forms')


@section('title-nav')
    Editar reserva
@endsection

@section('form')
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Editar reserva</h3>
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
        <form action="{{url('/bookings/' . $booking->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="idCustomer">{{ __('Cliente') }}<b class="text-danger"> *</b></label>
                <select name="idCustomer" id="idCustomer" class="form-control">
                    <option value="">seleccione el cliente</option>
                    @foreach ($customers as $customer)
                        <option
                            value="{{$customer->id}}" {{($customer->id == $booking->idCustomer ? 'selected' : '')}}>{{$customer->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="idEvent">{{ __('Evento') }}</label>

                <select name="idEvent" id="idEvent" class="form-control @error('idEvent') is-invalid @enderror">
                    <option value="">seleccione el evento</option>
                    @foreach ($events as $event)
                        <option
                            value="{{$event->id}}" {{($event->id == $booking->idEvent ? 'selected' : '')}}>{{$event->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="row mb-4">
                <div class="col">
                    <label for="amount_people">{{ __('Cantidad de personas') }}<b class="text-danger"> *</b></label>
                    <input id="amount_people" type="text"
                           class="form-control @error('amount_people') is-invalid @enderror " name="amount_people"
                           value="{{ $booking->amount_people }}" required autocomplete="amount_people">
                </div>
                <div class="col">
                    <label for="booking_date">{{ __('Fecha inicial') }}<b class="text-danger"> *</b></label>
                    <input id="booking_date" type="datetime-local"
                           class="form-control @error('booking_date') is-invalid @enderror" name="booking_date"
                           value="{{$booking->start_date->format("Y-m-d\TH:i")}}"

                           required autocomplete="booking_date">
                </div>
                
            </div>
    </div>


    <div class="row mx-auto mt-4">
            <button type="submit" class="btn btn-outline-success">
                Actualizar
            </button>
    </div>
    </form>
    </div>


@endsection
