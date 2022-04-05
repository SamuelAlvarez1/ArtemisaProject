@extends('layouts.panel')

@section('styles')


@endsection

@section('main-content')

<div class="row">
    <div class="col">
        <h3 class="text-center">Crear Venta</h3>
    </div>
</div>

<form action="/sales/store" method="post">
    @csrf
    <div class="row">
        <div class="col-6">

            <div class="card">
                <div class="card-head">
                    <h4 class="text-center mb-3">Información Venta</h4>
                </div>
                <div class="row card-body d-flex justify-content-center">
                    <div class="form-group col-6">
                        <label for="">Cliente</label>
                        <select name="customer" class="form-control" id="customer">
                            <option value="">Seleccione</option>
                            @foreach($customers as $value)
                            @if($value->state == 1)
                            <option name="{{$value->name}}" value="{{$value->id}}">{{$value->name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="">Precio Final</label>
                        <input type="number" class="form-control @error('totalPrice') is-invalid @enderror" name="totalPrice" readonly value="0" id="totalPrice">
                        @error('totalPrice')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-4 d-flex justify-content-center" style="margin: 5% auto;">
                    <button type="submit" class="btn btn-outline-dark">Guardar platillo</button>
                    <a href="{{url('sales')}}" class="btn btn-outline-danger">
                        Volver
                    </a>
                </div>
            </div>
        </div>
        <div class="col-6">

            <div class="card">
                <div class="card-head">
                    <h4 class="text-center mb-3">Información Platillos</h4>
                </div>
                <div class="row card-body d-flex justify-content-center">

                    <div class="form-group col-6">
                        <label>Platillo</label>
                        <select name="producto" id="producto" class="form-control">
                            <option value="">Seleccione</option>
                            @foreach($plates as $value)
                            @if($value->state == 1)
                            <option precio="{{$value->basePrice}}" value="{{$value->id}}">{{$value->name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-2">
                        <label>Cantidad</label>
                        <input type="number" class="form-control  @error('quantity') is-invalid @enderror" name="quantity" id="quantity">
                        @error('quantity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <label>platePrice</label>
                        <input type="number" class="form-control @error('platePrice') is-invalid @enderror" name="platePrice" readonly value="0" id="platePrice">
                        @error('platePrice')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-4 d-flex justify-content-center" style="margin: 5% auto;">
                        <button type="button" class="btn btn-outline-dark" onclick="agregar_producto()">Agregar</button>
                    </div>
                </div>

                <table id="tbl_plates" class="table text-center">
                    <thead>
                        <tr>
                            <th>Nombre platillo</th>
                            <th>precio platillo</th>
                            <th>cantidad</th>
                            <th>Sub total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tbl_plates">

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

    function agregar_producto() {
        let producto_id = $("#producto option:selected").val();
        let producto_text = $("#producto option:selected").text();
        let cantidad = $("#cantidad").val();
        let precio = $("#precio").val();

        if (precio > 0 && cantidad > 0) {


            $("#tbl_plates").append(`
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