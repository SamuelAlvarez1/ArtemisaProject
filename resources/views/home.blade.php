@extends('layouts.panel')

@section('title-nav')
    Dashboard
@endsection

@section('main-content')
    <div class="container">
        <div class="row mb-5">
             <div class="col-md-4">
                <div class="card-counter bg-warning text-dark ">
                    <i class="fa-solid fa-pizza-slice"></i>

                        @if(empty($plate))
                            <span class="count-numbers text-white" style="font-size: 20px">No hay un plato destacado aún</span>
                    @else
                        <span class="count-numbers text-white" style="font-size: 20px">{{$plate->name}}</span>
                    @endif
                    <span class="count-name">Platillo destacado</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-counter danger text-dark">
                    <i class="fa fa-users"></i>
                    <span class="count-numbers text-white">{{$countSales}}</span>
                    <span class="count-name">Ventas de hoy</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-counter info text-dark">
                    <i class="fa-solid fa-calendar"></i>
                    <span class="count-numbers text-white">{{$countBookings}}</span>
                    <span class="count-name">Reservas de hoy</span>
                </div>
            </div>


        </div>
        <br>

<div class="row mb-5">
     <button class="btn btn-outline-dark" id="buttonMonth" onclick="mostrarMeses()">Ver ventas y reservas del año</button>
     <button class="btn btn-outline-dark" id="buttonWeek" onclick="mostrarSemana()">Ver ventas y reservas de la semana</button>
</div>

        <div class="row ">
            <div class="col-6" id="SalesMonth">
            </div>
            <div class="col-6" id="BookingsMonth">
            </div>
            <div class="col-6" id="SalesWeek">
            </div>
            <div class="col-6" id="BookingsWeek">
            </div>
        </div>
<div class="row mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h2>Clientes más frecuentes</h2>
                <div class="card-body">
                    <table class="table table-striped m-auto" style="width: 30rem">
                        <thead class="thead-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Número de ventas</th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                        @foreach($customers as $customer)
                        <tr>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->sales}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>

    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>


    <script>
        $('#SalesWeek').hide();
        $('#BookingsWeek').hide();
        $('#buttonMonth').hide();
        function mostrarMeses(){
            $('#SalesWeek').hide();
            $('#BookingsWeek').hide();
            $('#SalesMonth').show();
            $('#BookingsMonth').show();
            $('#buttonMonth').hide();
            $('#buttonWeek').show();
        }
        function mostrarSemana(){
            $('#SalesWeek').show();
            $('#BookingsWeek').show();
            $('#SalesMonth').hide();
            $('#BookingsMonth').hide();
            $('#buttonMonth').show();
            $('#buttonWeek').hide();
        }

        Highcharts.chart('SalesMonth', {
            chart: {
                type: 'areaspline'
            },
            title: {
                text: 'Ventas del año'
            },

            xAxis: {
                categories: ['Ene','Feb', 'Mar','Abr','May','Jun','Jul','Agt','Sep','Oct','Nov','Dic'],


            },
            yAxis: {
                title: {
                    text: 'Número de ventas del año'
                }
            },
            tooltip: {
                shared: true,
            },
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            enabled: false
                        }
                    }
                }]
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                areaspline: {
                    fillOpacity: 0.5
                }
            },
            series: [{
                name: 'Ventas',
                data: <?php echo json_encode($salesData); ?>,
            }]
        });

        Highcharts.chart('BookingsMonth', {
            chart: {
                type: 'areaspline'
            },
            color: {
                linearGradient: { x1: 0, x2: 0, y1: 0, y2: 1 },
                stops: [
                    [0, '#003399'],
                    [1, '#3366AA']
                ]
            },
            title: {
                text: 'Reservas del año'
            },

            xAxis: {
                categories: ['Ene','Feb', 'Mar','Abr','May','Jun','Jul','Agt','Sep','Oct','Nov','Dic'],


            },
            yAxis: {
                title: {
                    text: 'Número de reservas del año'
                }
            },
            tooltip: {
                shared: true,
            },
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            enabled: false
                        }
                    }
                }]
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                areaspline: {
                    fillOpacity: 0.5
                }
            },
            series: [
                {
                    name: 'Reservas',
                    data: <?php echo json_encode($bookingsData); ?>
                }]
        });

        Highcharts.chart('SalesWeek', {
            chart: {
                type: 'areaspline',
                background: '#000'
            },
            title: {
                text: 'Ventas de la semana'
            },

            xAxis: {
                categories: [
                    'Lunes',
                    'Martes',
                    'Miercoles',
                    'Jueves',
                    'Viernes',
                    'Sabado',
                    'Domingo'
                ],
                plotBands: [{ // visualize the weekend
                    from: 4.5,
                    to: 6.5,
                    color: 'rgba(234,75,75,0.2)'
                }]
            },
            yAxis: {
                title: {
                    text: 'Número de ventas y reservas de la semana'
                }
            },

            series: [{
                name: 'Ventas',
                data: <?php echo json_encode($salesDataWeek); ?>,
            }]
        });

        Highcharts.chart('BookingsWeek', {
            chart: {
                type: 'areaspline'
            },
            title: {
                text: 'Reservas de la semana'
            },

            xAxis: {
                categories: [
                    'Lunes',
                    'Martes',
                    'Miercoles',
                    'Jueves',
                    'Viernes',
                    'Sabado',
                    'Domingo'
                ],
                plotBands: [{ // visualize the weekend
                    from: 4.5,
                    to: 6.5,
                    color: 'rgba(234,75,75,0.2)'
                }]
            },
            yAxis: {
                title: {
                    text: 'Número de reservas de la semana'
                }
            },

            series: [{
                name: 'Reservas',
                data: <?php echo json_encode($bookingsDataWeek); ?>,
            }]
        });
    </script>
@endsection

