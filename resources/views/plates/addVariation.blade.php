@extends('layouts.panel')
@section('main-content')

<div class="card">
    <form action="{{url('plates/'.$plate->id)}}" method="post">
        <div class="card-body">
            <div class="card-title text-center">
                <h2>Editar platillo</h2>
            </div>

            @csrf
            @method('PUT')
            <div class="d-flex">
                <input type="hidden" name="id" value="{{$plate->id}}">
                <input type="hidden" name="state" value="{{$plate->state}}">
                <input type="text" class="form-control m-3" placeholder="Nombre platillo" name="name"
                       value="{{$plate->name}}"/>

                <input type="number" class="form-control m-3" placeholder="Precio base" name="basePrice"
                       value="{{$plate->basePrice}}"/>
                <select name="idCategory" id="idCategory" class="form-control m-3">
                    <option value="">Seleccione la categoría</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <a href=""></a>
        </div>
    </form></div>

@endsection
