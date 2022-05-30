@extends('layouts.forms')
@section('form')

@section('styles')

@endsection

@section('title-nav')
    Editar usuario
@endsection



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
    @if(count($errors)>0)
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="@if(auth()->user()->idRol == 1){{url('/users/'. $user->id)}}@else{{url('/users/update/'. $user->id)}}@endif"
        method="post">
        @csrf
        @if (auth()->user()->idRol == 1)
        @method('PUT')
        @endif
        <input type="hidden" name="id" value="{{$user->id}}">

        <div class="row mb-4">
            <div class="col">
                <label for="name">{{ __('Nombres') }}<strong class="text-danger"> *</strong></label>
                <input type="text" class="form-control" placeholder="nombre" name="name" value="{{$user->name}}"/>
            </div>
            <div class="col">
                <label for="name">{{ __('Apellidos') }}<strong class="text-danger"> *</strong></label>
                <input type="text" class="form-control" placeholder="apellidos" name="last_name"
                       value="{{$user->last_name}}"/>
            </div>
        </div>


        <div class="form-group">
            <label for="name">{{ __('Correo electrónico') }}<strong class="text-danger"> *</strong></label><input type="text" class="form-control" placeholder="email" name="email"
                       value="{{$user->email}}"/>
        </div>

        @if (auth()->user()->idRol == 1)
        <div class="row mb-4">
            <div class="col">
                <label for="phone">{{ __('Teléfono') }}<strong class="text-danger"> *</strong></label>
                <input id="phone" type="text" class="form-control" name="phone" value="{{ $user->phone }}" required
                       autocomplete="phone">
            </div>
            <div class="col">
                <label for="idRol">{{ __('Rol') }}<strong class="text-danger"> *</strong></label>
                <select style="width: 100%" name="idRol" id="idRol" class="form-control">
                    <option value="">Seleccione</option>
                    @foreach ($roles as $rol)
                        <option
                            value="{{$rol->id}}" {{($rol->id == $user->idRol ? 'selected' : '')}}>{{$rol->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @else
        <div class="form-group">
            <label for="phone">{{ __('Teléfono') }}<strong class="text-danger"> *</strong></label><input type="text" class="form-control" placeholder="Número de teléfono" name="phone"
                       value="{{$user->phone}}"/>
        </div>
        @endif


        <div class="row mx-auto">
            <button type="submit" class="btn btn-outline-success mt-4">Actualizar
            </button>
        </div>

    </form>
</div>

@endsection
