@extends('layouts.panel')

@section('main-content')

    <div class="card">
        <div class="card-header m-auto">
            <strong >Crear productos</strong>
        </div>
        <div class="card-body">

            <form action="/producto/guardar" method="post">
                @csrf
                <div class="row d-flex justify-content-center">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Nombre producto</label>
                            <input type="text" class="form-control @error('nombre_producto') is-invalid @enderror" name="nombre_producto">
                            @error('nombre_producto')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Precio base</label>
                            <input type="number" class="form-control @error('precio_base') is-invalid @enderror" name="precio_base">
                            @error('precio_base')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>

                    </div>

                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a type="submit" href="{{url("/menu")}}" class="btn btn-danger">Volver</a>
                </div>


            </form>
        </div>
    </div>
@endsection
