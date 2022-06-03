@extends('layouts.forms')

@section('title-nav')
    Editar categoría {{$category->name}}
@endsection

@section('form')



        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Editar categoría</h3>
                </div>
                <div class="col text-right">
                    <a href="{{url('categories')}}" class="btn btn-sm btn-outline-danger">
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
            <form action="{{url('categories/'.$category->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nameInput">Nombre<b class="text-danger">*</b></label>
                    <input value="{{old('name', $category->name)}}" type="text" class="form-control" name="name"
                           id="nameInput" placeholder="Cliente" onkeypress="return check(event)" required>
                </div>

                <div class="row mx-auto">
                    <button type="submit" class="btn btn-outline-success">Actualizar</button>

                </div>
            </form>
        </div>

@endsection
@section("scripts")

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


