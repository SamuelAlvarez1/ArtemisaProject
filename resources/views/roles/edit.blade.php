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
                <div>
                    <label for="">Nombre<b class="text-danger">*</b></label>
                <input
                    type="text"
                    class="form-control"
                    name="name"
                    value="{{$rol->name}}"
                />
                </div>
                <div class="mt-2 mb-2">
                    <label for="">Descripción<b class="text-danger">*</b></label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" resize = 'none' rows="4">{{$rol->description}}</textarea>
                </textarea>
                </div>
                <button type="submit" class="btn btn-success mt-2">
                    Editar rol
                </button>
            </form>
        </div>
    </div>
</div>

@endsection