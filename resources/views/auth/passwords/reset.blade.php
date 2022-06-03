@extends('layouts.form')

@section('content')

<h1 class="font-weight-bold mb-5 mt-5 text-center">Recupera tu contraseña</h1>
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<p class="mb-5 text-center text-muted">Digita tu nueva contraseña</p>
<form class="mb-5" method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="inputBox">
        <input type="email"
            class="form-control bg-dark-x border-0 @error('email') is-invalid @enderror" name="email"
            id="exampleInputEmail1" aria-describedby="emailHelp" required="required"
            value="{{ $email ?? old('email') }}">
        <label for="exampleInputEmail1" class="form-label font-weight-bold">Email</label>

        @error('email')
        <span class="invalid-feedback"  style="padding-top: 55px !important; font-size: 15px !important;" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="inputBox">
        <input id="exampleInputEmail1" type="password" class="form-control bg-dark-x border-0 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        <label for="exampleInputEmail1" class="form-label font-weight-bold">Contraseña</label>
                                @error('password')
                                    <span class="invalid-feedback" style="padding-top: 55px !important; font-size: 15px !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
    </div>

    <div class="inputBox">
        <input id="exampleInputEmail1" type="password" class="form-control bg-dark-x border-0" name="password_confirmation" required
            autocomplete="new-password">
        <label for="exampleInputEmail1" class="form-label font-weight-bold">Confirmar contraseña</label>
    </div>



    <div class="row">
        <button type="submit" class="btn btn-outline-light flex-grow-1 m-3">Enviar</button>
        <a href="/login" class="btn btn-outline-danger flex-grow-1 m-3 pt-3">Volver</a>
    </div>

</form>
@endsection















