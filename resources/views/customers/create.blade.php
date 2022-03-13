@extends('layouts.panel')

@section('main-content')


    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Crear cliente</h3>
                </div>
                <div class="col text-right">
                    <a href="{{url('customers')}}" class="btn btn-sm btn-danger">
                        Regresar
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <form action="{{url('customers')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="nameInput">Nombre</label>
                    <input value="{{old('name')}}" type="text" class="form-control" name="name" id="nameInput" placeholder="Cliente">
                </div>
                <div class="form-group">
                    <label for="emailInput">Documento</label>
                    <input value="{{old('document')}}" type="text" class="form-control" name="document" id="documentInput" placeholder="Cliente">
                </div>
                <div class="form-group">
                    <label for="idCardInput">Dirección</label>
                    <input value="{{old('address')}}" type="text" class="form-control" name="address" id="addressInput" placeholder="Cliente">
                </div>
                <div class="form-group">
                    <label for="addressInput">Número de telefono</label>
                    <input value="{{old('phoneNumber')}}" type="text" class="form-control" name="phoneNumber" id="phoneNumberInput" placeholder="Cliente">
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" name="state" checked type="checkbox" value="1" id="state">
                    <label class="form-check-label" for="state">
                        Estado
                    </label>
                </div>
                <button type="submit" class="btn btn-success">Crear</button>
            </form>
        </div>
    </div>
@endsection
