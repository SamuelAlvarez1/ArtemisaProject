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
                        <b class="text-danger">Cantidad de reservas canceladas: {{$bookingsCanceled}}</b>
                        <b class="text-primary">    Cantidad de reservas en proceso: {{$bookingsInProcess}}</b>
                        <b class="text-success">    Cantidad de reservas aprobadas: {{$bookingsApproved}}</b>
                    </h6>
                    
                </div>
            </div>
            <table class="table table-bordered mx-auto" style="width: 200px;">
                <thead class="thead-light">
                    <tr>
                        <th style="font-size: 8px !important;">#</th>
                        <th style="font-size: 8px !important;">CLIENTE</th>
                        <th style="font-size: 8px !important;">EVENTO</th>
                        <th style="font-size: 8px !important;">CANTIDAD DE <br>PERSONAS</th>
                        <th style="font-size: 8px !important;">Realizada por</th>
                        <th style="font-size: 8px !important;">ESTADO</th>
                        <th style="font-size: 8px !important;">Fecha de <br> la reserva</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $booking)
                        <tr>
                            <td style="font-size: 11px !important">{{$booking->id}}</td>
                            <td style="font-size: 11px !important">{{Str::limit($booking->customerName,8)}}</td>
                            <td style="font-size: 11px !important">
                                @if ($booking->idEvent != null)
                                {{Str::limit($booking->eventName,8)}}
                                @else
                                    Sin evento
                                @endif
                            </td>
                            <td style="font-size: 11px !important">{{$booking->amount_people}}</td>
                            <td style="font-size: 11px !important">{{Str::limit($booking->user,8)}}</td>
                            <td style="font-size: 11px !important">
                                @if($booking->idState == 1)
                            <span class="badge badge-danger" style="font-size: 11px !important">{{$booking->stateName}}</span>
                        @endif
                        @if($booking->idState ==2)
                            <span class="badge badge-primary" style="font-size: 11px !important">{{$booking->stateName}}</span>
                        @endif
                        @if($booking->idState == 3)
                        
                            <span class="badge badge-success" style="font-size: 11px !important">{{$booking->stateName}}</span>

                        @endif
                            </td>

                            <td style="font-size: 11px !important">{{$booking->start_date->isoFormat('D MMMM YYYY')}}</td>
                            
                        </tr>
                    @empty
                    <td colspan="8">Sin registros</td>
                    @endforelse
                </tbody>
            </table>
        </div>
    
    
</body>
</html>