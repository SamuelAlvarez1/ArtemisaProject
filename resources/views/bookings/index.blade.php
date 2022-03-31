@extends('layouts.panel')

@section('styles')
    
@endsection

@section('main-content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-3">
                <strong>Reservas    </strong>
            </div>
            <div class="col-5">

                <a href="{{url('/bookings/create')}}" class="btn mx-2 btn-outline-dark">crear reserva</a>

                @if($states == '0')
                <a href="{{url('/bookings')}}" class="btn btn-outline-dark">Ver reservas en proceso</a>
                <a href="{{url('/bookings/seeApproved')}}" class="btn btn-outline-dark">Ver reservas aprobadas</a>
                @endif
                @if ($states == "1")
                <a href="{{url('/bookings/seeCanceled')}}" class="btn btn-outline-dark">Ver reservas canceladas</a>
                    <a href="{{url('/bookings/seeApproved')}}" class="btn btn-outline-dark">Ver reservas aprobadas</a>
                @endif        

                @if ($states == "2")
                <a href="{{url('/bookings/seeCanceled')}}" class="btn btn-outline-dark">Ver reservas canceladas</a>
                    <a href="{{url('/bookings')}}" class="btn btn-outline-dark">Ver reservas en proceso</a>
                @endif        
                
            </div>
            <div class="col-4">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="searchInput" placeholder="Busqueda"
                           aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-dark" id="searchButton" type="button">Buscar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive mb-3 text-center">
            <table id="bookings" class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th>Id</th>
                    <th>Cliente</th>
                    <th>Evento</th>
                    <th>cantidad de personas</th>
                    @if (auth()->user()->idRol == 1)
                        <th>Usuario que creo la reserva</th>
                        @endif
                    <th>Estado</th>
                    <th>fecha inicial</th>
                    <th>fecha final</th>
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
                            @if($value->state == 0)
                            <span class="badge badge-danger">Cancelada</span>
                            @endif
                            @if($value->state == 1)
                                <span class="badge badge-primary">En proceso</span>
                            @endif
                            @if($value->state == 2)
                                <span class="badge badge-success">Aprobada</span>
                                
                            @endif

                        </td>
                        <td>{{$value->start_date}}</td>
                        <td>{{$value->final_date}}</td>
                        
                        <td>
                            <a class="mx-2" href="{{url('/bookings/'.$value->id)}}"><i
                                    class="fa-solid text-dark fa-magnifying-glass"></i></a>
                            <a class="mx-2" href="{{url('/bookings/'.$value->id.'/edit')}}"><i
                                    class="fa text-dark fa-edit"></i></a>
                            @if($value->state == 0)
                                <a class="mx-2" href="{{url('/bookings/updateState/'.$value->id)}}/1"><i
                                    class="fa text-dark fa-check"></i></a>
                                        
                            @endif
                            @if($value->state == 1)
                            <a class="mx-2" href="{{url('/bookings/updateState/'.$value->id)}}/0"><i
                                class="fa text-dark fa-ban"></i></a>
                                <a class="mx-2" href="{{url('/bookings/updateState/'.$value->id)}}/2"><i
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
                            "dom": 't'
                        });

                        $('#searchButton').on('keyup click', function () {
                            table.search($('#searchInput').val()).draw();
                        });
                    });
                </script>



@endsection