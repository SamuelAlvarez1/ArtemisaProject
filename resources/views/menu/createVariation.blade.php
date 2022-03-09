@extends('layouts.panel')

@section('main-content')

    <div class="card">
        <div class="card-header m-auto">
            <strong >Crear variación</strong>
        </div>
        <div class="card-body">

            <form action="/producto/guardar" method="post">
                @csrf
                <div class="row d-flex justify-content-center">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Nombre de la variación</label>
                            <input type="text" class="form-control @error('nombre_variacion') is-invalid @enderror" name="nombre_variacion">
                            @error('nombre_variacion')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Precio adicional</label>
                            <input type="number" class="form-control @error('precio_adicional') is-invalid @enderror" name="precio_adicional">
                            @error('precio_adicional')
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
