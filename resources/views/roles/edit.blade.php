@extends('layouts.panel') 


@section('title-nav')
    Editar rol
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

<div class="col-md-6 offset-3 mt-4">
        <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Editar rol</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{url('roles')}}" class="btn btn-sm btn-danger">
                                Regresar
                            </a>
                        </div>
                    </div>
                </div>
        <div class="card-body">
            <form action="{{ url('/roles/' . $rol->id) }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$rol->id}}">
                <input
                    type="text"
                    class="form-control"
                    placeholder="nombre"
                    name="name"
                    value="{{$rol->name}}"
                />

                <input
                type="text"
                class="form-control mt-2"
                placeholder="descripcion"
                name="description"
                value="{{$rol->description}}"
            />
                <button type="submit" class="btn btn-primary mt-2">
                    editar rol
                </button>
            </form>
        </div>
    </div>
</div>

@endsection