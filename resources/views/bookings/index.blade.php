@extends('layouts.panel')

@section('styles')
<link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/datatables.min.css">
    <link rel="stylesheet" href="/css/alertify.min.css" />
    <link rel="stylesheet" href="/css/themes/bootstrap.css" />
    
@endsection

@section('main-content')

    <div class="d-flex justify-content-center">
        <a href="bookings/create"class="btn btn-primary">Crear reserva</a>
        <a href="reservas/verCanceladas"class="btn btn-danger ">Ver canceladas</a>
        <a href="reservas/verAprobadas"class="btn btn-success ">Ver aprobadas</a>
    </div>
    <table class="table table-bordered table-striped" id="reservas">
        <thead>
            <tr>
                <th>Id</th>
                <th>Cliente</th>
                <th>Evento</th>
                <th>cantidad de personas</th>
                <th>Estado</th>
                <th>fecha inicio</th>
                <th>fecha fin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        
        </tbody>
    </table>

@endsection


@section('scripts')
<script src="/js/jquery-3.6.0.min.js"></script>
<script src="/js/datatables.min.js"></script>
<script src="/js/alertify.min.js"></script>
<script>
    
    $('#reservas').DataTable({
   processing: true,
   language: spanish,
   serverSide: true,
   ajax: '/reservas/listar/enProceso',
   columns: [
       {data: 'id', name: 'id'},
       {data: 'customerName', name: 'customerName'},
       {data: 'eventName', name: 'eventName'},
       {data: 'amount_people', name: 'amount_people'},
       {data: 'state', name: 'state'},
       {data: 'start_date', name: 'start_date'},
       {data: 'final_date', name: 'final_date'},
       {data: 'actions', name: 'actions', orderable: false, searchable: false},
   ]
});
</script>

@if (Session::has('success'))
    <script>
    alertify.set('notifier','position', 'top-right');
    alertify.success('{{Session::get('success')}}');        
 
    </script>
@endif


@if (Session::has('edit'))
    <script>
    alertify.set('notifier','position', 'top-right');
    alertify.warning('{{Session::get('edit')}}');        
 
    </script>
@endif


@if (Session::has('error'))
    <script>
    alertify.set('notifier','position', 'top-right');
    alertify.error('{{Session::get('error')}}');        
 
    </script>
@endif


@endsection