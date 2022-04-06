

@extends('layouts.panel')

@section('main-content')

    <div class="row">
        <div class="col">
            <h2 class="text-center">Editar</h2>
        </div>
    </div>

    <form action="{{url('plates/'.$plate->id)}}" method="post">
            @csrf
            @method('PUT')
        <div class="row">

            <div class="col-10">

                <div class="card pb-3">
                    <div class="card-head">
                        <br>
                    </div>
                    <div class="row card-body d-flex justify-content-center">
                        <div class="form-group col-4">
                            <label for="">Categoría</label>
                            <select name="categories" class="form-control" id="categories">
                                <option value="">Seleccione</option>
                                @foreach($categories as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label for="">Nombre del platillo</label>
                            <input type="text" class="form-control @error('plate') is-invalid @enderror"
                                   name="plate" id="plate">
                            @error('plate')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="form-group col-3">
                            <label for="">Precio base</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror"
                                   name="price" id="price">
                            @error('price')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4 d-flex justify-content-center" style="margin: auto; ">

                        <button type="submit" class="btn btn-outline-dark float-right">Guardar platillo/s</button>
                        <a href="{{url('plates')}}" class="btn btn-outline-danger">
                            Volver
                        </a>
                    </div>


                </div>


            </div>
        </div>
    </form>

@endsection

@section("scripts")
    <script>
        function colocar_categories() {
            let categories = $("#categoria option:selected").attr("categories");

            $("#categoria").val(categories);
        }


        let id = document.querySelectorAll(".trAction").length;

        function agregar_variacion() {
            let variacion_text = $("#nombre_variacion").val();
            let description = $("#description").val();
            let description_text = description.substring(0,20);
            let precio = $("#precio_adicional").val();

            if (precio > 0) {
                id++;
                $("#tbl_variaciones").append(`
            <tr id="tr-${id}">
            <td>
            <input type="hidden" name="variation[]" value="${variacion_text}">
                <input type="hidden" name="id[]" value="${id}">
                <input type="hidden" name="precios[]" value="${precio}">
                <input type="hidden" name="description[]" value="${description}">
                ${variacion_text}
            </td>
            <td>${precio}</td>
            <td>${description_text}</td>
            <td>
            <button type="button" class="btn btn-danger bg-danger" style="width: 35px; height: 35px; display: flex;margin: auto; justify-content: center" onclick="eliminar_variacion(${id}, ${parseInt(precio)})"><i class="fas fa-ban"></i></button>
            </td>
            </tr>
            `);


            }

        }


        function eliminar_variacion(id) {
            $("#tr-" + id).remove();

        }

    </script>


@endsection
