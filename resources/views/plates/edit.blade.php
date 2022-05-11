@extends('layouts.forms')

@section('title-nav')
    Editar platillo
@endsection

@section('form')
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Editar platillo</h3>
            </div>
            <div class="col text-right">
                <a href="{{url('plates')}}" class="btn btn-sm btn-outline-danger">
                    Regresar
                </a>
            </div>
        </div>
    </div>
    <form action="{{url('plates/'.$plate->id)}}" method="post">
        @csrf
        @method('PUT')
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

            <div class="form-group ">
                <label for="">Categoría <b class="text-danger">*</b></label>
                <select name="idCategory" class="form-control @error('name') is-invalid @enderror" id="categories">
                    <option value="">Seleccione</option>
                    @foreach($categories as $value)
                        <option
                            value="{{$value->id}}" {{($plate->idCategory == $value->id) ? 'selected' : ''}}>{{$value->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group ">
                <label for="">Nombre del platillo <b class="text-danger">*</b></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                       name="name" id="name" onkeypress="return check(event)" value="{{$plate->name}}">
            </div>
            <div class="form-group">
                <label for="">Precio base <b class="text-danger">*</b></label>
                <input type="number" class="form-control @error('price') is-invalid @enderror"
                       name="price" id="price" value="{{$plate->price}}">
            </div>

    </div>
    <div class="d-flex justify-content-center mx-auto mb-4">
        <button type="submit" class="btn btn-outline-success float-right">Guardar platillo
        </button>
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
            let description_text = description.substring(0, 20);
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
