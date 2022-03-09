@extends('layouts.panel')

@section('main-content')

    <div class="row">
        <div class="col">
            <h2 class="text-center">Menú</h2>
        </div>
    </div>

    <form action="{{url('menu')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-6">

                <div class="card">
                    <div class="card-head">
                        <h4 class="text-center mb-3 pt-3">Platillo</h4>
                    </div>
                    <div class="row card-body d-flex justify-content-center">
                        <div class="form-group col-6">
                            <label for="">Categoría</label>
                            <select name="categories" class="form-control js-example-basic-single" onchange="colocar_categoria()" id="categories">
                                <option value="">Seleccione</option>
                                @foreach($categories as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Nombre del platillo</label>
                            <input type="text" class="form-control @error('nombre_platillo') is-invalid @enderror" name="nombre_platillo"  id="nombre_platillo">
                            @error('nombre_platillo')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="">Precio base</label>
                            <input type="number" class="form-control @error('precio_base') is-invalid @enderror" name="precio_base"  id="precio_base">
                            @error('precio_base')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4 d-block" style="margin: 5% auto; ">
                        <button type="submit" class="btn btn-outline-dark">Guardar platillo</button>
                    </div>
                </div>
            </div>
            <div class="col-6">

                <div class="card">
                    <div class="card-head">
                        <h4 class="text-center mb-3 pt-3">Variación</h4>
                    </div>
                    <div class="row card-body d-flex justify-content-center">

                        <div class="form-group col-6">
                            <label for="">Nombre de variación</label>
                            <input type="text" class="form-control @error('nombre_variacion') is-invalid @enderror" name="nombre_variacion"  id="nombre_variacion">
                            @error('nombre_variacion')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="form-group col-4">
                            <label>precio adicional</label>
                            <input type="number" class="form-control  @error('precio_adicional') is-invalid @enderror" name="precio_adicional" id="precio_adicional">
                            @error('precio_adicional')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <button type="button" class="btn btn btn-outline-dark float-right" onclick="agregar_variacion()">Agregar</button>
                        </div>
                    </div>

                    <table id="tbl_variaciones" class="table text-center">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Nombre variación</th>
                            <th>precio adicional</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody id="tbl_variaciones">

                        </tbody>
                    </table>

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


        let id = 0;
        function agregar_variacion() {
            let variacion_text = $("#nombre_variacion").val();
            let precio = $("#precio_adicional").val();

            if (precio > 0) {
                id++;
                $("#tbl_variaciones").append(`
            <tr id="tr-${id}">
            <td>${id}</td>
            <td>
            <input type="hidden" name="variation[]" value="${variacion_text}">
                <input type="hidden" name="id[]" value="${id}">
                <input type="hidden" name="precios[]" value="${precio}">
                ${variacion_text}
            </td>
            <td>${precio}</td>
            <td>
            <button type="button" class="btn btn-danger bg-danger" style="width: 35px; height: 35px; display: flex;margin: auto; justify-content: center" onclick="eliminar_variacion(${id}, ${parseInt(precio)})"><i class="fas fa-ban"></i></button>
            </td>
            </tr>
            `);


            } else {

            }

        }


        function eliminar_variacion(id) {
            $("#tr-" + id).remove();

        }

        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>


@endsection
