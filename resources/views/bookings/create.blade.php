@extends('layouts.panel')
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

            <form action="{{ url('bookings') }}" method="post">
                @csrf

                <select name="idCustomer" id="idCustomer" class="form-control">
                    <option value="">Seleccione el cliente</option>
                    @foreach ($customers as $customer)
                    <option value="{{$customer->id}}" {{($customer->id == old('idCustomer')) ? 'selected' : ''}} >{{$customer->name}}</option>
                    @endforeach
                </select>

                <select name="idEvent" id="idEvent" class="form-control mt-2">
                    <option value="">Seleccione el evento</option>
                    @foreach ($events as $event)
                    <option value="{{$event->id}}" {{($event->id == old('idEvent')) ? 'selected' : ''}}>{{$event->name}}</option>
                    @endforeach
                </select>

                <input type="text" class="form-control mt-2" placeholder="Cantidad de personas" name="amount_people"
                    value="{{ old('amount_people') }}" />

                <input type="date" class="form-control mt-2" name="final_date" value="{{ old('final_date') }}">

                <button type="submit" class="btn btn-primary mt-2">
                    Crear reserva
                </button>
            </form>
        </div>
    </div>
</div>

@endsection