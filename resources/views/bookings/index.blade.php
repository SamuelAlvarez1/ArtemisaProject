@extends('layouts.panel')



@section('styles')

@endsection

@section('title-nav')
    @if ($states == '0')
        Reservas canceladas
    @endif
    @if ($states == '1')
        Reservas en proceso
    @endif
    @if ($states == '2')
        Reservas finalizadas
    @endif

@endsection

@section('main-content')

<div class="card">
    <div class="card-header">
        <div class="row mx-auto row-cols-3">
            <div class="col my-2">
                <strong>Reservas</strong>
            </div>
            <div class="col-xl-7">
                <a href="{{url('/bookings/create')}}" class="btn-sm btn btn-outline-dark" >Crear reserva</a>
                @if($states == '0')
                <a href="{{url('/bookings')}}" class="btn-sm btn btn-outline-dark" >Ver reservas en proceso</a>
                <a href="{{url('/bookings/seeApproved')}}" class="btn-sm btn btn-outline-dark" >Ver reservas aprobadas</a>
                @endif
                @if ($states == "1")
                <a href="{{url('/bookings/seeCanceled')}}" class="btn-sm btn my-2 btn-outline-dark" >Ver reservas
                    canceladas</a>
                <a href="{{url('/bookings/seeApproved')}}" class="btn-sm btn my-2 btn-outline-dark" >Ver reservas
                    finalizadas</a>
                @endif
                @if ($states == "2")
                <a href="{{url('/bookings/seeCanceled')}}" class="btn-sm my-2 btn btn-outline-dark"  data-toggle="tooltip" data-placement="top" title="Ver las reservas que se cancelaron">Ver reservas
                    canceladas</a>
                <a href="{{url('/bookings')}}" class="btn-sm btn btn-outline-dark"  data-toggle="tooltip" data-placement="top" title="Ver las reservas que se encuentran en proceso">Ver reservas en proceso</a>
                @endif
            </div>
            <div class="col-lg">
                <div class="input-group my-2">
                    <input type="text" class="form-control-sm border border-dark" id="searchInput" placeholder="Busqueda"
                        aria-label="Recipient's username" aria-describedby="basic-addon2"  data-toggle="tooltip" data-placement="top" title="digite para buscar una reserva que se desee encontrar">
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="mx-auto mb-3">
            <table id="bookings" class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Evento</th>
                        <th>cantidad de personas</th>
                        @if (auth()->user()->idRol == 1)
                        <th>Usuario que creo <br> la reserva</th>
                        @endif
                        <th>Estado</th>
                        <th>fecha inicial</th>
                        @if ($states == "2")
                        <th>fecha final</th>
                        @endif
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($bookings as $value)

                    <tr>

                        <td>{{$value->id}}</td>
                        <td>{{$value->customerName}}</td>
                        <td>
                            @if ($value->idEvent == null)
                            sin evento
                            @else
                            {{$value->eventName}}
                            @endif
                        </td>
                        <td>{{$value->amount_people}}</td>
                        @if (auth()->user()->idRol == 1)
                        <td>{{$value->user}}</td>
                        @endif
                        <td>
                            @if($value->idState == 1)
                            <span class="badge badge-danger">{{$value->stateName}}</span>
                            @endif
                            @if($value->idState ==2)
                            <span class="badge badge-primary">{{$value->stateName}}</span>
                            @endif
                            @if($value->idState == 3)
                            <span class="badge badge-success">{{$value->stateName}}</span>

                            @endif

                        </td>
                        <td>{{$value->start_date->isoFormat('dddd D MMMM YYYY, h:mm a')}}</td>
                        @if ($states == "2")
                        <td>{{$value->final_date->isoFormat('dddd D MMMM YYYY, h:mm a')}}</td>
                        @endif

                        <td>
                            <a class="mx-2" href="{{url('/bookings/'.$value->id)}}" title="Ver los detalles de esta reserva"><i class="fa-solid text-dark fa-info-circle"></i></a>

                            @if($value->idState == 1)

                            <a class="mx-2" href="{{url('/bookings/'.$value->id.'/edit')}}" title="Editar esta reserva"><i
                                class="fa text-dark fa-edit"></i></a>
                            <a class="mx-2" href="{{url('/bookings/updateState/'.$value->id)}}/2" title="Poner esta reserva en proceso"><i

                                    class="fa text-dark fa-check"></i></a>
                            @endif

                            @if($value->idState == 2)

                            <a class="mx-2" href="{{url('/bookings/'.$value->id.'/edit')}}" title="Editar esta reserva"><i
                                class="fa text-dark fa-edit"></i></a>

                            <a class="mx-2" href="{{url('/bookings/updateState/'.$value->id)}}/1" title="Cancelar esta reserva"><i
                                    class="fa text-dark fa-ban"></i></a>
                            <a class="mx-2" href="{{url('/bookings/updateState/'.$value->id)}}/3" title="Aprobar esta reserva"><i
                                    class="fa text-dark fa-check"></i></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

            <div class="d-flex justify-content-end">
                {{-- {{ $bookings->links() }} --}}
            </div>
        </div>
    </div>
</div>


@endsection


@section('scripts')
<script>
    $(document).ready(function () {
        var table = $('#bookings').DataTable({
                            responsive: true,
                            "dom": 'tp',
                            responsive: true,
                            'language': spanish,
                        });

        $('#searchInput').on('keyup', function () {
            table.search($('#searchInput').val()).draw();
        });
    });
</script>



@endsection
