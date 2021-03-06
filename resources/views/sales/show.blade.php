@extends('layouts.panel')

@section('styles')

@endsection

@section('title-nav')
    Detalles de la venta
@endsection

@section('main-content')
    <div class="card">
        <div class="card-header">
            <div class="">
                <p>{{$sale-> created_at->isoFormat('dddd D MMMM YYYY, h:mm a')}}</p>
            </div>
            <div class="row">
                <div class="col d-flex justify-content-center">
                    <h2>Detalles de Venta</h2>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-5 row-cols-2">
                <div class="col">
                    <div class="row d-block">
                        <div class="row">
                            <h2>Cliente:</h2>
                        </div>
                        <div class="row">
                            <p>
                                @if ($sale->idCustomers == null)
                                    Cliente de Mostrador
                                @else
                                    {{$sale->customerName}}
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="row d-block">
                        <div class="row"><h2>Hecha por:</h2></div>
                        <div class="row"><p>{{$sale-> userName}}</p></div>
                    </div>
                </div>
                <div class="col">
                    <div class="row d-block mb-4">
                        <div class="row">
                            <h2>Estado:</h2>
                        </div>
                        <div class="row">
                            @if($sale->state == 1)
                                <span class="badge badge-success">Activo</span>
                            @else
                                <span class="badge badge-danger">No activo</span>
                            @endif
                        </div>
                    </div>
                    <div class="row d-block">
                        <div class="row"><h2><span
                                    class=""
                                    style="border: none"
                                >Precio total:</span></h2></div>
                        <div class="row">
                            <strong class="text-success">$</strong>&ensp;
                            <p>${{number_format($sale-> finalPrice)}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col mx-auto">
                    <table class="table table-striped" id="table-details">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Productos</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio Unidad</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($saleDetail as $key => $value)
                            <tr>
                                <td>{{$key + 1 }}</td>
                                <td>
                                    @if ($value->idPlate == 1)
                                        {{$value-> description}}
                                    @else
                                        <a class="text-dark"
                                           href="{{url('/plates/'.$value->idPlate)}}"><u>{{$value-> namePlate}}</u></a>
                                    @endif
                                </td>
                                <td>{{$value-> quantity}}</td>
                                <td>{{number_format($value-> platePrice)}}</td>
                                <td>{{number_format($value-> quantity * $value->platePrice)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

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
    $(document).ready(function () {
        var table = $('#table-details').DataTable({
            responsive: true,
            "dom": 'tp',
            'language': {
                "paginate": {
                    "first": "Inicio",
                    "last": "Fin",
                    "next": "???",
                    "previous": "???"
                }
            }
        });
    });
</script>
@endsection
