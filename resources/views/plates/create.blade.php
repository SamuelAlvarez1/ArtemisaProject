@extends('layouts.forms')
@section('styles')
    <link rel="stylesheet" href="/css/alertify.min.css"/>
    <link rel="stylesheet" href="/css/themes/bootstrap.css"/>
@endsection

@section('title-nav')
    Crear platillo
@endsection

@section('form')


    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Crear platillo</h3>
            </div>
            <div class="col text-right">
                <a href="{{url('plates')}}" class="btn btn-sm btn-outline-danger">
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
        <form action="{{url('plates')}}" method="post">
            @csrf

            <div class="form-group ">
                <label for="">Categoría <b class="text-danger">*</b></label>
                <select name="idCategory" class="form-control @error('idCategory') is-invalid @enderror" id="categories">
                    <option value="">Seleccione</option>
                    @foreach($categories as $value)
                        <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group ">
                <label for="">Nombre del platillo <b class="text-danger">*</b></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                       name="name" id="plate" onkeypress="return check(event)">
            </div>
            <div class="form-group ">
                <label for="">Precio base <b class="text-danger">*</b></label>
                <input type="number" class="form-control @error('price') is-invalid @enderror"
                       name="price" id="price">
            </div>

    <div class="d-flex justify-content-center" style="margin: auto; ">
            <button type="submit" class="btn btn-outline-success float-right">Crear
            </button>
    </div>



        </form>

    </div>
{{--    <div class="col">--}}
{{--        <table id="table_plates" class="table text-center table-responsive">--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <th>Categoría</th>--}}
{{--                <th>Nombre platillo</th>--}}
{{--                <th>Precio</th>--}}
{{--                <th>Acciones</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody id="tbl_plates">--}}

{{--            </tbody>--}}
{{--        </table>--}}
{{--    </div>--}}




@endsection

@section("scripts")

    <script src="/js/alertify.min.js"></script>

    <script>
{{--        let id = 0;--}}

{{--        function agregar_plate() {--}}

{{--            $("#categories option[value=" + "null" + "]").attr('selected', false);--}}

{{--            let validate = validatePlate();--}}
{{--            let plate_text = $("#plate").val();--}}
{{--            let price = $("#price").val();--}}
{{--            let category_text = $("#categories option:selected").text();--}}
{{--            let category = $("#categories option:selected").val();--}}

{{--            if (price > 0 && plate_text != "" && category != "null") {--}}
{{--                if (plate_text.length <= 3) {--}}
{{--                    alertify.set('notifier', 'position', 'top-right');--}}
{{--                    alertify.error('El campo nombre platillo debe tener mínimo 4y caracteres');--}}
{{--                } else {--}}
{{--                    if (price <= 400) {--}}
{{--                        alertify.set('notifier', 'position', 'top-right');--}}
{{--                        alertify.error('El campo precio debe ser de mínimo 500');--}}
{{--                    } else {--}}
{{--                        if (!validate) {--}}

{{--                            id++;--}}
{{--                            $("#tbl_plates").append(`--}}
{{--            <tr id="tr-${id}">--}}
{{--            <td>--}}
{{--            <input type="hidden" class="plate" name="plate[]" value="${plate_text}">--}}
{{--                <input type="hidden" name="id[]" value="${id}">--}}
{{--                <input type="hidden" name="price[]" value="${price}">--}}
{{--                <input type="hidden" name="idCategory[]" value="${category}">--}}
{{--            ${category_text}</td>--}}
{{--            <td class="name">${plate_text}</td>--}}
{{--            <td>${price}</td>--}}

{{--            <td>--}}
{{--            <button type="button" class="btn btn-danger bg-danger"  style="width: 35px; height: 35px; display: flex;margin: auto; justify-content: center" onclick="remove_plate(${id}, ${parseInt(price)})"  data-toggle="tooltip" data-placement="right" title="Remover"><i class="fas fa-ban"></i></button>--}}
{{--            </td>--}}
{{--            </tr>--}}
{{--            `);--}}


{{--                            $("#plate").val("");--}}
{{--                            $("#price").val("");--}}
{{--                            $("#categories option[value=" + "null" + "]").attr('selected', true);--}}


{{--                        }--}}
{{--                    }--}}
{{--                }--}}
{{--            } else {--}}
{{--                alertify.set('notifier', 'position', 'top-right');--}}
{{--                alertify.error('Debes completar los campos');--}}
{{--            }--}}

{{--        }--}}


{{--        function remove_plate(id) {--}}
{{--            $("#tr-" + id).remove();--}}

{{--        }--}}


{{--        function validatePlate() {--}}
{{--            var validate = false;--}}
{{--            if ($('table#table_plates tbody tr').length > 0) {--}}
{{--                $('table#table_plates tbody tr').each(function () {--}}
{{--                    if ($(this).find('.name').text().toLowerCase().split(" ").join("") === $("#plate").val()--}}
{{--                        .toLowerCase().split(" ").join("")) {--}}
{{--                        alertify.set('notifier', 'position', 'top-right');--}}
{{--                        alertify.error('el platillo ya se ha agregado');--}}
{{--                        validate = true;--}}
{{--                    }--}}
{{--                });--}}

{{--            }--}}
{{--            return validate;--}}
{{--        }--}}

        function check(e) {
            tecla = (document.all) ? e.keyCode : e.which;

            //Tecla de retroceso para borrar, siempre la permite
            if (tecla == 8 || tecla == 32) {
                return true;
            }

            // Patrón de entrada, en este caso solo acepta numeros y letras
            patron = /[A-Za-z0-9á-úÁ-Ú]/;
            tecla_final = String.fromCharCode(tecla);
            return patron.test(tecla_final);
        }
    </script>


@endsection
