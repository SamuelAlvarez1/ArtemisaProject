<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Artemisa</title>
    <link href="{{public_path('img/brand/favicon.png')}}" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="{{public_path('vendor/nucleo/css/nucleo.css')}}" rel="stylesheet" type="text/css">
    <link href="{{public_path('css/argon.css?v=1.0.0')}}" rel="stylesheet" type="text/css">
</head>
<body>
    
        <div class="d-flex justify-content-center flex-column align-items-center">
            <div class="row">
                <div class="col-12">
                    <h6 class="">
                        <b class="text-danger">Cantidad de ventas anuladas: {{$salesCanceled}}</b>
                        <b class="text-success">    Cantidad de ventas activas: {{$salesActived}}</b>
                    </h6>
                    
                </div>
            </div>
            <table class="table table-bordered mx-auto" style="width: 200px;">
                <thead class="thead-light">
                    <tr>
                        <th style="font-size: 8px !important;">#</th>
                        <th style="font-size: 8px !important;">CLIENTE</th>
                        <th style="font-size: 8px !important;">REALIZADA POR</th>
                        <th style="font-size: 8px !important;">PRECIO TOTAL</th>
                        <th style="font-size: 8px !important;">FECHA DE LA VENTA</th>
                        <th style="font-size: 8px !important;">ESTADO</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sales as $sale)
                        <tr>
                            <td style="font-size: 11px !important">{{$sale->id}}</td>
                            <td style="font-size: 11px !important">{{Str::limit($sale->customerName,8)}}</td>
                            <td style="font-size: 11px !important">{{Str::limit($sale->userName,8)}}</td>
                            <td style="font-size: 11px !important">${{number_format($sale->finalPrice)}}</td>
                            <td>{{$sale->created_at->isoFormat('D MMMM YYYY')}}</td>
                            <td style="font-size: 11px !important">
                                @if($sale->state == 0)
                            <span class="badge badge-danger" style="font-size: 11px !important">Anulada</span>
                        @endif
                        @if($sale->state == 1)
                        <span class="badge badge-success" style="font-size: 11px !important">Activa</span>
                        @endif
                            </td>
                        </tr>
                    @empty
                    <td colspan="8">Sin registros</td>
                    @endforelse
                </tbody>
            </table>
        </div>
    
    
</body>
</html>