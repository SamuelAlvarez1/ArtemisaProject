@extends('layouts.panel')

@section('styles')
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/datatables.min.css">
    <link rel="stylesheet" href="/css/alertify.min.css" />
    <link rel="stylesheet" href="/css/themes/bootstrap.css" />

@endsection

@section('main-content')

    <div class="d-flex justify-content-center">
        <a href="plates/create"class="btn btn-primary">Crear platillo</a>
        <a href="plates/verCanceladas"class="btn btn-danger ">Ver canceladas</a>
        <a href="plates/verAprobadas"class="btn btn-success ">Ver aprobadas</a>
    </div>
    <table class="table table-bordered table-striped" id="plates">
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

        $('#plates').DataTable({
            processing: true,
            language: spanish,
            serverSide: true,
            ajax: '/plates/listar/enProceso',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'nombreCliente', name: 'nombreCliente'},
                {data: 'nombreEvento', name: 'nombreEvento'},
                {data: 'cantidad_personas', name: 'cantidad_personas'},
                {data: 'estado', name: 'estado'},
                {data: 'fecha_inicio', name: 'fecha_inicio'},
                {data: 'fecha_fin', name: 'fecha_fin'},
                {data: 'acciones', name: 'acciones', orderable: false, searchable: false},
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
