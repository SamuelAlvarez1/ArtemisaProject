@extends('layouts.panel')
@section('main-content')

    <div class="col-md-7 offset-2 my-2">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h2>Detalles del evento</h2>
                    </div>
                    <div class="col text-right">
                        <a href="{{url('/events/'.$event->id.'/edit')}}" class="btn btn-sm btn-warning">
                            Editar este evento
                        </a>
                        <a href="{{url('events')}}" class="btn btn-sm btn-danger">
                            Regresar
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h4 class="card-subtitle mt-2">Nombre del evento</h4>
                <p class="card-text">{{$event->name}}</p>
                <h4 class="card-subtitle mt-2">Descripción</h4>
                <p class="card-text">{{$event->description}}</p>
                <h4 class="card-subtitle mt-2">Precio de decoración</h4>
                <p class="card-text">
                    @if($event->decorationPrice == '')
                        Precio sin especificar
                    @else
                        {{$event->decorationPrice}}
                    @endif
                </p>
                <h4 class="card-subtitle mt-2">Precio de entrada</h4>
                <p class="card-text">
                    @if($event->entryPrice == '')
                        Precio sin especificar
                    @else
                        {{$event->entryPrice}}
                    @endif
                </p>
                <h4 class="card-subtitle mt-2">Fecha de inicio</h4>
                <p class="card-text">{{$event->startDate}}</p>
                <h4 class="card-subtitle mt-2">Fecha fin</h4>
                <p class="card-text">{{$event->endDate}}</p>
                <h4 class="card-subtitle mt-2">Fecha de creación del evento</h4>
                <p class="card-text">{{$event->created_at}}</p>
                <h4 class="card-subtitle mt-2">Ultima actualización del evento</h4>
                <p class="card-text">{{$event->updated_at}}</p>
                <h4 class="card-subtitle mt-2">Usuario que creo el evento</h4>
                <ul>
                    <li><p class="card-text">Nombre: {{$user->name.' '.$user->last_name}}</p></li>
                    <li><p class="card-text">Número de telefono: {{$user->phone}}</p></li>
                    <li><p class="card-text">Rol: {{$role->name}}</p></li>
                </ul>
                <p class="card-text">{{$user->name}}</p>
                <h4 class="card-subtitle mt-2">Estado</h4>
                @if ($event->state == 0)
                    <span class="badge badge-danger">No activo</span>
                @else
                    <span class="badge badge-success">Activo</span>
                @endif
                <h4 class="card-subtitle mt-2">Imagen</h4>
                @if($event->image == null)
                    <span class="badge badge-danger">Sin imagen</span>
                @else
                    <button type="button" class="bg-transparent d-block m-auto border-0" data-toggle="modal" data-target=".bd-image-modal-lg">
                        <img src="/uploads/{{$event->image}}" width="250px" alt="Imagen no disponible">
                    </button>
                    <div class="modal fade bd-image-modal-lg" tabindex="-1" role="dialog" aria-labelledby="imageModal" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLabel">Imagen</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <img class="align-self-center mb-4" src="/uploads/{{$event->image}}" alt="Imagen no disponible">
                            </div>
                        </div>
                    </div>
                @endif
            </div>


        </div>


@endsection
