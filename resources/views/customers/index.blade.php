@extends('layouts.panel')
@section('main-content')
    <div class="card">
        <div class="card-header">
            <strong>Clientes</strong>
            <a href="{{url('/customers/create')}}" class="btn btn-link">Registrar cliente</a>
            <a href="{{url('/customers/notActive')}}" class="btn btn-link">Ver clientes desactivados</a>
            @include('includes.errors')
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="customers" class="table table-flush">
                    <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Documento</th>
                        <th>Dirección</th>
                        <th>Telefono</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--table content--}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>

    </script>
@endsection
