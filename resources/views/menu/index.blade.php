@extends('layouts.panel')

@section('styles')
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/datatables.min.css">
    <link rel="stylesheet" href="/css/alertify.min.css" />
    <link rel="stylesheet" href="/css/themes/bootstrap.css" />

@endsection

@section('main-content')

    <div class="d-flex justify-content-center">
        <a href="menu/create"class="btn btn-outline-dark">Crear platillo</a>
        <a href="menu/notActive"class="btn btn-outline-dark ">Ver deshabilitados</a>
    </div>
    <table class="table table-bordered table-striped" id="plates">
        <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Precio base</th>
{{--            <th>cantidad de variaciones</th>--}}
            <th>Estado</th>
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
            ajax: 'menu/show',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'basePrice', name: 'basePrice'},
                // {data: 'variations', name: 'variations'},
                {data: 'state', name: 'state'},
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
