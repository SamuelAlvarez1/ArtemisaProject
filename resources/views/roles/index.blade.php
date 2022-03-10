@extends('layouts.panel')

@section('styles')
<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/datatables.min.css">
<link rel="stylesheet" href="/css/alertify.min.css" />
<link rel="stylesheet" href="/css/themes/bootstrap.css" />
@endsection


@section('main-content')
    <div class="d-flex justify-content-center">
        <a href="roles/create"class="btn btn-primary mx-4">Crear rol</a>
        <a href="roles/verDeshabilitados"class="btn btn-danger ">Ver deshabilitados</a>
    </div>
    
    <table id="roles" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Descripcion</th>
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
    $('#roles').DataTable({
   processing: true,
   language: spanish,
   serverSide: true,
   ajax: '/roles/listar/habilitados',
   columns: [
       {data: 'id', name: 'id'},
       {data: 'name', name: 'name'},
       {data: 'description', name: 'description'},
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
