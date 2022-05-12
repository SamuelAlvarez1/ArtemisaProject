@extends('layouts.forms')
@section('form')

@section('styles')

@endsection

@section('title-nav')
    Editar usuario
@endsection

@if(count($errors)>0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card-header border-0">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="mb-0">Editar usuario</h3>
        </div>
        <div class="col text-right">
            <a href="{{url('users')}}" class="btn btn-sm btn-outline-danger">
                Regresar
            </a>
        </div>
    </div>
</div>
<div class="card-body">

    <form action="{{url('/users/' . $user->id)}}" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{$user->id}}">

        <div class="row mb-4">
            <div class="col">
                <label for="name">{{ __('Nombres') }}<b
                        class="text-danger"> *</b></label>
                <input type="text" class="form-control" placeholder="nombre" name="name" value="{{$user->name}}"/>
            </div>
            <div class="col">
                <label for="name">{{ __('Apellidos') }}<b
                        class="text-danger"> *</b></label>
                <input type="text" class="form-control" placeholder="apellidos" name="last_name"
                       value="{{$user->last_name}}"/>
            </div>
        </div>


        <div class="form-group">
            <label for="name">{{ __('Correo electrónico') }}<b class="text-danger"> *</b></label>
                <input type="text" class="form-control" placeholder="email" name="email"
                       value="{{$user->email}}"/>
        </div>

        <div class="form-group">
            <label for="name">{{ __('Celular') }}<b class="text-danger"> *</b></label>
                <input type="text" class="form-control mt-2" placeholder="telefono" name="phone"
                       value="{{$user->phone}}"/>
        </div>
        <div class="row mx-auto">
            <button type="submit" class="btn btn-outline-success mt-4">
               Actualizar
            </button>
        </div>

    </form>
</div>

@endsection
