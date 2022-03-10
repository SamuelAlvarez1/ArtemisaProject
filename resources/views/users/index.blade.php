@extends('layouts.panel')

@section('styles')
<link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/datatables.min.css">
    <link rel="stylesheet" href="/css/alertify.min.css" />
    <link rel="stylesheet" href="/css/themes/bootstrap.css" />
    
@endsection

@section('main-content')

    <div class="d-flex justify-content-center">
        <a href="users/create"class="btn btn-primary mx-4">Crear usuario</a>
        <a href="usuarios/verDeshabilitados"class="btn btn-danger ">Ver deshabilitados</a>
    </div>
    <table class="table table-bordered table-striped" id="usuarios">
        <thead>
            <tr>
                <th>Id</th>
                <th>Apellidos</th>
                <th>Nombres</th>
                <th>Correo</th>
                <th>Estado</th>
                <th>Télefono</th>
                <th>Rol</th>
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
    
    $('#usuarios').DataTable({
   processing: true,
   language: spanish,
   serverSide: true,
   ajax: '/usuarios/listar/habilitados',
   columns: [
       {data: 'id', name: 'id'},
       {data: 'last_name', name: 'last_name'},
       {data: 'name', name: 'name'},
       {data: 'email', name: 'email'},
       {data: 'state', name: 'state'},
       {data: 'phone', name: 'phone'},
       {data: 'rol', name: 'rol'},
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