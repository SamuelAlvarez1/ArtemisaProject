@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-center">
        <a href="usuarios/crear"class="btn btn-primary mx-4">Crear usuario</a>
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
</div>
@endsection


@section('scripts')
<script>
    $('#usuarios').DataTable({
   processing: true,
   language: spanish,
   serverSide: true,
   ajax: '/usuarios/listar/habilitados',
   columns: [
       {data: 'id', name: 'id'},
       {data: 'apellido', name: 'apellido'},
       {data: 'name', name: 'name'},
       {data: 'email', name: 'email'},
       {data: 'estado', name: 'estado'},
       {data: 'telefono', name: 'telefono'},
       {data: 'rol', name: 'rol'},
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