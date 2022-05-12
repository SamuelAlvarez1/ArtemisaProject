@extends('layouts.forms')

@section('title-nav')
    Crear Rol
@endsection

@section('form')


    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Crear rol</h3>
            </div>
            <div class="col text-right">
                <a href="{{url('roles')}}" class="btn btn-sm btn-outline-danger">
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
        <form action="{{ url('roles') }}" method="post">
            @csrf
            <div>
                <label for="">Nombre<b class="text-danger"> *</b></label>
                <input
                    type="text"
                    class="form-control"
                    name="name"
                    value="{{ old('name') }}"
                />
            </div>
            <div class="mt-2 mb-2">
                <label for="">Descripción<b class="text-danger"> *</b></label>
                <textarea
                    type="text"
                    class="form-control"
                    name="description"
                    resize='none'
                    rows="3"
                >{{ old('description') }}
                </textarea>
            </div>
            <div class="row mx-auto my-3">
                <button type="submit" class="btn btn-outline-success">Crear</button>

            </div>
        </form>
    </div>

@endsection
