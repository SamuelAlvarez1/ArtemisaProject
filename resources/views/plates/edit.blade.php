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

            <div class="row mb-5">
                <div class="col">
                    <label for="">Categoría <b class="text-danger">*</b></label>
                    <select name="idCategory" class="form-control @error('idCategory') is-invalid @enderror" id="categories">
                        <option value="">Seleccione</option>
                        @foreach($categories as $value)
                            <option
                                value="{{$value->id}}" {{($plate->idCategory == $value->id) ? 'selected' : ''}}>{{$value->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="">Nombre del platillo <b class="text-danger">*</b></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           name="name" id="name" onkeypress="return check(event)" value="{{$plate->name}}">
                </div>
            </div>

            <div class="row mb-4">
                <div class="col">
                    <label for="">Precio base <b class="text-danger">*</b></label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror"
                           name="price" id="price" value="{{$plate->price}}">
                </div>
                <div class="col">

                    <label for=" formFileDisabled" class="form-label">Adjuntar imagen de evento</label>
                    <input class="form-control @error('image') is-invalid @enderror" name="image" type="file" id="formFileDisabled" value="{{$plate->image}}">

                </div>
            </div>
            <div class="row mb-2">
                @if($plate->image == null)
                    <span class="badge badge-danger">Sin imagen <i class="fas fa-image"></i></span>
                @else
                    <button type="button" class="bg-transparent d-block m-auto border-0" data-toggle="modal"
                            data-target=".bd-image-modal-lg">
                        <img src="/uploads/{{$plate->image}}" width="250px" alt="Imagen no disponible" style="border-radius: 10px">
                    </button>
                    <div class="modal fade bd-image-modal-lg" tabindex="-1" role="dialog"
                         aria-labelledby="imageModal" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLabel">Imagen</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <img class="align-self-center mb-4" src="/uploads/{{$plate->image}}"
                                     alt="Imagen no disponible">
                            </div>
                        </div>
                    </div>
                @endif
            </div>



    </div>
    <div class="d-flex justify-content-center mx-auto mb-4">
        <button type="submit" class="btn btn-outline-success float-right">Actualizar
        </button>
    </div>
    </form>





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
