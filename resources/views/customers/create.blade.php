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
                    <input value="{{old('name')}}" type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="nameInput">
                </div>
                <div class="col">
                    <label for="emailInput">Documento<b class="text-danger"> *</b></label>
                    <input value="{{old('document')}}" type="text" class="form-control @error('document') is-invalid @enderror" name="document"
                           id="documentInput">
                </div>
            </div>
            <div class="form-group">
                <label for="idCardInput">Dirección<b class="text-danger"> *</b></label>
                <input value="{{old('address')}}" type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="addressInput">
            </div>
            <div class="form-group">
                <label for="addressInput">Número de telefono<b class="text-danger"> *</b></label>
                <input value="{{old('phoneNumber')}}" type="text" class="form-control @error('phoneNumber') is-invalid @enderror" name="phoneNumber"
                       id="phoneNumberInput">
            </div>
            <div class="form-check mb-3">
                <input type="hidden" name="state" value="0">
                <input class="form-check-input" name="state" checked type="checkbox" value="1" id="state">
                <label class="form-check-label" for="state">
                    Estado
                </label>
            </div>
            <button type="submit" class="btn btn-outline-success d-block m-auto">Crear</button>
        </form>
    </div>
@endsection
