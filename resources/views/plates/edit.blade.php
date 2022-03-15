@extends('layouts.panel')
@section('main-content')

    <div class="card">
        <div class="card-body">
            <div class="card-title text-center">
                <h2>Editar platillo</h2>
            </div>
            <form action="/plates/update/{{$plate->id}}" method="post">
                @csrf
                <div class="d-flex">
                    <input type="hidden" name="id" value="{{$plate->id}}">
                    <input type="text" class="form-control m-3" placeholder="Nombre platillo" name="name"
                           value="{{$plate->name}}"/>

                    <input type="text" class="form-control m-3" placeholder="Precio base" name="basePrice"
                           value="{{$plate->basePrice}}"/>
                    <select name="idCategory" id="idCategory" class="form-control m-3">
                        <option value="">Seleccione la categoría</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

            </form>
        </div>
        <div class="table-responsive text-center w-80 m-auto">
            <table id="variations" class="table table-bordered">
                <thead class="text-dark">
                <tr>
                    <th>Id</th>
                    <th>Variación</th>
                    <th>Precio adicional</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>

                @foreach($variations as $variation)

                    <tr>

                        <td class="text-dark">{{$variation-> id}}</td>
                        <td>{{$variation->variation}}</td>
                        <td>{{$variation-> price}}</td>
                        <td>{{$variation-> description}}</td>
                        <td><a class="mx-2" href=""><i class="fa-solid fa-trash text-dark"></i></a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <div class="row mt-4">
            <button type="submit" class="btn btn-outline-dark mb-4">
                editar usuario
            </button>
            <a href="{{url('plates')}}" class="btn btn-outline-danger mb-4">
                Volver
            </a>
        </div>
    </div>

@endsection
