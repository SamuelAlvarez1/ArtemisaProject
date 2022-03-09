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
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{$customer->id}}</td>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->document}}</td>
                            <td>{{$customer->address}}</td>
                            <td>{{$customer->phoneNumber}}</td>
                            <td>{{$customer->state}}</td>
                            <td></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
{{--    <script src="/js/jquery-3.6.0.min.js"></script>--}}
{{--    <script src="/js/datatables.min.js"></script>--}}
{{--    <script>--}}
{{--        $('#customers').DataTable({--}}
{{--            processing: true,--}}
{{--            serverSide: true,--}}
{{--            ajax: '/customer/list',--}}
{{--            columns: [--}}
{{--                {data: 'id', name: 'id'},--}}
{{--                {data: 'name', name: 'name'},--}}
{{--                {data: 'document', name: 'document'},--}}
{{--                {data: 'address', name: 'address'},--}}
{{--                {data: 'phoneNumber', name: 'phoneNumber'},--}}
{{--                {data: 'state', name: 'state'},--}}

{{--                {data: 'edit', name: 'edit', orderable: false, searchable: false},--}}
{{--                {data: 'change', name: 'change', orderable: false, searchable: false}--}}
{{--            ],--}}
{{--            'columnDefs': [--}}
{{--                {--}}
{{--                    "targets": [0, 1, 2, 3, 4, 5, 6, 7],--}}
{{--                    "className": "text-center"--}}
{{--                }--}}
{{--            ]--}}
{{--        });--}}
{{--    </script>--}}
@endsection
