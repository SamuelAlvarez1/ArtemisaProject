@extends('layouts.panel')

@section('styles')
<link rel="stylesheet" href="/css/alertify.min.css" />
<link rel="stylesheet" href="/css/themes/bootstrap.css" />

@endsection

@section('title-nav')
    Crear venta
@endsection

@section('main-content')

<div class="row">
    <div class="col">
        <h3 class="text-center">Crear Venta</h3>
    </div>
</div>

<form action="{{ url('sales') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-6">

            <div class="card">
                <div class="card-head">
                    <h4 class="text-center mb-3">Información Venta</h4>
                </div>
                <div class="row card-body d-flex justify-content-center">
                    <div class="form-group col-6">
                        <label for="customer">Cliente</label>
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
                    <button type="submit" class="btn btn-outline-dark">Guardar venta</button>
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
                        <label for="plates">Platillo</label>
                        <select name="plates" id="plates" class="form-control" onchange="assign_price()">
                            <option value="">Seleccione</option>
                            @foreach($plates as $value)
                            @if($value->state == 1)
                            <option value="{{$value->id}}">{{$value->name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-2">
                        <label>Cantidad</label>
                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" id="quantity" style="width:4.5rem;margin-right:15px">
                        @error('quantity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <label>Precio</label>
                        <input type="number" class="form-control @error('platePrice') is-invalid @enderror" name="platePrice" readonly value="0" id="platePrice">
                        @error('platePrice')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-4 d-flex justify-content-center" style="margin: 5% auto;">
                        <button type="button" class="btn btn-outline-dark" onclick="add_plate()">Agregar</button>
                    </div>
                </div>

                <table id="table_plates"  class="table text-center table-responsive">
                    <thead>
                        <tr>
                            <th>Nombre platillo</th>
                            <th>Precio platillo</th>
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
<script src="/js/alertify.min.js"></script>

<script>



    function assign_price() {
        let plateId = $("#plates option:selected").val();
        
       
        $.ajax({
            url : `/plates/getPricePlate/${plateId}`,
            type : 'GET',
            success : function(res){
                $("#platePrice").val(res.price);
                
            }
        })
    }

    function add_plate() {
        let validate = validatePlate()
        
        if(!validate){
                let idPlatillo = $("#plates option:selected").val();
                let platillo_text = $("#plates option:selected").text();
                let cantidad = $("#quantity").val();
                let precio = $("#platePrice").val();
                $("#tbl_plates").append(`
                <tr id="tr-${idPlatillo}" class="trPlatillos">
                <td>
                    <input type="hidden" name="idPlatillo[]" value="${idPlatillo}" class="idPlates">
                    <input type="hidden" name="cantidades[]" value="${cantidad}" class="cantidades">
                    <input type="hidden" name="precios[]" value="${precio}" class="precios">
                    ${platillo_text}
                </td>
                <td>${precio}</td>
                <td class="cantidades-text">${cantidad}</td>
                <td class="subtotales">${parseInt(cantidad) * parseInt(precio)}</td>
                <td>
                <button type="button" class="btn btn-danger bg-danger" style="width: 35px; height: 35px; display: flex;justify-content:center" onclick="delete_plate(${idPlatillo})"><i class="fas fa-ban"></i></button>
                </td>
                </tr>
                `);
                let precio_total = $("#totalPrice").val() || 0;
                $("#totalPrice").val(parseInt(precio_total) + parseInt(cantidad) * parseInt(precio));
        }
        
    }


    function delete_plate(id) {

        let cantidad = $("#tr-" + id).find('input.cantidades').val();
        let precioPlatillo = $("#tr-" + id).find('input.precios').val();
        

        
        $("#tr-" + id).remove();
        let precio_total = $("#totalPrice").val() || 0;
        $("#totalPrice").val(parseInt(precio_total) - parseInt(cantidad * precioPlatillo));
    }


    function validatePlate(){

        let validation = false;

        if ($('table#table_plates tbody tr').length > 0){
            
            $('table#table_plates tbody tr').each(function(){
                if ($(this).find('input.idPlates').val() == $("#plates option:selected").val()){
                    validation = true;
                    $(this).find('input.cantidades').val(parseInt($(this).find('input.cantidades').val()) + parseInt($("#quantity").val()))

                    
                    let subtotal = parseInt($("#quantity").val() * parseInt($("#platePrice").val()));
                    let precio_total = $("#totalPrice").val() || 0;
                    
                    $("#totalPrice").val(parseInt(precio_total) + parseInt(subtotal));

                    $(this).find('td.subtotales').text(parseInt($(this).find('td.subtotales').text()) + parseInt(parseInt($("#quantity").val()) * parseInt($("#platePrice").val())))
                    $(this).find('td.cantidades-text').text(parseInt($(this).find('td.cantidades-text').text()) + parseInt($("#quantity").val()));
                }
            });
        }    

        return validation;
        
    }
</script>

@endsection
