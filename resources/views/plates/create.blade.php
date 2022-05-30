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
        <form action="{{url('plates')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row mb-5">
                <div class="col">
                    <label for="">Categoría <b class="text-danger">*</b></label>
                    <select style="width: 100%" name="idCategory" class="form-control @error('idCategory') is-invalid @enderror"
                            id="categories" required>
                        <option value="">Seleccione</option>
                        @foreach($categories as $value)
                            <option value="{{$value->id}}">{{$value->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col ">
                    <label for="">Nombre del platillo <b class="text-danger">*</b></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           name="name" id="plate" onkeypress="return check(event)" value="{{old('name')}}" required>
                </div>
            </div>


            <div class="row mb-5">
                <div class="col">
                    <label for="">Precio base <b class="text-danger">*</b></label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror"
                           name="price" id="price" value="{{old('price')}}" required>
                </div>

                <div class="col">
                    <label for="formFile" class="form-label">Selecciona una imagen</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                           value="{{old('image')}}" name="image" id="formFile">
                </div>
            </div>


            <div class="d-flex justify-content-center" style="margin: auto; ">
                <button type="submit" class="btn btn-outline-success float-right">Crear
                </button>
            </div>


        </form>
    </div>


@endsection

@section("scripts")

    <script src="/js/alertify.min.js"></script>

    <script>

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
