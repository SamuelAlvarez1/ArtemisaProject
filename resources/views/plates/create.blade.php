@extends('layouts.panel')
@section('styles')
<link rel="stylesheet" href="/css/alertify.min.css" />
    <link rel="stylesheet" href="/css/themes/bootstrap.css" />
@endsection

@section('title-nav')
    Crear platillo/s
@endsection

@section('main-content')
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
    <div class="row">
        <div class="col">
            <h2 class="text-center">Crear platillo</h2>
        </div>
    </div>

    <form action="{{url('plates')}}" method="post">
        @csrf
        <div class="row">

            <div class="col-10">

                <div class="card pb-3">
                    <div class="card-head">
                        <br>
                    </div>
                    <div class="row card-body d-flex justify-content-center">
                        <div class="form-group col-4">
                            <label for="">Categoría</label>
                            <select name="categories" class="form-control" id="categories" required>
                                <option value="">Seleccione</option>
                                @foreach($categories as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label for="">Nombre del platillo</label>
                            <input type="text" class="form-control @error('plate') is-invalid @enderror"
                                   name="plate" id="plate" required>
                            @error('plate')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="form-group col-3">
                            <label for="">Precio base</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror"
                                   name="price" id="price" required>
                            @error('price')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4 d-flex justify-content-center" style="margin: auto; ">

                        <button type="button" class="btn btn btn-outline-dark "
                                onclick="agregar_plate()">Agregar
                        </button>
                        <a href="{{url('plates')}}" class="btn btn-outline-danger">
                            Volver
                        </a>
                    </div>


                    <div class="col-12 mb-4">
                        <button type="submit" class="btn btn-outline-dark float-right">Guardar platillo/s</button>
                    </div>

                    <div class="row m-auto">
                        <table id="table_plates" class="table text-center table-responsive">
                            <thead>
                            <tr>
                                <th>Categoría</th>
                                <th>Nombre platillo</th>
                                <th>Precio</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody id="tbl_plates">

                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>

        </div>
    </form>

@endsection

@section("scripts")

<script src="/js/alertify.min.js"></script>

    <script>

        let id = 0;

        function agregar_plate() {
            let validate = validatePlate();
            let plate_text = $("#plate").val();
            let price = $("#price").val();
            let category_text = $("#categories option:selected").text();
            let category = $("#categories option:selected").val();

            if (price > 0 && plate_text != "" && category != "") {
            if (!validate) {

                id++;
                $("#tbl_plates").append(`
            <tr id="tr-${id}">
            <td>
            <input type="hidden" class="plate" name="plate[]" value="${plate_text}">
                <input type="hidden" name="id[]" value="${id}">
                <input type="hidden" name="prices[]" value="${price}">
                <input type="hidden" name="categories[]" value="${category}">
            ${category_text}</td>
            <td class="name">${plate_text}</td>
            <td>${price}</td>

            <td>
            <button type="button" class="btn btn-danger bg-danger" style="width: 35px; height: 35px; display: flex;margin: auto; justify-content: center" onclick="remove_plate(${id}, ${parseInt(price)})"><i class="fas fa-ban"></i></button>
            </td>
            </tr>
            `);

        }
            } else {
                alertify.set('notifier','position', 'top-right');
                    alertify.error('Debes completar los campos');
            }

        }


        function remove_plate(id) {
            $("#tr-" + id).remove();

        }


        function validatePlate(){
           var validate = false;
        if ($('table#table_plates tbody tr').length > 0){
            $('table#table_plates tbody tr').each(function(){
                if ($(this).find('.name').text().toLowerCase().split(" ").join("") === $("#plate").val().toLowerCase().split(" ").join("")){
                    alertify.set('notifier','position', 'top-right');
                    alertify.error('el platillo ya se ha agregado');
                    validate = true;
                }
            });

        }
        return validate;
    }


    </script>


@endsection
