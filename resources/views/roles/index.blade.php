@extends('layouts.app')

@section('content')



<div class="container">
    
    <div class="d-flex justify-content-center">
        <a href="roles/crear"class="btn btn-primary mx-4">Crear rol</a>
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

</div>

@endsection

@section('scripts')
<script>
    $('#roles').DataTable({
   processing: true,
   language: spanish,
   serverSide: true,
   ajax: '/roles/listar/habilitados',
   columns: [
       {data: 'id', name: 'id'},
       {data: 'nombre', name: 'nombre'},
       {data: 'descripcion', name: 'descripcion'},
       {data: 'estado', name: 'estado'},
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
