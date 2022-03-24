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
    <div class="card">
        <div class="card-body">
            <div class="card-title text-center">
                <h2>Crear reserva</h2>
            </div>
            <form action="{{url('/bookings/' . $booking->id)}}" method="post">
                @csrf
                @method('PUT')
                <select name="idCustomer" id="idCustomer" class="form-control">
                    <option value="">Seleccione el cliente</option>
                    @foreach ($customers as $customer)
                        <option value="{{$customer->id}}" {{$customer->id == $booking->idCustomer ? 'selected': ''}}>{{$customer->name}}</option>
                    @endforeach
                </select>

                <select name="idEvent" id="idEvent" class="form-control mt-2">
                    <option value="">Seleccione el evento</option>
                    @foreach ($events as $event)
                        <option value="{{$event->id}}" {{$event->id == $booking->idEvent ? 'selected' : ''}}>{{$event->name}}</option>
                    @endforeach
                </select>

                <input
                    type="text"
                    class="form-control mt-2"
                    placeholder="Cantidad de personas"
                    name="amount_people"
                    value="{{$booking->amount_people}}"
                />

                <input type="date" class="form-control mt-2" name="final_date" value="{{$booking->final_date}}">

                <button type="submit" class="btn btn-primary mt-2">
                    Editar reserva
                </button>
            </form>
        </div>
    </div>
</div>

@endsection