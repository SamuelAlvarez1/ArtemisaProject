@extends('layouts.panel')

@section('styles')

@endsection

@section('title-nav')
    @if ($states == '1')
        Usuarios
    @else
        Usuarios no activos
    @endif
@endsection

@section('main-content')

<div class="card">
    <div class="card-header">
        <div class="row row-cols-3 mx-auto">
            <div class="col my-2">
                <strong>Usuarios</strong>
            </div>
            <div class="col-xl-7">

                <a href="{{url('/users/create')}}" class="btn-sm btn my-2 btn-outline-dark">Crear usuario</a>

                @if($states == '0')
                <a href="{{url('/users')}}" class="btn-sm btn my-2 btn-outline-dark">Ver usuarios activos</a>
                @endif
                @if ($states == "1")
                    <a href="{{url('/users/notActive')}}" class="btn-sm btn my-2 btn-outline-dark">Ver usuarios deshabilitados</a>
                @endif

            </div>
            <div class="col-lg">
                <div class="input-group my-2">
                    <input type="text" class="form-control-sm border border-dark" id="searchInput" placeholder="Búsqueda"
                        aria-label="Recipient's username" aria-describedby="basic-addon2" title="Digite para buscar un usuario que se desee encontrar">

                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <table id="users" aria-label="users" class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th title="Ordenar por id">#</th>
                    <th title="Ordenar por nombre">Nombre</th>
                    <th title="Ordenar por apellido">Apellido</th>
                    <th title="Ordenar por correo">Correo</th>
                    <th title="Ordenar por rol">Rol</th>
                    <th title="Ordenar por teléfono">teléfono</th>
                    <th title="Ordenar por estado">Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>

                    @foreach($users as $value)

                    <tr>

                        <td>{{$value->id}}</td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->last_name}}</td>
                        <td>{{$value->email}}</td>
                        <td><a class="text-dark" href="{{url('/roles/'.$value->idRol)}}"><u>{{$value->rol}}</u></a></td>
                        <td>{{$value->phone}}</td>
                        <td>
                            @if($value->state == 1)
                                <span class="badge badge-success">Activo</span>
                            @else
                                <span class="badge badge-danger">No activo</span>
                            @endif

                        </td>

                        <td>
                            <a class="mx-2" title="Detalles de este usuario" href="{{url('/users/'.$value->id)}}"><i class="fa-solid text-dark fa-info-circle"></i></a>
                            <a class="mx-2" title="Editar este usuario" href="{{url('/users/'.$value->id . '/edit')}}"><i
                                    class="fa text-dark fa-edit"></i></a>

                            @if ($value->idRol != 1)

                            @if($value->state == 1)
                                <a class="mx-2" title="Desactivar este usuario" href="{{url('/users/updateState/'.$value->id)}}/0"><i
                                        class="fa text-dark fa-ban"></i></a>
                            @else
                                <a class="mx-2" title="Activar este usuario" href="{{url('/users/updateState/'.$value->id)}}/1"><i
                                        class="fa text-dark fa-check"></i></a>
                            @endif

                            @endif




                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

            <div class="d-flex justify-content-end">
                {{-- {{ $users->links() }} --}}
            </div>
        </div>
    </div>
</div>


@endsection


@section('scripts')
                <script>
                    $(document).ready(function () {
                        var table = $('#users').DataTable({
                            responsive:true,
                            "dom": 'tp',
                            responsive: true,
                            'language': {
                                "paginate": {
                                    "first": "Inicio",
                                    "last": "Fin",
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
