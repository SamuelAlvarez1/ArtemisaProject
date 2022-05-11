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
                <div class="col">
                    <strong>Clientes</strong>
                </div>
                <div class="col">
                    <a href="{{url('/customers/create')}}" class="btn-sm btn m-2 btn-outline-dark">Registrar cliente</a>
                    @if($states == 'active')
                        <a href="{{url('/customers/notActive')}}" class="btn-sm btn m-2 mr-4 btn-outline-dark">Ver clientes
                            desactivados</a>
                    @else
                        <a href="{{url('/customers')}}" class="btn-sm btn m-2 btn-outline-dark">Ver clientes
                            activos</a>
                    @endif
                </div>
                <div class="col">
                    <div class="input-group m-2">
                        <input type="text" class="form-control-sm border border-dark float-right" id="searchInput" placeholder="Busqueda"
                               aria-label="Recipient's username" aria-describedby="basic-addon2">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="mx-auto mb-3">
                <table id="customers" class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th scope="col">Acciones</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Documento</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Estado</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{$customer->id}}</td>
                            <td>
                                <a class="mx-2" data-delay="500" data-toggle="tooltip" data-placement="bottom" title="Detalles" href="{{url('/customers/'.$customer->id)}}"><i class="fa-solid text-dark fa-info-circle"></i></a>
                                <a class="mx-2" data-delay="500" data-toggle="tooltip" data-placement="bottom" title="Editar" href="{{url('/customers/'.$customer->id.'/edit')}}"><i class="fa text-dark fa-edit"></i></a>
                                @if($customer->state == 1)
                                    <a class="mx-2" data-delay="500" data-toggle="tooltip" data-placement="bottom" title="Desactivar" href="{{url('/customers/updateState/'.$customer->id)}}"><i class="fa text-dark fa-ban"></i></a>
                                @else
                                    <a class="mx-2" data-delay="500" data-toggle="tooltip" data-placement="bottom" title="Activar" href="{{url('/customers/updateState/'.$customer->id)}}"><i class="fa text-dark fa-check"></i></a>
                                @endif
                            </td>
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
                            
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div  class="d-flex justify-content-end">
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            var table = $('#customers').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true,
                "dom": 'tp',
                'language': {
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "→",
                        "previous": "←"
                    }
                }
            });
            $('#searchInput').on('keyup', function () {
                table.search($('#searchInput').val()).draw();
            });
        });
    </script>
@endsection
