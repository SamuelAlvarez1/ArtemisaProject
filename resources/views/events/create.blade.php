@extends('layouts.panel')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('title-nav')
    Crear evento
@endsection
@section('main-content')

<div class="col-md-8 offset-2 my-2">
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Crear evento</h3>
                </div>
                <div class="col text-right">
                    <a href="{{url('events')}}" class="btn btn-sm btn-danger">
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
                    <label for="nameInput">Nombre<b class="text-danger">*</b></label>
                    <input value="{{old('name')}}" type="text" class="form-control" name="name" id="nameInput"
                           placeholder="Evento">
                </div>
                <div class="form-group">
                    <label for="emailInput">Descripción<b class="text-danger">*</b></label>
                    <textarea rows="2" class="form-control" name="description" id="descriptionInput" placeholder="Evento">{{old('description')}}</textarea>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <label for="idCardInput">Precio de entrada</label>
                        <input value="{{old('entryPrice')}}" type="number" class="form-control" name="entryPrice"
                            id="addressInput" placeholder="Evento">
                    </div>
                    <div class="col">
                        <label for="idCardInput">Precio de decoration </label>
                        <input value="{{old('decorationPrice')}}" type="number" class="form-control" name="decorationPrice"
                            id="decorationPriceInput" placeholder="Evento">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="dateInput">Fecha de inicio<b class="text-danger">*</b></label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input value="{{old('date', date('Y-m-d'))}}" type="text" class="form-control datepicker"
                                       name="startDate"
                                       id="date" data-date-format="yyyy-mm-dd" data-date-start-date="{{date('Y-m-d')}}"
                                       data-date-end-date="+60d">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="dateInput">Fecha fin<b class="text-danger">*</b></label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input value="{{old('date', date('Y-m-d'))}}" type="text" class="form-control datepicker"
                                       name="endDate"
                                       id="date" data-date-format="yyyy-mm-dd" data-date-start-date="{{date('Y-m-d')}}"
                                       data-date-end-date="+62d">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Selecciona una imagen</label>
                    <input class="form-control" name="image" type="file" id="formFile">
                </div>
                <div class="form-check mb-3">
                    <input type="hidden" name="state" value="0">
                                  <input class="form-check-input" name="state" checked type="checkbox" value="1" id="state">
                            
                                  <label class="form-check-label" for="state">
                        Estado
                    </label>
                </div>
                <button type="submit" class="btn btn-success">Crear</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
       $('.datepicker').datepicker();
    </script>
@endsection
