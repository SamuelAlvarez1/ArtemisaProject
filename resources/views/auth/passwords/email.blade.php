@extends('layouts.form')

@section('content')

    <h1 class="font-weight-bold mb-5 mt-5 text-center">Restablece tu contraseña</h1>
    <p class="mb-5 text-center text-muted">Digita tu correo electrónico para enviarte un email de restablecimiento para tu contraseña</p>
    <form class="mb-5" method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="inputBox">
            <input type="text" class="form-control bg-dark-x border-0 @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}" id="exampleInputEmail1"
                   aria-describedby="emailHelp" required="required">
            <label for="exampleInputEmail1" class="form-label font-weight-bold">Email</label>

                @error('email')
                <span class="invalid-feedback" style="padding-top: 55px !important; font-size: 15px !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror

        </div>



<div class="row">
    <button type="submit" class="btn btn-outline-light flex-grow-1 m-3">Enviar</button>
    <a href="/login" class="btn btn-outline-danger flex-grow-1 m-3 pt-3">Volver</a>
</div>

    </form>
@endsection
