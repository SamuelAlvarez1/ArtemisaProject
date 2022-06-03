@extends('layouts.forms')

@section('title-nav')
    Crear cliente
@endsection

@section('form')
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Crear cliente</h3>
            </div>
            <div class="col text-right">
                <a href="{{url('customers')}}" class="btn btn-sm btn-outline-danger">
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
            <div class="row mb-4">
                <div class="col">
                    <label for="nameInput">Nombre<b class="text-danger"> *</b></label>
                    <input value="{{old('name')}}" type="text" class="form-control @error('name') is-invalid @enderror"
                           name="name" id="nameInput" required>
                </div>
                <div class="col">
                    <label for="documentInput">Documento<b class="text-danger"> *</b></label>
                    <input value="{{old('document')}}" type="number"
                           class="form-control @error('document') is-invalid @enderror" name="document"
                           id="documentInput" required>
                </div>
            </div>
            <div class="form-group">
                <label for="addressInput">Dirección<b class="text-danger"> *</b></label>
                <input value="{{old('address')}}" type="text"
                       class="form-control @error('address') is-invalid @enderror" name="address" id="addressInput" required>
            </div>
                <div class="form-group">
                    <label for="phoneNumberInput">Número de teléfono<b class="text-danger"> *</b></label>
                    <input value="{{old('phoneNumber')}}" type="text"
                           class="form-control @error('phoneNumber') is-invalid @enderror" name="phoneNumber"
                           id="phoneNumberInput" required>
                </div>
            <button type="submit" class="btn btn-outline-success d-block m-auto">Crear</button>
        </form>
    </div>
@endsection
