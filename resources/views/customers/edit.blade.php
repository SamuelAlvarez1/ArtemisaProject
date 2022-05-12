@extends('layouts.panel')

@section('title-nav')
    Editar cliente {{$customer->name}}
@endsection

@section('main-content')

    <div class="col-md-8 offset-2 my-2">
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Editar información</h3>
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
            <form action="{{url('customers/'.$customer->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nameInput">Nombre</label>
                    <input value="{{old('name', $customer->name)}}" type="text" class="form-control" name="name"
                           id="nameInput" placeholder="Cliente">
                </div>
                <div class="form-group">
                    <label for="emailInput">Documento</label>
                    <input value="{{old('document', $customer->document)}}" type="text" class="form-control"
                           name="document" id="documentInput" placeholder="Cliente">
                </div>
                <div class="form-group">
                    <label for="idCardInput">Dirección</label>
                    <input value="{{old('address', $customer->address)}}" type="text" class="form-control"
                           name="address" id="addressInput" placeholder="Cliente">
                </div>
                <div class="form-group">
                    <label for="addressInput">Número de telefono</label>
                    <input value="{{old('phoneNumber', $customer->phoneNumber)}}" type="text" class="form-control"
                           name="phoneNumber" id="phoneNumberInput" placeholder="Cliente">
                </div>
                <div class="form-check mb-3">
                    <input type="hidden" name="state" value="0">
                    @if($customer->state == true)
                        <input class="form-check-input" name="state" type="checkbox" value="1" id="state" checked>
                    @else
                        <input class="form-check-input" name="state" type="checkbox" value="1" id="state">
                    @endif

                    <label class="form-check-label" for="state">
                        Estado
                    </label>
                </div>
                <div class="row mx-auto">
                    <button type="submit" class="btn btn-outline-success">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

