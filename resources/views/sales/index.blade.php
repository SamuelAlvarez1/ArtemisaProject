@extends('layouts.panel')

@section('styles')


@endsection

@section('title-nav')
    @if ($states == 'activeSales')
        Ventas
    @else
        Ventas anuladas
    @endif
@endsection

@section('main-content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-3">
                    <strong>Ventas</strong>
                </div>
                <div class="col-6">

                    <a href="{{url('/sales/create')}}" class=" btn btn-sm mx-2 btn-outline-dark">Registrar Venta</a>

                    @if($states == 'activeSales')
                    <a href="{{url('/sales/canceledSales')}}" class="btn btn-sm mx-2 btn-outline-dark">Ver Ventas Anuladas</a>
                    @else
                    <a href="{{url('/sales')}}" class="btn mx-2 btn-sm mr-4 btn-outline-dark">Ver Ventas Realizadas</a>
                    @endif
                </div>
                <div class="col-3 d-flex justify-content-center d-flex align-items-center">
                        <div class="input-group">
                            <input type="text" class="form-control border border-dark" id="searchInput" placeholder="Busqueda"
                                aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-outline-dark" id="searchButton" type="button">Buscar</button>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive mb-3 text-center">
                <table id="sales" class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>Id</th>
                        <th>Clientes</th>
                        <th>Usuario</th>
                        <th>Precio Total</th>
                        <th>Fecha de Ventas</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($sales as $key=>$value)

                        <tr>

                            <td>{{$value-> id}}</td>
                            <td>{{$value-> customerName}}</td>
                            <td>{{$value-> userName}}</td>
                            <td>{{$value-> finalPrice}}</td>
                            <td>{{$value-> created_at}}</td>
                            <td>
                                @if($value->state == 1)
                                    <span class="badge badge-success">Activa</span>
                                @else
                                    <span class="badge badge-danger">Anulada</span>
                                @endif

                            </td>
                            <td>
                                <a class="mx-2" href="{{url('/sales/'.$value->id)}}"><i
                                        class="fa-solid text-dark fa-magnifying-glass"></i></a>
                                @if($value->state == 1)
                                    <a class="mx-2" href="{{url('/sales/updateState/'.$value->id)}}"><i
                                            class="fa text-dark fa-ban"></i></a>
                                @else
                                    <a class="mx-2" href="{{url('/sales/updateState/'.$value->id)}}"><i
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
                        var table = $('#sales').DataTable({
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
