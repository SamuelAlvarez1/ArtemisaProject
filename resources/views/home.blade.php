@extends('layouts.panel')
@section('main-content')
    <div class="container">
        <div class="row mb-5">
             <div class="col-md-4">
                <div class="card-counter bg-warning text-light ">
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
                <div class="card-counter danger">
                    <i class="fa fa-users"></i>
                    <span class="count-numbers">{{$countSales}}</span>
                    <span class="count-name">Ventas de hoy</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-counter info">
                    <i class="fa-solid fa-calendar"></i>
                    <span class="count-numbers">{{$countBookings}}</span>
                    <span class="count-name">Reservas de hoy</span>
                </div>
            </div>


        </div>

        <div class="row mb-5 d-grid">
            <div class="col-6" id="sales">
            </div>
            <div class="col-6" id="bookings">
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

        const salesData = <?php echo json_encode($salesData); ?>;
        Highcharts.chart('sales', {
            chart: {
                type: 'areaspline'
            },
            title: {
                text: 'Ventas del año'
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
                    text: 'Número de ventas'
                }
            },
            tooltip: {
                shared: true,
                valueSuffix: ' units'
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
                data: salesData,
            }]
        });

        const bookingsData = <?php echo json_encode($bookingsData); ?>;
        Highcharts.chart('bookings', {
            chart: {
                type: 'areaspline'
            },
            title: {
                text: 'reservas del año'
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
                    text: 'Número de reservas'
                }
            },
            tooltip: {
                shared: true,
                valueSuffix: ' units'
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
                name: 'Reservas',
                data: bookingsData,
            }]
        });
    </script>
@endsection

