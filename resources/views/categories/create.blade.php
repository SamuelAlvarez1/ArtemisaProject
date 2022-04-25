@extends('layouts.panel')

@section('title-nav')
    Crear categoría
@endsection

@section('main-content')

    <div class="col-md-8 offset-2 my-2">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Crear categoría</h3>
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
                <form action="{{url('categories')}}" method="post">
                    @csrf
                    <div class="row mb-4">
                        <div class="col">
                            <label for="nameInput">Nombre de la categoría: <b class="text-danger">*</b></label>
                            <input value="{{old('name')}}" type="text" class="form-control" name="name" id="nameInput" placeholder="Categoría">
                        </div>
                    </div>

                    <div class="form-check mb-3">
                        <input type="hidden" name="state" value="0">
                        <input class="form-check-input" name="state" checked type="checkbox" value="1" id="state">
                        <label class="form-check-label" for="state">
                            Estado
                        </label>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-success">Crear</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection