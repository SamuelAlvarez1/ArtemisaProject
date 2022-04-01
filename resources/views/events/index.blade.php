@extends('layouts.panel')
@section('main-content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-2 d-flex justify-content-center d-flex align-items-center">
                    <strong>Eventos</strong>
                </div>
                <div class="col-6 d-flex justify-content-center d-flex align-items-center">
                    <a href="{{url('/events/create')}}" class="btn-sm btn mx-2 btn-outline-dark">Crear evento</a>
                    @if($states == 'active')
                        <a href="{{url('/events/old')}}" class="btn-sm btn mx-2 mr-4 btn-outline-dark">Ver eventos antiguos</a>
                    @else
                        <a href="{{url('/events')}}" class="btn-sm btn mx-2 btn-outline-dark">Ver eventos
                            activos</a>
                    @endif
                </div>
                <div class="col-4 d-flex justify-content-center d-flex align-items-center">
                    <div class="input-group">
                        <input type="text" class="form-control-sm form-control" id="searchInput" placeholder="Busqueda"
                               aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-outline-dark" id="searchButton" type="button">Buscar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive text-center">
                <table id="events" class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Valor <br> decoración</th>
                        <th>Valor <br> entrada</th>
                        <th>Fecha <br> inicio</th>
                        <th>Fecha <br> fin</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--table content--}}
                    @foreach($events as $event)
                        <tr>
                            <td>{{$event->id}}</td>
                            <td>{{Str::limit($event->name, 15)}}</td>
                            <td>{{Str::limit($event->description, 13)}}</td>
                            <td>
                                @if($event->decorationPrice == '')
                                    Sin valor
                                @else
                                    {{$event->decorationPrice}}
                                @endif
                            </td>
                            <td>
                                @if($event->entryPrice == '')
                                    Sin valor
                                @else
                                    {{$event->entryPrice}}
                                @endif
                            </td>
                            <td>{{$event->startDate}}</td>
                            <td>{{$event->endDate}}</td>
                            <td>
                                @if($event->state == 1)
                                    <span class="badge badge-success">Activo</span>
                                @else
                                    <span class="badge badge-danger">No activo</span>
                                @endif
                            </td>
                            <td>
                                <a class="mx-2" href="{{url('/events/'.$event->id)}}"><i
                                        class="fa-solid text-dark fa-info-circle"></i></a>
                                <a class="mx-2" href="{{url('/events/'.$event->id.'/edit')}}"><i
                                        class="fa text-dark fa-edit"></i></a>
                                @if($event->state == 1)
                                    <a class="mx-2" href="{{url('/events/updateState/'.$event->id)}}"><i
                                            class="fa text-dark fa-ban"></i></a>
                                @else
                                    <a class="mx-2" href="{{url('/events/updateState/'.$event->id)}}"><i
                                            class="fa text-dark fa-check"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            var table = $('#events').DataTable({
                "dom": 'tp',
                'language': {
                    "paginate": {
                        "first": "Inicio",
                        "last": "Fin",
                        "next": "→",
                        "previous": "←"
                    }
                }
            });
            $('#searchButton').on('keyup click', function () {
                table.search($('#searchInput').val()).draw();
            });
        });
    </script>
@endsection
