@extends('layouts.panel') @section('styles')
<link rel="stylesheet" href="/css/alertify.min.css" />
<link rel="stylesheet" href="/css/themes/bootstrap.css" />

@endsection @section('title-nav') Crear venta @endsection
@section('main-content') @if(count($errors)>0)
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ url('sales') }}" method="post">
    @csrf

    <div class="card w-80 py-3">
        <div class="row">
            <div class="col-5" style="border-right: 1px solid #ebebeb">
                <div class="row card-body d-flex justify-content-start py-4">
                    <div class="form-group col-10">
                        <label for="customer">Cliente</label>
                        <select
                            name="idCustomers"
                            class="form-control"
                            id="customer"
                        >
                            <option value="">Seleccione</option>
                            @foreach($customers as $value) @if($value->state ==
                            1)
                            <option
                                name="{{$value->name}}"
                                value="{{$value->id}}"
                            >
                                {{$value->name}}
                            </option>
                            @endif @endforeach
                        </select>
                    </div>
                    <a
                        href="{{ url('/customers/create') }}"
                        class="btn btn-outline-success btn-sm my-auto mx-2 h-80"
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Cear cliente"
                        ><i class="fa-solid fa-plus"></i
                    ></a>

                    <div class="form-group col-12">
                        <label for="plates">Platillo</label>
                        <select
                            name="plates"
                            id="plates"
                            class="form-control"
                            onchange="assign_price()"
                        >
                            <option value="">Seleccione</option>
                            @foreach($plates as $value) @if($value->state == 1)
                            <option value="{{$value->id}}">
                                {{$value->name}}
                            </option>
                            @endif @endforeach
                        </select>
                    </div>

                    <div
                        class="form-group col-12"
                        id="divDescription"
                        style="display: none"
                    >
                        <label for="plates">Descripcion</label>
                        <input
                            type="text"
                            name="detailsDescription"
                            class="form-control"
                            id="detailsDescriptionText"
                        />
                    </div>

                    <div class="form-group col-5 mr-3 ml-3">
                        <label>Cantidad</label>
                        <input
                            type="number"
                            class="form-control @error('quantity') is-invalid @enderror"
                            name="quantity"
                            id="quantity"
                        />
                        @error('quantity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-5">
                        <label>Precio</label>
                        <input
                            type="number"
                            class="form-control @error('platePrice') is-invalid @enderror"
                            name="platePrice"
                            readonly
                            value="0"
                            id="platePrice"
                        />
                        @error('platePrice')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div
                        class="col-12 d-flex justify-content-center"
                        style="margin: 1% auto"
                    >
                        <button
                            type="button"
                            class="btn btn-outline-dark"
                            onclick="add_plate()"
                        >
                            Agregar
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-7">
                <div class="input-group my-3 justify-content-end">
                    <div class="input-group-prepend">
                        <span
                            class="input-group-text bg-transparent"
                            style="border: none"
                            >Precio total:&ensp;&ensp;<b class="text-success"
                                >$</b
                            ></span
                        >
                        <input
                            type="number"
                            class="form-control bg-transparent @error('totalPrice') is-invalid @enderror"
                            name="totalPrice"
                            readonly
                            value="0"
                            id="totalPrice"
                            style="border: none; width: 5rem"
                        />
                        @error('totalPrice')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row w-100 m-auto">
                    <table
                        id="table_plates"
                        class="table text-center table-striped mt-2 table-responsive"
                    >
                        <thead>
                            <tr>
                                <th>Nombre platillo</th>
                                <th>Descripción</th>
                                <th>Precio platillo</th>
                                <th>cantidad</th>
                                <th>Sub total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbl_plates"></tbody>
                    </table>
                </div>

                <div class="input-group mb-3 mt-3 justify-content-end">
                    <button
                        type="submit"
                        class="btn btn-outline-success my-auto mx-2 h-80"
                    >
                        Guardar
                    </button>
                    <a
                        href="{{ url('sales') }}"
                        class="btn btn-outline-danger my-auto mr-4 h-80"
                    >
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection @section("scripts")
<script src="/js/alertify.min.js"></script>

<script>
    function assign_price() {
        let plateId = $("#plates option:selected").val();

        let inputDescription = document.getElementById("divDescription");

        if (plateId == 1) {
            inputDescription.style.display = "block";
            $("#platePrice").removeAttr("readonly");
        } else {
            inputDescription.style.display = "none";
            $("#platePrice").attr("readonly", true);
        }

        if (plateId > 0) {
            $.ajax({
                url: `/plates/getPricePlate/${plateId}`,
                type: "GET",
                success: function (res) {
                    $("#platePrice").val(res.price);
                },
            });
        }
    }

    function add_plate() {
        let cantidadInput = $("#quantity").val();
        let platillo = $("#plates option:selected").val();
        let precioPlatillo = $("#platePrice").val();

        if (cantidadInput > 0 && platillo > 0 && precioPlatillo > 0) {
            let validate = validatePlate();

            if (!validate) {
                let idPlatillo = $("#plates option:selected").val();
                let platillo_text = $("#plates option:selected").text();
                let cantidad = $("#quantity").val();
                let precio = $("#platePrice").val();
                let descripcion = "Sin descripción";
                if (idPlatillo == 1) {
                    descripcion = $("#detailsDescriptionText").val();
                }

                $("#tbl_plates").append(`
                <tr id="tr-${idPlatillo}" class="trPlatillos">
                <td class="text-plate">
                    <input type="hidden" name="idPlatillo[]" value="${idPlatillo}" class="idPlates">
                    <input type="hidden" name="cantidades[]" value="${cantidad}" class="cantidades">
                    <input type="hidden" name="precios[]" value="${precio}" class="precios">
                    <input type="hidden" name="descripciones[]" value="${descripcion}" class="text-plate">
                    ${platillo_text}
                </td>
                <td>${descripcion}</td>
                <td>${precio}</td>
                <td class="cantidades-text">${cantidad}</td>
                <td class="subtotales">${
                    parseInt(cantidad) * parseInt(precio)
                }</td>
                <td>
                <button type="button" class="btn btn-danger bg-danger" style="width: 35px; height: 35px; display: flex;justify-content:center" onclick="delete_plate(${idPlatillo})"><i class="fas fa-ban"></i></button>
                </td>
                </tr>
                `);
                let precio_total = $("#totalPrice").val() || 0;
                $("#totalPrice").val(
                    parseInt(precio_total) +
                        parseInt(cantidad) * parseInt(precio)
                );
            }
        } else {
            alertify.set("notifier", "position", "top-right");
            alertify.error(
                "Debe seleccionar un platillo y digitar una cantidad y colocar el precio."
            );
        }
    }

    function delete_plate(id) {
        let cantidad = $("#tr-" + id)
            .find("input.cantidades")
            .val();
        let precioPlatillo = $("#tr-" + id)
            .find("input.precios")
            .val();

        $("#tr-" + id).remove();
        let precio_total = $("#totalPrice").val() || 0;
        $("#totalPrice").val(
            parseInt(precio_total) - parseInt(cantidad * precioPlatillo)
        );
    }

    function validatePlate() {
        let validation = false;

        if ($("#plates option:selected").val() != 1) {
            if ($("table#table_plates tbody tr").length > 0) {
                $("table#table_plates tbody tr").each(function () {
                    if (
                        $(this).find("input.idPlates").val() ==
                        $("#plates option:selected").val()
                    ) {
                        validation = true;
                        $(this)
                            .find("input.cantidades")
                            .val(
                                parseInt(
                                    $(this).find("input.cantidades").val()
                                ) + parseInt($("#quantity").val())
                            );

                        let subtotal = parseInt(
                            $("#quantity").val() *
                                parseInt($("#platePrice").val())
                        );
                        let precio_total = $("#totalPrice").val() || 0;

                        $("#totalPrice").val(
                            parseInt(precio_total) + parseInt(subtotal)
                        );

                        $(this)
                            .find("td.subtotales")
                            .text(
                                parseInt($(this).find("td.subtotales").text()) +
                                    parseInt(
                                        parseInt($("#quantity").val()) *
                                            parseInt($("#platePrice").val())
                                    )
                            );
                        $(this)
                            .find("td.cantidades-text")
                            .text(
                                parseInt(
                                    $(this).find("td.cantidades-text").text()
                                ) + parseInt($("#quantity").val())
                            );
                    }
                });
            }
        } else {
            if ($("table#table_plates tbody tr").length > 0) {
                $("table#table_plates tbody tr").each(function () {
                    if (
                        $(this)
                            .find("input.text-plate")
                            .val()
                            .trim()
                            .toLowerCase() ==
                        $("#detailsDescriptionText").val().trim().toLowerCase()
                    ) {
                        validation = true;
                        $(this)
                            .find("input.cantidades")
                            .val(
                                parseInt(
                                    $(this).find("input.cantidades").val()
                                ) + parseInt($("#quantity").val())
                            );

                        let subtotal = parseInt(
                            $("#quantity").val() *
                                parseInt($("#platePrice").val())
                        );
                        let precio_total = $("#totalPrice").val() || 0;

                        $("#totalPrice").val(
                            parseInt(precio_total) + parseInt(subtotal)
                        );

                        $(this)
                            .find("td.subtotales")
                            .text(
                                parseInt($(this).find("td.subtotales").text()) +
                                    parseInt(
                                        parseInt($("#quantity").val()) *
                                            parseInt($("#platePrice").val())
                                    )
                            );
                        $(this)
                            .find("td.cantidades-text")
                            .text(
                                parseInt(
                                    $(this).find("td.cantidades-text").text()
                                ) + parseInt($("#quantity").val())
                            );
                    }
                });
            }
        }

        return validation;
    }
</script>

@endsection
