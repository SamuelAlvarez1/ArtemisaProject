@extends('layouts.panel')

@section('styles')

@endsection

@section('title-nav')
    Detalles de la venta
@endsection

@section('main-content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col d-flex justify-content-center">
                    <strong>Detalles de Venta</strong>
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
                    </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>{{$sale->id}}</td>
                            <td>
                                @if ($sale->idCustomers == null)
                                    Cliente de Mostrador
                                @else
                                {{$sale->customerName}}
                            @endif
                            <td>{{$sale->userName}}</td>
                            <td>{{$sale->finalPrice}}</td>
                            <td>{{$sale->created_at->isoFormat('dddd D MMMM YYYY, h:mm a')}}</td>
                            <td>
                                @if($sale->state == 1)
                                    <span class="badge badge-success">Activa</span>
                                @else
                                    <span class="badge badge-danger">Anulada</span>
                                @endif

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive mb-3 text-center">
                <table id="saleDetail" class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>Id</th>
                        <th>Platillos</th>
                        <th>Cantidad</th>
                        <th>Precio Unidad</th>
                        <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                            @foreach ($saleDetail as $value)
                            <tr>
                            <td>{{$value->id}}</td>
                            <td>{{$value->namePlate}}</td>
                            <td>{{$value->quantity}}</td>
                            <td>{{$value->platePrice}}</td>
                            <td>{{($value->quantity * $value->platePrice)}}</td>
                        </tr>
                            @endforeach
                            
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <a href="{{url('sales')}}" class="btn btn-outline-danger mb-4">
                Volver
            </a>
        </div>
    </div>



@endsection


@section('scripts')
    <script>

    </script>
@endsection
