@extends('layouts.panel') 
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

<div class="col-md-6 offset-3 mt-4">
    <div class="card">
        <div class="card-body">
            <div class="card-title text-center">
                <h2>Crear rol</h2>
            </div>
            <form action="{{ url('roles') }}" method="post">
                @csrf

                <input
                    type="text"
                    class="form-control"
                    placeholder="Nombre"
                    name="name"
                    value="{{ old('name') }}"
                />

                <input
                    type="text"
                    class="form-control mt-2"
                    placeholder="descripcion"
                    name="description"
                    value="{{ old('description') }}"
                />

                <button type="submit" class="btn btn-primary mt-2">
                    Crear rol
                </button>
            </form>
        </div>
    </div>
</div>

@endsection