<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Artemisa</title>
    <link href="{{asset('img/brand/favicon.png')}}" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="{{asset('vendor/nucleo/css/nucleo.css')}}" rel="stylesheet">
    <link type="text/css" href="{{asset('css/argon.css?v=1.0.0')}}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-center flex-column align-items-center p-4">
            <div class="row">
                <div class="mx-2">
                    <h2 class="text-danger"><b>Cantidad de ventas anuladas: {{$salesCanceled}}</b></h2>
                </div>
                <div>
                    <h2 class="text-primary"><b>Cantidad de ventas activas: {{$salesActived}}</b></h2>
                </div>
            </div>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>CLIENTE</th>
                        <th>REALIZADA POR</th>
                        <th>PRECIO TOTAL</th>
                        <th>FECHA VENTA</th>
                        <th>ESTADO</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sales as $sale)
                        <tr>
                            <td>{{$sale->id}}</td>
                            <td>{{$sale->customerName}}</td>
                            <td>{{$sale->userName}}</td>
                            <td>{{$sale->final_price}}</td>
                            <td>{{$sale->created_at->isoFormat('dddd D MMMM YYYY, h:mm a')}}</td>
                            <td>

                                @if($sale->state == 1)
                                <span class="badge badge-success">Activa</span>
                                @else
                                <span class="badge badge-danger">Anulada</span>
                                @endif
                                
                            </td>
                        </tr>
                    @empty
                    <td colspan="8">Sin registros</td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
</body>
</html>