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
        <button class="btn btn-outline-dark" id="buttonMonth" onclick="mostrarMeses()">Ver ventas y reservas del
            año</button>
        <button class="btn btn-outline-dark" id="buttonWeek" onclick="mostrarSemana()">Ver ventas y reservas de la
            semana</button>
    </div>

<div class="row row-cols-2" id="Month">
    <div class="col" id="SMonth"></div>
    <div class="col" id="BMonth"></div>
</div>

<div class="row row-cols-2" id="Week">
    <div class="col" id="SWeek"></div>
    <div class="col" id="BWeek"></div>
 </div>

    <div class="row my-4">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Platos más vendidos</h3>
                        </div>
                        <div class="col text-right">
                            <a href="#!" class="btn btn-sm btn-outline-dark">Ver todos</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Número de ventas</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach($plates as $plate)
                            <tr>
                                <td>{{$plate->name}}</td>
                                <td>{{$plate->quantity}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Clientes frecuentes</h3>
                        </div>
                        <div class="col text-right">
                            <a href="#!" class="btn btn-sm btn-outline-dark">Ver todos</a>
                        </div>
                     </div>
                </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Número de ventas</th>
                                </tr>
                            </thead>
                            <tbody>
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


    $(document).ready(function(){
        $('#Week').hide();
    $('#Month').show();
    $('#buttonMonth').hide();
    $('#buttonWeek').show();
    });

function mostrarMeses() {
    $('#Week').hide();
    $('#Month').show();
    $('#buttonMonth').hide();
    $('#buttonWeek').show();
}

function mostrarSemana() {
    $('#Month').hide();
    $('#Week').show();
    $('#buttonMonth').show();
    $('#buttonWeek').hide();
}

Highcharts.chart('SMonth', {
    chart: {

        type: 'area'
    },
    title: {
        text: 'Ventas Anuales'
    },

    xAxis: {
        categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agt', 'Sep', 'Oct', 'Nov', 'Dic'],
        crosshair: true

    },
    yAxis: {
        title: {
            text: 'Número de ventas'
        }
    },

    tooltip: {
        shared: true,
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Ventas',
        data: <?php echo json_encode($salesData); ?>,
    }]
});

Highcharts.chart('BMonth', {
    chart: {

        type: 'area'
    },
    title: {
        text: 'Reservas anuales'
    },

    xAxis: {
        categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agt', 'Sep', 'Oct', 'Nov', 'Dic'],
        crosshair: true

    },
    yAxis: {
        title: {
            text: 'Número de reservas'
        }
    },

    tooltip: {
        shared: true,
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Reservas',
        data: <?php echo json_encode($bookingsData);?>,
    }]
});


Highcharts.chart('SWeek', {
    chart: {
        type: 'area',
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
        }],
        crosshair: true
    },
    yAxis: {
        title: {
            text: 'Número de ventas'
        }
    },

    tooltip: {

        shared: true,

    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },

    series: [{
        name: 'Ventas',
        data: <?php echo json_encode($salesDataWeek); ?>,
    }]
});

Highcharts.chart('BWeek', {
        chart: {
            type: 'area',
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
            }],
            crosshair: true
        },
        yAxis: {
            title: {
                text: 'Número de reservas'
            }
        },

        tooltip: {

            shared: true,

        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },

        series: [
            {
                name: 'Reservas',
                data: <?php echo json_encode($bookingsDataWeek); ?>,
            }]
    });



</script>
@endsection
