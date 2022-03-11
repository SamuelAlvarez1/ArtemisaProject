@extends('layouts.panel')
@section('main-content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-3">
                    <strong>Clientes</strong>
                </div>
                <div class="col-5">

                    <a href="{{url('/customers/create')}}" class=" btn mx-2 btn-outline-dark">Registrar cliente</a>

                    @if($states == 'active')

                        <a href="{{url('/customers/notActive')}}" class="btn mx-2 mr-4 btn-outline-dark">Ver clientes
                            desactivados</a>
                    @else
                        <a href="{{url('/customers')}}" class="btn mx-2 btn-outline-dark">Ver clientes
                            activos</a>
                    @endif
                </div>
                <div class="col-4">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="searchInput" placeholder="Busqueda"
                               aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-dark" id="searchButton" type="button">Buscar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive mb-3 text-center">
                <table id="customers" class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Documento</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
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
                            <td>
                                @if($customer->state == 1)
                                    <span class="badge badge-success">Activo</span>
                                @else
                                    <span class="badge badge-danger">No activo</span>
                                @endif

                            </td>
                            <td>
                                <a class="mx-2" href="{{url('/customers/updateState/'.$customer->id)}}"><i class="fa-solid text-dark fa-magnifying-glass"></i></a>
                                <a class="mx-2" href="{{url('/customers/updateState/'.$customer->id)}}"><i class="fa text-dark fa-edit"></i></a>
                                @if($customer->state == 1)
                                    <a class="mx-2" href="{{url('/customers/updateState/'.$customer->id)}}"><i class="fa text-dark fa-ban"></i></a>
                                @else
                                    <a class="mx-2" href="{{url('/customers/updateState/'.$customer->id)}}"><i class="fa text-dark fa-check"></i></a>
                                @endif


                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{ $customers->links() }}
            </div>

        </div>
    </div>
@endsection
@section('scripts')

    <script>
        $(document).ready(function () {
            var table = $('#customers').DataTable({
                "dom": 't'
            });

            $('#searchButton').on('keyup click', function () {
                table.search($('#searchInput').val()).draw();
            });
        });
    </script>
@endsection
