@extends('layouts.forms')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('title-nav')
    Crear evento
@endsection
@section('form')


        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Crear evento</h3>
                </div>
                <div class="col text-right">
                    <a href="{{url('events')}}" class="btn btn-sm btn-outline-danger">
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
            <form action="{{url('events')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nameInput">Nombre<strong class="text-danger">*</strong></label>
                    <input value="{{old('name')}}" type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="nameInput">
                </div>
                <div class="form-group">
                    <label for="emailInput">Descripción<strong class="text-danger">*</strong></label>
                    <textarea rows="3" class="form-control @error('description') is-invalid @enderror" name="description" id="descriptionInput" resize="none">{{old('description')}}</textarea>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <label for="idCardInput">Precio de entrada</label>
                        <input value="{{old('entryPrice')}}" type="number" class="form-control @error('entryPrice') is-invalid @enderror" name="entryPrice">
                    </div>
                    <div class="col">
                        <label for="idCardInput">Precio de decoración </label>
                        <input value="{{old('decorationPrice')}}" type="number" class="form-control @error('decorationPrice') is-invalid @enderror" name="decorationPrice">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="dateInput">Fecha de inicio<strong class="text-danger">*</strong></label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i aria-hidden="true" class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input value="{{old('startDate', date('Y-m-d'))}}" type="text" class="form-control @error('startDate') is-invalid @enderror datepicker"
                                       name="startDate"
                                       id="date" data-date-language="es" data-date-format="yyyy-mm-dd" data-date-start-date="{{date('Y-m-d')}}"
                                       data-date-end-date="+60d">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="dateInput">Fecha fin<strong class="text-danger">*</strong></label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i aria-hidden="true" class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input value="{{old('endDate', date('Y-m-d'))}}" type="text" class="form-control @error('endDate') is-invalid @enderror datepicker"
                                       name="endDate"
                                       id="date" data-date-language="es" data-date-format="yyyy-mm-dd" data-date-start-date="{{date('Y-m-d')}}"
                                       data-date-end-date="+62d">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Selecciona una imagen</label>
                    <input class="form-control @error('image') is-invalid @enderror" value="{{old('image')}}" name="image" type="file" id="formFile">
                </div>
                <div class="row mx-auto">
                    <button type="submit" class="btn btn-outline-success">Crear</button>
                </div>

            </form>
        </div>
@endsection

@section('scripts')
<<<<<<< HEAD
<script>

</script>
=======

>>>>>>> f5f3fd19c5a4b636a0f48303b51e73acd308059e
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $.fn.datepicker.dates['es'] = {
            days: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
            daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
            daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
            months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
            today: "Hoy",
            clear: "Limpiar",
            weekStart: 1
        };

       $('.datepicker').datepicker();
    </script>
@endsection
