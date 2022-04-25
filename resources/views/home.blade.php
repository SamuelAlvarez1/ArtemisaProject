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
        <form action="{{route('home')}}" method="post">
<div class="row mb-5">
     <div class="col-12 col-md-3">
         <span>Fecha inicial</span>
         <div class="form-group">
             <input type="date" class="form-control" value="{{old('fecha_ini')}}" name="fecha_ini" id="fecha_ini">
         </div>
     </div>
    <div class="col-12 col-md-3">
         <span>Fecha Final</span>
         <div class="form-group">
             <input type="date" class="form-control" value="{{old('fecha_fin')}}" name="fecha_fin" id="fecha_fin">
         </div>
     </div>
</div>
        </form>
        <div class="row ">
            <div class="col-12" id="graficaMes">
            </div>
            <div class="col-12" id="graficaSemana">
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
        $('#graficaSemana').hide();
        function mostrarMeses(){
            $('#graficaSemana').hide();
            $('#graficaMes').show();
        }
        function mostrarSemana(){
            $('#graficaMes').hide();
            $('#graficaSemana').show();
        }

        Highcharts.chart('graficaMes', {
            chart: {
                type: 'areaspline'
            },
            title: {
                text: 'Ventas y reservas del año'
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                verticalAlign: 'top',
                x: 150,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor:
                    Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF'
            },
            xAxis: {
                categories: ['Ene','Feb', 'Mar','Abr','May','Jun','Jul','Agt','Sep','Oct','Nov','Dic'],


            },
            yAxis: {
                title: {
                    text: 'Número de ventas y reservas del año'
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
            },
                {
                    name: 'Reservas',
                    data: <?php echo json_encode($bookingsData); ?>
                }]
        });

        Highcharts.chart('graficaSemana', {
            chart: {
                type: 'areaspline'
            },
            title: {
                text: 'Ventas y reservas de la semana'
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                verticalAlign: 'top',
                x: 150,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor:
                    Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF'
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
            tooltip: {
                shared: true,
                valueSuffix: ''
            },
            series: [{
                name: 'Ventas',
                data: [0, 0, 0, 0, 0, 0, 0]
            }, {
                name: 'Reservas',
                data: [0, 0, 0, 0, 0, 0, 0]
            }]
        });
    </script>
@endsection

