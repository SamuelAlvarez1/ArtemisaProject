@extends('layouts.forms')
@section('form')

    @section('styles')

    @endsection

    @section('title-nav')
        Cambiar contraseña
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
                <h3 class="mb-0">Editar contraseña</h3>
            </div>
            <div class="col text-right">
                <a href="{{url('users/profile/' . auth()->user()->id)}}" class="btn btn-sm btn-outline-danger">
                    Regresar
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">

        <form action="{{url('/users/UpdatePassword/' . $user->id)}}" method="post">
            @csrf

            <div class="row mb-3">
                <label for="old_password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña antigua')
                        }}</label>

                <div class="col-md-6">
                    <input type="password" id="old_password" class="form-control" placeholder="Contraseña"
                           name="old_password" required/>
                </div>
            </div>

            <div class="row mb-3">
                <label for="new_password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña nueva')
                        }}</label>

                <div class="col-md-6">

                    <input type="password" class="form-control mt-2" id="new_password" placeholder="Contraseña nueva"
                           name="new_password" required/>

                </div>
            </div>

            <div class="row mb-3">
                <label for="password_confirmation" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar
                        contraseña') }}</label>

                <div class="col-md-6">

                    <input type="password" id="password_confirmation" class="form-control mt-2"
                           placeholder="Confrimar contraseña" name="password_confirmation" required/>

                </div>
            </div>
            <div class="row mt-5">
                <button type="submit" class="btn btn-outline-success">
                    Editar contraseña
                </button>
            </div>

        </form>
    </div>

@endsection
