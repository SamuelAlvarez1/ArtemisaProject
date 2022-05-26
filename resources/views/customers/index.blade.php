@extends('layouts.panel')
@section('title-nav')
    @if ($states == 'active')
        Clientes
    @else
       Clientes no activos
    @endif
@endsection
@section('main-content')
    <div class="card">
        <div class="card-header">
            <div class="row mx-auto row-cols-3">
                <div class="col my-2">
                    <strong>Clientes</strong>
                </div>
                <div class="col-xl-7">
                    <a href="{{url('/customers/create')}}" class="btn-sm btn my-2 btn-outline-dark">Registrar cliente</a>
                    @if($states == 'active')
                        <a href="{{url('/customers/notActive')}}" class="btn-sm btn my-2 mr-4 btn-outline-dark">Ver clientes
                            desactivados</a>
                    @else
                        <a href="{{url('/customers')}}" class="btn-sm btn my-2 btn-outline-dark">Ver clientes
                            activos</a>
                    @endif
                </div>
                <div class="col-lg">
                    <div class="input-group my-2">
                        <input type="text" class="form-control-sm border border-dark float-right" id="searchInput" placeholder="Busqueda"
                               aria-label="Recipient's username" aria-describedby="basic-addon2">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="mx-auto mb-3">
                <table id="customers" class="table table-bordered" aria-label="Clientes">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col" title="Ordenar por orden de creación">#</th>
                        <th scope="col" title="Ordenar por dirección">Dirección</th>
                        <th scope="col" title="Ordenar por nombre">Nombre</th>
                        <th scope="col" title="Ordenar por documento">Documento</th>
                        <th scope="col" title="Ordenar por teléfono">Teléfono</th>
                        <th scope="col" title="Ordenar por Estado">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{$customer->id}}</td>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->document}}</td>
                            <td>{{Str::limit($customer->address, 20)}}</td>
                            <td>{{$customer->phoneNumber}}</td>
                            <td>
                                @if($customer->state == 1)
                                    <span class="badge badge-success">Activo</span>
                                @else
                                    <span class="badge badge-danger">No activo</span>
                                @endif
                            </td>
                            <td>
                                <a class="mx-2" title="Ver más información del cliente" href="{{url('/customers/'.$customer->id)}}"><i aria-hidden="true" class="fa-solid text-dark fa-info-circle"></i></a>
                                <a class="mx-2" title="Editar información del cliente" href="{{url('/customers/'.$customer->id.'/edit')}}"><i aria-hidden="true" class="fa text-dark fa-edit"></i></a>
                                @if($customer->state == 1)
                                    <a class="mx-2" title="Desactivar el cliente" href="{{url('/customers/updateState/'.$customer->id)}}"><i aria-hidden="true" class="fa text-dark fa-ban"></i></a>
                                @else
                                    <a class="mx-2" title="Activar el cliente" href="{{url('/customers/updateState/'.$customer->id)}}"><i aria-hidden="true" class="fa text-dark fa-check"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            var table = $('#customers').DataTable({
                responsive: true,
                "dom": 'tp',
                'language': {
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "→",
                        "previous": "←"
                        },
                    "emptyTable": "No hay información disponible."
                }
            });
            $('#searchInput').on('keyup', function () {
                table.search($('#searchInput').val()).draw();
            });
        });
    </script>
@endsection
