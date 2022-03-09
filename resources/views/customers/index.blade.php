@extends('layouts.panel')
@section('main-content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <strong>Clientes</strong>
                </div>
                <div class="col-6">
                    <a href="{{url('/customers/create')}}" class="btn btn-outline-dark">Registrar cliente</a>
                    <a href="{{url('/customers/notActive')}}" class="btn btn-outline-dark">Ver clientes desactivados</a>
                </div>
            </div>
            @include('includes.errors')
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="customers" class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>#</th>
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
