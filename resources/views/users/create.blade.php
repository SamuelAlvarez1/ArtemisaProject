@extends('layouts.forms')


@section('title-nav')
    Crear usuario
@endsection


@section('form')


    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Crear usuario</h3>
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
        <form method="POST" action="{{ url('users') }}">
            @csrf

            <div class="row mb-4">
                <div class="col">
                    <label for="name">{{ __('Nombres') }}<b class="text-danger"> *</b></label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                           value="{{ old('name') }}" required autocomplete="name" autofocus>
                </div>
                <div class="col">
                    <label for="last_name">{{ __('Apellidos') }}<b class="text-danger"> *</b></label>
                    <input id="last_name" type="text" class="form-control" name="last_name"
                           value="{{ old('last_name') }}" required autocomplete="last_name">
                </div>
            </div>


            <div class="form-group">
                <label for="email">{{ __('Correo electrónico') }}<b
                        class="text-danger"> *</b></label>

                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autocomplete="email">
            </div>

            <div class="row mb-4">
                <div class="col">
                    <label for="phone">{{ __('Teléfono') }}<b
                            class="text-danger"> *</b></label>
                    <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required
                           autocomplete="phone">
                </div>
                <div class="col">
                    <label for="idRol">{{ __('Rol') }}<b
                            class="text-danger"> *</b></label>
                    <select name="idRol" id="idRol" class="form-control">
                        <option value="">seleccione</option>
                        @foreach ($roles as $rol)
                            <option
                                value="{{$rol->id}}" {{($rol->id == old('idRol') ? 'selected' : '')}}>{{$rol->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="row mb-4">
                <div class="col">
                    <label for="password">{{ __('Contraseña') }}<b
                            class="text-danger"> *</b></label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" required autocomplete="new-password">
                </div>
                <div class="col">
                    <label for="password-confirm">{{ __('Confirmar contraseña') }}<b
                            class="text-danger"> *</b></label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                           required autocomplete="new-password">
                </div>
            </div>


            <div class="row mx-auto">
                <button type="submit" class="btn btn-outline-success">Crear</button>
            </div>
        </form>
    </div>
@endsection
