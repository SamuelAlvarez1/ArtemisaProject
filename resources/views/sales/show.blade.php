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
        <div class="row mb-5 row-cols-2">
            <div class="col">
                <div class="row d-block">
                    <div class="row">
                        <h2>Cliente</h2>
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
                    <div class="row"> <h2>Hecha por:</h2></div>
                    <div class="row"> <p>{{$sale-> userName}}</p></div>
                </div>
            </div>
            <div class="col">
                <div class="row d-block mb-4">
                    <div class="row">
                        <h2>Estado</h2>
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
                    <div class="row"> <h2><span
                        class=""
                        style="border: none"
                        >Precio total:</span></h2></div>
                    <div class="row"><b class="text-success"
                        >$</b
                    >&ensp; <p>{{$sale-> finalPrice}}</p></div>
                </div>   
            </div>
        </div>
        <div class="row">
            <div class="col-9 offset-0">
            <table class="table table-striped table-responsive ">
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
                 @foreach ($saleDetail as $value)
                        <tr>
                            <td>{{$value-> id}}</td>
                            <td>
                                @if ($value->idPlate == 1)
                                {{$value-> description}}</td>
                                @else
                                {{$value-> namePlate}}</td>
                                @endif
                            
                            <td>{{$value-> quantity}}</td>
                            <td>{{$value-> platePrice}}</td>
                            <td>{{($value-> quantity * $value->platePrice)}}</td>
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

</script>
@endsection