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
            <form action="insertar" method="post">
                @csrf

                <select name="idCliente" id="idCliente" class="form-control">
                    <option value="0">Seleccione el cliente</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{$cliente->id}}">{{$cliente->nombres}}</option>
                    @endforeach
                </select>

                <select name="idEvento" id="idEvento" class="form-control mt-2">
                    <option value="">Seleccione el evento</option>
                    @foreach ($eventos as $evento)
                        <option value="{{$evento->id}}">{{$evento->nombre}}</option>
                    @endforeach
                </select>

                <input
                    type="text"
                    class="form-control mt-2"
                    placeholder="Cantidad de personas"
                    name="cantidad_personas"
                    value="{{ old('cantidad_personas') }}"
                />

                <input type="date" class="form-control mt-2" name="fecha_fin">

                <button type="submit" class="btn btn-primary mt-2">
                    Crear reserva
                </button>
            </form>
        </div>
    </div>
</div>

@endsection