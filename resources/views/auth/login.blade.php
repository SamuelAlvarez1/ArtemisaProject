@extends('layouts.form')

@section('content')
                <h1 class="font-weight-bold mb-5 mt-5 text-center">Iniciar sesión</h1>
                <form class="mb-5" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="inputBox">
                        <input type="text" class="form-control bg-dark-x border-0 @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" id="exampleInputEmail1"
                               aria-describedby="emailHelp" required="required">
                        <label for="exampleInputEmail1" class="form-label font-weight-bold">Email</label>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="inputBox mb-3">

                        <input type="password" id="password exampleInputPassword1"
                               class="form-control bg-dark-x border-0 mb-2 @error('password') is-invalid @enderror"
                               name="password" autocomplete="current-password"
                               required="required">
                        <label for="exampleInputPassword1" class="form-label font-weight-bold">Contraseña</label>

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="col-md-6 offset-md-4 mb-3" style="display: initial;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember"
                                   id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label text-muted" for="remember">
                                {{ __('Recuerdame') }}
                            </label>
                        </div>
                    </div>
                    @if (Route::has('password.request'))
                        <a id="emailHelp" class="form-text text-muted text-decoration-none mb-4 text-center"
                           href="{{ route('password.request') }}">
                            ¿Has
                            olvidado tu
                            contraseña?
                        </a>
                    @endif
                    <button type="submit" class="btn btn-outline-light flex-grow-1 w-100">Iniciar sesión</button>
                </form>


@endsection

