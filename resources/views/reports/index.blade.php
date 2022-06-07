@extends('layouts.panel')

@section('styles')
<link rel="stylesheet" href="/css/alertify.min.css" />
<link rel="stylesheet" href="/css/themes/bootstrap.css" />

@endsection

@section('title-anv')
Reportes
@endsection

@section('main-content')


<div class="d-flex justify-content-center">
    <div class="form-group col-6 mx-2">
        <label for="">Desde</label>
        <b class="text-danger">*</b>       
        <div class="input-group input-group-alternative">
            <div class="input-group-prepend">
                <span class="input-group-text"><i aria-hidden="true" class="ni ni-calendar-grid-58"></i></span>
            </div>
            <input type="text" onchange="validarFechas()"
                   class="form-control datepicker"
                   id="start-date" data-date-language="es" data-date-format="yyyy-mm-dd"
                   value="{{date("Y-m-d")}}"
                   >
            
        </div>
    </div>
    <div class="form-group col-6">
        <label for="">Hasta</label>
        <b class="text-danger">*</b>       
        <div class="input-group input-group-alternative">
            <div class="input-group-prepend">
                <span class="input-group-text"><i aria-hidden="true" class="ni ni-calendar-grid-58"></i></span>
            </div>
            <input type="text" onchange="validarFechas()"
                   class="form-control datepicker"
                   id="final-date" data-date-language="es" data-date-format="yyyy-mm-dd"
                   value="{{date("Y-m-d")}}"
                   >
        </div>
    </div>
</div>


<div class="d-flex justify-content-center mt-2">
    <div>
        <a class="btn btn-outline-primary" href="/reports/bookings/{{date("Y-m-d")}}/{{date("Y-m-d")}}" id="reports-bookings">Generar reporte de
            reservas</a>
        <a class="btn btn-outline-primary" href="/reports/sales/{{date("Y-m-d")}}/{{date("Y-m-d")}}" id="reports-sales">Generar reportes de ventas</a>
    </div>
</div>

<div id="content">
    @if ($condition == "bookings")
        <div class="d-flex justify-content-center mt-2">
            <?php echo $button ?>
        </div>
        <table class="table table-bordered mt-2">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>CLIENTE</th>
                    <th>EVENTO</th>
                    <th>CANTIDAD PERSONAS</th>
                    <th>USUARIO QUE CREO <br> LA RESERVA</th>
                    <th>ESTADO</th>
                    <th>FECHA INICIO</th>
                    <th>FECHA FIN</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                <tr>

                    <td>{{$booking->id}}</td>
                    <td>{{$booking->customerName}}</td>
                    <td>
                        @if ($booking->idEvent == null)
                        sin evento
                        @else
                        {{$booking->eventName}}
                        @endif
                    </td>
                    <td>{{$booking->amount_people}}</td>
                    
                    <td>{{$booking->user}}</td>
                    
                    <td>
                        @if($booking->idState == 1)
                            <span class="badge badge-danger">{{$booking->stateName}}</span>
                        @endif
                        @if($booking->idState ==2)
                            <span class="badge badge-primary">{{$booking->stateName}}</span>
                        @endif
                        @if($booking->idState == 3)
                        
                            <span class="badge badge-success">{{$booking->stateName}}</span>

                        @endif

                    </td>
                    <td>{{$booking->start_date->isoFormat('dddd D MMMM YYYY, h:mm a')}}</td>
                    <td>
                        @if ($booking->final_date == null)
                            Sin fecha
                        @else
                            {{$booking->final_date->isoFormat('dddd D MMMM YYYY, h:mm a')}}    
                        @endif
                    </td>
                </tr>
                @empty
                    <td colspan="8">No se encontraron registros</td>
                @endforelse
            </tbody>
        </table>
    @endif

    @if ($condition == "sales")
        <div class="d-flex justify-content-center mt-2">
            <?php echo $button ?>
        </div>
        <table class="table table-bordered mt-2">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>CLIENTE</th>
                    <th>REALIZADA POR</th>
                    <th>PRECIO TOTAL</th>
                    <th>FECHA DE LA VENTA</th>
                    <th>ESTADO</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sales as $sale)
                <tr>
                    <td>{{$sale->id}}</td>
                    <td>
                        @if ($sale->idCustomers == null)
                            Cliente de Mostrador
                        @else
                            {{$sale->customerName}}
                        @endif
                    </td>
                    <td>
                        {{$sale->userName}}
                    </td>
                    <td id="columnPrice">${{number_format($sale->finalPrice)}}</td>
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
                    <td colspan="8">No se encontraron registros</td>
                @endforelse
            </tbody>
        </table>
    @endif
</div>

@endsection


@section('scripts')

<script src="/js/alertify.min.js"></script>

<script>

    function validarFechas() {
        let startDate = $("#start-date").val();
        let finalDate = $("#final-date").val();

        if(startDate != null && finalDate != null){
            if (Date.parse(finalDate) >= Date.parse(startDate)) {
                let enlaceBookings = document.getElementById("reports-bookings");

                enlaceBookings.href = `/reports/bookings/${startDate}/${finalDate}`;

                let enlaceSales = document.getElementById("reports-sales");

                enlaceSales.href = `/reports/sales/${startDate}/${finalDate}`;
            }else{
                let enlaceBookings = document.getElementById("reports-bookings");

                enlaceBookings.href = '/reports'; 

                let enlaceSales = document.getElementById("reports-sales");

                enlaceSales.href = '/reports';
            }
        }
        
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $.fn.datepicker.dates['es'] = {
            days: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
            daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
            daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
            months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
            today: "Hoy",
            clear: "Limpiar",
            weekStart: 1
        };

        $('.datepicker').datepicker();
    </script>

@endsection