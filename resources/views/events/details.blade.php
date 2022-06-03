@extends('layouts.panel')

@section('title-nav')
    Detalles del evento
@endsection

@section('main-content')

    <div class="col-md-10 mx-auto my-2">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h2>Detalles del evento</h2>
                    </div>
                    <div class="col text-right">
                        <a href="{{url('/events/'.$event->id.'/edit')}}" class="btn mt-2 btn-sm btn-outline-warning">
                            Editar este evento
                        </a>
                        <a href="{{ url()->previous() }}" class="btn btn-sm mt-2 btn-outline-danger">
                            Regresar
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4 row-cols-2">
                    <div class="col">
                        <h4 class="card-subtitle mt-2">Nombre del evento:</h4>
                        <p class="card-text">{{$event->name}}</p>
                        <h4 class="card-subtitle mt-2">Descripción:</h4>
                        <p class="card-text">{{$event->description}}</p>
                        <h4 class="card-subtitle mt-2">Precio de decoración:</h4>
                        <p class="card-text">
                            @if($event->decorationPrice == '')
                                Precio sin especificar
                            @else
                                ${{number_format($event->decorationPrice)}}
                            @endif
                        </p>
                        <h4 class="card-subtitle mt-2">Precio de entrada:</h4>
                        <p class="card-text">
                            @if($event->entryPrice == '')
                                Precio sin especificar
                            @else
                                ${{number_format($event->entryPrice)}}
                            @endif
                        </p>
                        <h4 class="card-subtitle mt-2">Fecha de inicio:</h4>
                        <p class="card-text">{{$event->startDate}}</p>
                        <h4 class="card-subtitle mt-2">Fecha fin:</h4>
                        <p class="card-text">{{$event->endDate}}</p>

                    </div>
                    <div class="col">
                        <h4 class="card-subtitle mt-2">Fecha de creación del evento:</h4>
                        <p class="card-text">{{$event->created_at_12}}</p>
                        <h4 class="card-subtitle mt-2">Ultima actualización del evento:</h4>
                        <p class="card-text">{{$event->updated_at_12}}</p>
                        <h4 class="card-subtitle mt-2">Usuario que creo el evento:</h4>
                        <ul>
                            <li><p class="card-text">Nombre: {{$event->user->name.' '.$event->user->last_name}}</p></li>
                            <li><p class="card-text">Número de telefono: {{$event->user->phone}}</p></li>
                            <li><p class="card-text">Rol: {{$event->user->role->name}}</p></li>
                        </ul>
                        <h4 class="card-subtitle mt-2">Estado:</h4>
                        @if($event->state == 1 && $event->startDate <= date('Y-m-d') && $event->endDate >= date('Y-m-d'))
                            <span class="badge badge-primary">En proceso</span>
                        @elseif($event->state == 1 && $event->endDate < date('Y-m-d'))
                            <span class="badge badge-success">Llevado a cabo</span>
                        @elseif($event->state == 1 && $event->startDate >= date('Y-m-d') && $event->endDate >= date('Y-m-d'))
                            <span class="badge badge-primary">Pendiente</span>
                        @else
                            <span class="badge badge-danger">Cancelado</span>
                        @endif
                        <h4 class="card-subtitle mt-2">Número de reservas con este evento:</h4>
                        <p class="card-text">{{$countBookings}}</p>
                        <h4 class="card-subtitle mt-2">Número de asientos requeridos:</h4>
                        <p class="card-text">{{$seatsNeeded}}</p>
                    </div>
                </div>
                <div>
                    <div class="row">
                        <h4 class="card-subtitle mt-2">Imagen:</h4>

                    </div>
                    <div class="row">
                        @if($event->image == null)
                            <span class="badge badge-danger">Sin imagen</span>
                        @else
                            <button type="button" class="bg-transparent d-block m-auto border-0" data-toggle="modal"
                                    data-target=".bd-image-modal-lg">
                                <img src="/uploads/{{$event->image}}" width="250px" alt="Imagen no disponible">
                            </button>
                            <div class="modal fade bd-image-modal-lg" tabindex="-1" role="dialog"
                                 aria-labelledby="imageModal" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="exampleModalLabel">Imagen:</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <img class="align-self-center mb-4 details-img" src="/uploads/{{$event->image}}"
                                             alt="Imagen no disponible">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>


            </div>

        </div>

@endsection
