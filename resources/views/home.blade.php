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
        </div>
        <div class="row d-grid">
{{--            <div class="col-6" id="">--}}
{{--                <h4>Platillos </h4>--}}
{{--                <canvas id="plates" width="400" height="200" ></canvas>--}}
{{--            </div>--}}
            <div class="col-6" id="">
                <h4>Reservas</h4>
                <canvas id="bookings" width="400" height="200"></canvas>
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

        {{--const platesData = <?php echo json_encode($platesData); ?>;--}}
        {{--const chartPlates = document.getElementById('plates').getContext('2d');--}}
        {{--const plates = new Chart(chartPlates, {--}}
        {{--    type: 'bar',--}}
        {{--    data: {--}}
        {{--        labels: ['Ene','Feb', 'Mar','Abr','May','Jun','Jul','Agt','Sep','Oct','Nov','Dic'],--}}
        {{--        datasets: [{--}}
        {{--            label: 'Número de ventas',--}}
        {{--            data: salesData,--}}
        {{--            backgroundColor: 'rgb(255, 99, 132)',--}}
        {{--            borderColor: 'rgb(255, 99, 132)',--}}
        {{--        }]--}}
        {{--    },--}}
        {{--    options: {--}}
        {{--        scales: {--}}
        {{--            yAxes: [{--}}
        {{--                ticks:{--}}
        {{--                    beginAtZero: true--}}
        {{--                }--}}
        {{--            }]--}}
        {{--        }--}}
        {{--    }--}}
        {{--});--}}

        const bookingsData = <?php echo json_encode($bookingsData); ?>;
        const chartBookings = document.getElementById('bookings').getContext('2d');
        const bookings = new Chart(chartBookings, {
            type: 'line',
            data: {
                labels: ['Ene','Feb', 'Mar','Abr','May','Jun','Jul','Agt','Sep','Oct','Nov','Dic'],
                datasets: [{
                    label: 'Número de ventas',
                    data: bookingsData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks:{
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endsection

