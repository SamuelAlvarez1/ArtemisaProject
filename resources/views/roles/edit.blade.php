@extends('layouts.forms')


@section('title-nav')
    Editar rol
@endsection

@section('form')



    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Editar rol</h3>
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
        <form action="{{ url('/roles/' . $rol->id) }}" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{$rol->id}}">
            <div>
                <label for="">Nombre<b class="text-danger"> *</b></label>
                <input
                    type="text"
                    class="form-control"
                    name="name"
                    value="{{$rol->name}}"
                    required
                />
            </div>
            <div class="mt-2 mb-2">
                <label for="">Descripción<b class="text-danger"> *</b></label>
                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" resize='none'
                          rows="4" required>{{$rol->description}}</textarea>
                </textarea>
            </div>
            <div class="row mx-auto mt-4">
                <button type="submit" class="btn btn-outline-success mt-2">
                    Actualizar
                </button>
            </div>

        </form>
    </div>

@endsection
