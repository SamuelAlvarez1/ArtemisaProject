@extends('layouts.panel')

@section('title-nav')
    Editar categoría {{$category->name}}
@endsection

@section('main-content')


    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Editar categoría</h3>
                </div>
                <div class="col text-right">
                    <a href="{{url('categories')}}" class="btn btn-sm btn-danger">
                        Regresar
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <form action="{{url('categories/'.$category->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nameInput">Nombre</label>
                    <input value="{{old('name', $category->name)}}" type="text" class="form-control" name="name"
                           id="nameInput" placeholder="Cliente">
                </div>
                <div class="form-check mb-3">
                    <input type="hidden" name="state" value="0">
                    @if($category->state == true)
                        <input class="form-check-input" name="state" type="checkbox" value="1" id="state" checked>
                    @else
                        <input class="form-check-input" name="state" type="checkbox" value="1" id="state">
                    @endif

                    <label class="form-check-label" for="state">
                        Estado
                    </label>
                </div>
                <button type="submit" class="btn btn-success">Actualizar</button>
            </form>
        </div>
    </div>
@endsection

