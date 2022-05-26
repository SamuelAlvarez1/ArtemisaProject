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
                    <strong class="text-danger"> *</strong></label>

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
                    >{{ __('Cantidad de personas') }}<strong
                            class="text-danger"> *</strong></label>

                    <input id="amount_people" type="number" class="form-control @error('amount_people') is-invalid @enderror" name="amount_people"
                           value="{{ old('amount_people') }}" required autocomplete="amount_people">
                </div>
                <div class="col">
                    <label for="start_date"
                    >{{ __('Fecha inicial') }}<strong
                            class="text-danger"> *</strong></label>
                    <input id="booking_date" type="datetime-local" class="form-control @error('booking_date') is-invalid @enderror" name="booking_date"
                           value="{{ old('booking_date') }}" required autocomplete="booking_date" onchange="si()">
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

@section('scripts')
    <script>
        function si(e){
            let dates = new Date();

            console.log(dates);
        }


    </script>
@endsection
