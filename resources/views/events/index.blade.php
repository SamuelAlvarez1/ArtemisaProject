@extends('layouts.panel')
@section('main-content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <strong>Eventos</strong>
                </div>
                <div class="col-6">
                    <a href="{{url('/events/create')}}" class="btn btn-outline-dark">Crear evento</a>
                    <a href="{{url('/events/old')}}" class="btn btn-outline-dark">Ver eventos antiguos</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="customers" class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio de decoracion</th>
                        <th>Precio de entrada</th>
                        <th>Fecha inicio</th>
                        <th>Fecha fin</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--table content--}}
                    @foreach($events as $event)
                        <tr>
                            <td>{{$event->id}}</td>
                            <td>{{$event->name}}</td>
                            <td>{{$event->description}}</td>
                            <td>{{$event->decorationPrice}}</td>
                            <td>{{$event->entryPrice}}</td>
                            <td>{{$event->startDate}}</td>
                            <td>{{$event->endDate}}</td>
                            <td>{{$event->state}}</td>
                            <td></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection
