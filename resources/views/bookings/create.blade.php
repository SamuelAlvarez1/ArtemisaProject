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
                                    <a href="{{url('bookings')}}" class="btn btn-sm btn-danger">
                                        Regresar
                                    </a>
                                </div>
                            </div>
                        </div>

                <div class="card-body">
                    <form method="POST" action="{{ url('bookings') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="idCustomer" class="col-md-4 col-form-label text-md-end">{{ __('Cliente') }}</label>

                            <div class="col-md-6">
                                <select name="idCustomer" id="idCustomer" class="form-control">
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
                                <select name="idEvent" id="idEvent" class="form-control">
                                    <option value="">seleccione el evento</option>
                                    @foreach ($events as $event)
                                        <option value="{{$event->id}}" {{($event->id == old('idEvent') ? 'selected' : '')}}>{{$event->name}}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="amount_people" class="col-md-4 col-form-label text-md-end">{{ __('Cantidad de personas') }}</label>

                            <div class="col-md-6">
                                <input id="amount_people" type="text" class="form-control" name="amount_people" value="{{ old('amount_people') }}" required autocomplete="amount_people">

                               
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="start_date" class="col-md-4 col-form-label text-md-end">{{ __('Fecha inicial') }}</label>

                            <div class="col-md-6">
                                <input id="start_date" type="datetime-local" class="form-control" name="start_date" value="{{ old('start_date') }}" required autocomplete="start_date">
                                
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Crear') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection