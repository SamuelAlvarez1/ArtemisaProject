@extends('layouts.panel') 

@section('title-nav')
    Crear Rol
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
                            <h3 class="mb-0">Crear rol</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{url('roles')}}" class="btn btn-sm btn-danger">
                                Regresar
                            </a>
                        </div>
                    </div>
                </div>
        <div class="card-body">
            <form action="{{ url('roles') }}" method="post">
                @csrf
                <div>
                    <label for="">Nombre<b class="text-danger">*</b></label>
                    <input
                    type="text"
                    class="form-control"
                    name="name"
                    value="{{ old('name') }}"
                    />
                </div>
                <div class="mt-2 mb-2">
                    <label for="">Descripción<b class="text-danger">*</b></label>
                <textarea
                    type="text"
                    class="form-control"
                    name="description"
                    resize = 'none'
                    rows="3"
                >{{ old('description') }}
                </textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-2">
                    Crear rol
                </button>
            </form>
        </div>
    </div>
</div>

@endsection