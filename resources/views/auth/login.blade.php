@extends('layouts.form')


@section('styles')
    <link rel="stylesheet" href="/css/alertify.min.css"/>
    <link rel="stylesheet" href="/css/themes/bootstrap.css"/>
@endsection

@section('content')
    <h1 class="font-weight-bold mb-5 mt-5 text-center">Iniciar sesión</h1>
    <form class="mb-5" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="inputBox">
            <input type="email" class="form-control bg-dark-x border-0 @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}" id="exampleInputEmail1"
                   aria-describedby="emailHelp" required="required">
            <label for="exampleInputEmail1" class="form-label font-weight-bold">Email</label>
        </div>
        <div class="inputBox mb-3">
            <input type="password" id="password exampleInputPassword1"
                   class="form-control bg-dark-x border-0 mb-2 @error('password') is-invalid @enderror"
                   name="password" autocomplete="current-password"
                   required="required">
            <label for="exampleInputPassword1" class="form-label font-weight-bold">Contraseña</label>
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
@section('scripts')
    <script src="/js/alertify.min.js"></script>
    @error('email')
    <script>
        alertify.set('notifier', 'position', 'top-right');
        alertify.error('{{ $message }}');
    </script>
    @enderror
    @error('password')
    <script>
        alertify.set('notifier', 'position', 'top-right');
        alertify.error('{{ $message }}');
    </script>
    @enderror
    @if(Session::has('error'))
        <script>
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('{{ Session::get('error') }}');
        </script>
    @endif
    @if(Session::has('errorState'))
        <script>
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('{{ Session::get('errorState') }}');
        </script>
    @endif
    
@endsection
