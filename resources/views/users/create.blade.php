@extends('layouts.panel')


@section('title-nav')
    Crear usuario
@endsection


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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">Crear usuario</h3>
                                </div>
                                <div class="col text-right">
                                    <a href="{{url('users')}}" class="btn btn-sm btn-danger">
                                        Regresar
                                    </a>
                                </div>
                            </div>
                        </div>

                <div class="card-body">
                    <form method="POST" action="{{ url('users') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombres') }}<b class="text-danger">*</b></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Apellidos') }}<b class="text-danger">*</b></label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">
                                
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo electrónico') }}<b class="text-danger">*</b></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                               
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Teléfono') }}<b class="text-danger">*</b></label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                                
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="idRol" class="col-md-4 col-form-label text-md-end">{{ __('Rol') }}<b class="text-danger">*</b></label>

                            <div class="col-md-6">
                                <select name="idRol" id="idRol" class="form-control">
                                    <option value="">seleccione</option>
                                    @foreach ($roles as $rol)
                                        <option value="{{$rol->id}}" {{($rol->id == old('idRol') ? 'selected' : '')}}>{{$rol->name}}</option>
                                    @endforeach
                                </select>
                                
                            
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}<b class="text-danger">*</b></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar contraseña') }}<b class="text-danger">*</b></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Crear') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
