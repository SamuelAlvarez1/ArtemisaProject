@extends('layouts.panel')

@section('styles')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
          integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
@endsection

@section('title-nav')
    Editar evento
@endsection

@section('main-content')

    <div class="col-md-8 mx-auto mt-1 mb-2">
        <div class="card shadow">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Editar información</h3>
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
                <form action="{{url('events/'.$event->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nameInput">Nombre</label>
                        <input value="{{old('name', $event->name)}}" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="nameInput"
                            >
                    </div>
                    <div class="form-group">
                        <label for="emailInput">Descripción</label>
                        <textarea rows="3" class="form-control @error('description') is-invalid @enderror" name="description" id="descriptionInput" resize="none">{{old('description', $event->description)}}</textarea>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <label for="idCardInput">Precio de entrada</label>
                            <input value="{{old('entryPrice', $event->entryPrice)}}" type="number" class="form-control @error('entryPrice') is-invalid @enderror"
                                name="entryPrice"
                                id="addressInput" >
                        </div>
                        <div class="col">
                            <label for="idCardInput">Precio de decoración </label>
                            <input value="{{old('decorationPrice', $event->decorationPrice)}}" type="number"
                                class="form-control @error('decorationPrice') is-invalid @enderror" name="decorationPrice"
                                id="decorationPriceInput" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="dateInput">Fecha de inicio</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><em class="ni ni-calendar-grid-58"></em></span>
                                    </div>
                                    <input value="{{old('startDate', $event->startDate)}}" type="text"
                                        class="form-control @error('startDate') is-invalid @enderror datepicker"
                                        name="startDate"
                                        id="date" data-date-format="yyyy-mm-dd" data-date-start-date="{{date('Y-m-d')}}"
                                        data-date-end-date="+30d">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="dateInput">Fecha fin</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><em class="ni ni-calendar-grid-58"></em></span>
                                    </div>
                                    <input value="{{old('endDate',  $event->endDate)}}" type="text"
                                        class="form-control @error('endDate') is-invalid @enderror datepicker"
                                        name="endDate"
                                        id="date" data-date-format="yyyy-mm-dd" data-date-start-date="{{date('Y-m-d')}}"
                                        data-date-end-date="+30d">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                        <label for="formFile" class="form-label">Imagen</label>
                        <input class="form-control @error('image') is-invalid @enderror" name="image" type="file" id="formFile">
                    </div>
                    <div class="col">
                        @if($event->image == null)
                            <span class="badge mt-5 badge-danger">Sin imagen <i class="fas fa-image"></i></span>
                        @else
                            <button type="button" class="bg-transparent d-block m-auto border-0" data-toggle="modal"
                                    data-target=".bd-image-modal-lg">
                                <img src="/uploads/{{$event->image}}" width="150px" alt="Imagen no disponible" style="border-radius: 10px">
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
                                        <img class="align-self-center details-img mb-4" src="/uploads/{{$event->image}}"
                                             alt="Imagen no disponible">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    </div>
                    <div class="row mx-auto">
                        <button type="submit" class="btn btn-outline-success">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
            integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.datepicker').datepicker();
    </script>
@endsection
