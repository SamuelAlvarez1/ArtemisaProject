@extends('layouts.panel')

@section('main-content')

    <div class="row">
        <div class="col">
            <h3 class="text-center">Menú</h3>
        </div>
    </div>

    <form action="/menu/store" method="post">
        @csrf
        <div class="row">
            <div class="col-6">

                <div class="card">
                    <div class="card-head">
                        <h4 class="text-center mb-3">Platillo</h4>
                    </div>
                    <div class="row card-body d-flex justify-content-center">
                        <div class="form-group col-6">
                            <label for="">Categoría</label>
                            <select name="categoria" class="form-control" onchange="colocar_categoria()" id="categoria">
                                <option value="">Seleccione</option>
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
                        <button type="submit" class="btn btn-success">Guardar platillo</button>
                    </div>
                </div>
            </div>
            <div class="col-6">

                <div class="card">
                    <div class="card-head">
                        <h4 class="text-center mb-3">2. Info producto</h4>
                    </div>
                    <div class="row card-body d-flex justify-content-center">

                        <div class="form-group col-6">
                            <label for="">Nombre de variación</label>
                            <input type="text" class="form-control @error('nombre_variación') is-invalid @enderror" name="nombre_variación"  id="nombre_variación">
                            @error('nombre_variación')
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
                            <button type="button" class="btn btn-success float-right" onclick="agregar_producto()">Agregar</button>
                        </div>
                    </div>

                    <table id="tbl_productos" class="table text-center">
                        <thead>
                        <tr>
                            <th>Nombre variación</th>
                            <th>precio adicional</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody id="tbl_productos">

                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </form>

@endsection

@section("scripts")
    <script>
        function colocar_precio() {
            let precio = $("#producto option:selected").attr("precio");

            $("#precio").val(precio);
        }

        function colocar_nombre() {
            let nombre = $("#cliente option:selected").attr("nombre");

            $("#nombre_cliente").val(nombre);
        }


        function agregar_producto() {
            let producto_id = $("#producto option:selected").val();
            let producto_text = $("#producto option:selected").text();
            let cantidad = $("#cantidad").val();
            let precio = $("#precio").val();

            if (precio > 0 && cantidad > 0) {


                $("#tbl_productos").append(`
            <tr id="tr-${producto_id}">
            <td>
                <input type="hidden" name="producto_id[]" value="${producto_id}">
                <input type="hidden" name="cantidades[]" value="${cantidad}">
                <input type="hidden" name="precios[]" value="${precio}">
                ${producto_text}
            </td>
            <td>${precio}</td>
            <td>${cantidad}</td>
            <td>${parseInt(cantidad) * parseInt(precio)}</td>
            <td>
            <button type="button" class="btn btn-danger bg-danger" style="width: 35px; height: 35px; display: flex;margin: auto;" onclick="eliminar_producto(${producto_id}, ${parseInt(cantidad) * parseInt(precio)})"><i class="fas fa-ban"></i></button>
            </td>
            </tr>
            `);
                let precio_total = $("#precio_total").val() || 0;
                $("#precio_total").val(parseInt(precio_total) + parseInt(cantidad) * parseInt(precio));

            } else {

            }

        }


        function eliminar_producto(id, subtotal) {
            $("#tr-" + id).remove();
            let precio_total = $("#precio_total").val() || 0;
            $("#precio_total").val(parseInt(precio_total) - subtotal);
        }
    </script>

@endsection
