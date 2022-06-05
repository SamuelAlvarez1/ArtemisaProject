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
            <div class="row mx-auto row-cols-3">
                <div class="col my-2">
                    <strong>Ventas</strong>
                </div>
                <div class="col-xl-7">

                    <a href="{{url('/sales/create')}}" class=" btn btn-sm my-2 btn-outline-dark">Registrar venta</a>

                    @if($states == 'activeSales')
                        <a href="{{url('/sales/canceledSales')}}" class="btn btn-sm my-2 btn-outline-dark">Ver ventas
                            Anuladas</a>
                    @else
                        <a href="{{url('/sales')}}" class="btn my-2 btn-sm mr-4 btn-outline-dark">Ver ventas
                            Realizadas</a>
                    @endif
                </div>
                <div class="col-lg">
                    <div class="input-group my-2">
                        <input type="text" class="form-control-sm border border-dark" id="searchInput"
                               placeholder="Búsqueda"
                               aria-label="Recipient's username" aria-describedby="basic-addon2">

                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="mx-auto mb-3">
                <table aria-label="sales" id="sales" class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Clientes</th>
                        <th>Realizada por</th>
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
                            <td>
                                @if ($value->idCustomers == null)
                                    Cliente de Mostrador
                                @else
                                    <a class="text-dark" href="{{url('/customers/'.$value->idCustomers)}}"><u>{{$value->customerName}}</u></a>
                                @endif
                            </td>
                            <td>
                                @if(auth()->user()->idRol == 1)
                                <a class="text-dark" href="{{url('/users/'.$value->idUser)}}"><u>{{$value-> userName}}</u></a>
                                @else
                                    {{$value-> userName}}
                                @endif
                            </td>
                            <td id="columnPrice">${{number_format($value-> finalPrice)}}</td>
                            <td>{{$value->created_at->isoFormat('dddd D MMMM YYYY, h:mm a')}}</td>
                            <td>
                                @if($value->state == 1)
                                    <span class="badge badge-success">Activa</span>
                                @else
                                    <span class="badge badge-danger">Anulada</span>
                                @endif

                            </td>
                            <td>
                                <a class="mx-2" 
                                   title="Ver detalles de la Venta" href="{{url('/sales/'.$value->id)}}"><i
                                        class="fa-solid text-dark fa-info-circle"></i></a>
                                @if($value->state == 1)
                                    <a class="mx-2" title="Anular la venta"
                                       href="{{url('/sales/updateState/'.$value->id)}}"><i
                                            class="fa text-dark fa-ban"></i></a>
                                @else
                                    <a class="mx-2" title="Activar la venta"
                                       href="{{url('/sales/updateState/'.$value->id)}}"><i
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
                            rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true, 
                            "dom": 'tp',
                            'language': spanish
                        });

            $('#searchInput').on('keyup', function () {
                table.search($('#searchInput').val()).draw();
            });
        });
    </script>

    <script>
        ($("#columnPrice")).toLocaleString(navigator.language, {
            style: "currency",
            currency: "COP"
        });
    </script>
@endsection
