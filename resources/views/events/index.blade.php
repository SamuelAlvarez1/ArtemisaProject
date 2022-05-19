@extends('layouts.panel')

@section('title-nav')
    @if ($states == 'active')
        Eventos
    @else
        Eventos antiguos
    @endif
@endsection
@section('main-content')
    <div class="card">
        <div class="card-header">
            <div class="row mx-auto row-cols-3">
                <div class="col my-2">
                    <strong>Eventos</strong>
                </div>
                <div class="col-xl-7">
                    <a href="{{url('/events/create')}}" class="btn-sm btn my-2 btn-outline-dark">Crear evento</a>
                    @if($states == 'active')
                        <a href="{{url('/events/old')}}" class="btn-sm btn my-2 mr-4 btn-outline-dark">Ver eventos antiguos</a>
                    @else
                        <a href="{{url('/events')}}" class="btn-sm btn my-2 btn-outline-dark">Ver todos los eventos</a>
                    @endif
                </div>
                <div class="col-lg">
                    <div class="input-group my-2">
                        <input type="text" class="form-control-sm border border-dark" id="searchInput" placeholder="Busqueda"
                               aria-label="Recipient's username" aria-describedby="basic-addon2">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="mx-auto mb-3">
                <table id="events" class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col" title="Ordenar por orden de creación">#</th>
                        <th scope="col" title="Ordenar por nombre">Nombre</th>
                        <th scope="col" title="Ordenar por descripción">Descripción</th>
                        <th scope="col" title="Ordenar por valor de decoración">Valor <br> decoración</th>
                        <th scope="col" title="Ordenar por valor de entrada">Valor <br> entrada</th>
                        <th scope="col" title="Ordenar por fecha inicio">Fecha <br> inicio</th>
                        <th scope="col" title="Ordenar por fecha fin">Fecha <br> fin</th>
                        <th scope="col" title="Ordenar por estado">Estado</th>
                        <th scope="col">Acciones</th>
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
                                @if($event->state == 1 && $event->startDate <= date('Y-m-d') && $event->endDate >= date('Y-m-d'))
                                    <span class="badge badge-primary">En proceso</span>
                                @elseif($event->state == 1 && $event->endDate < date('Y-m-d'))
                                <span class="badge badge-success">Llevado a cabo</span>
                                @else
                                    <span class="badge badge-danger">Cancelado</span>
                                @endif
                            </td>
                            <td>
                                <a class="mx-2" title="Ver más información del evento" href="{{url('/events/'.$event->id)}}"><i
                                        class="fa-solid text-dark fa-info-circle"></i></a>
                                <a class="mx-2" title="Editar información del evento" href="{{url('/events/'.$event->id.'/edit')}}"><i
                                        class="fa text-dark fa-edit"></i></a>
                                @if($event->state == 1)
                                    <a class="mx-2" title="Desactivar el evento" href="{{url('/events/updateState/'.$event->id)}}"><i
                                            class="fa text-dark fa-ban"></i></a>
                                @else
                                    <a data-delay="500" title="Activar el evento" class="mx-2" href="{{url('/events/updateState/'.$event->id)}}"><i
                                            class="fa text-dark fa-check"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
    </div>
@endsection
@section('scripts')

    <script>
        $(document).ready(function () {
            var table = $('#events').DataTable({
                responsive: true,
                "dom": 'tp',
                'language': {
                    "paginate": {
                        "first": "Inicio",
                        "last": "Fin",
                        "next": "→",
                        "previous": "←",
                    },
                    "emptyTable": "No hay información disponible."
                }
            });
            $('#searchInput').on('keyup', function () {
                table.search($('#searchInput').val()).draw();
            });
        });
    </script>
@endsection
