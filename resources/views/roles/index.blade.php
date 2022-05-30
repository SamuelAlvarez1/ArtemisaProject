@extends('layouts.panel')

@section('styles')

@endsection

@section('title-nav')
    @if ($states == '1')
        Roles
    @else
        Roles no activos
    @endif
@endsection

@section('main-content')

<div class="card">
    <div class="card-header">
        <div class="row mx-auto row-cols-3">
            <div class="col my-2">
                <strong>Roles</strong>
            </div>
            <div class="col-xl-7">
                <a href="{{url('/roles/create')}}" class="btn-sm btn my-2 btn-outline-dark">Crear rol</a>
                @if($states == '0')
                <a href="{{url('/roles')}}" class="btn-sm btn my-2 btn-outline-dark">Ver roles activos</a>
                @endif
                @if ($states == "1")
                    <a href="{{url('/roles/notActive')}}" class="btn-sm btn my-2 btn-outline-dark">Ver roles deshabilitados</a>
                @endif
            </div>
            <div class="col-lg">
                    <div class="input-group my-2">
                        <input type="text" class="form-control-sm border border-dark" id="searchInput" placeholder="Búsqueda"
                            aria-label="Recipient's username" aria-describedby="basic-addon2" title="Digite para buscar un rol que se desee encontrar">
                    </div>
                </div>
        </div>
    </div>
    <div class="card-body">
        <div class="mx-auto mb-3">
            <table id="roles" aria-label="roles" class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>

                @foreach($roles as $value)

                    <tr>

                        <td>{{$value->id}}</td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->description}}</td>
                        <td>
                            @if($value->state == 1)
                                <span class="badge badge-success">Activo</span>
                            @else
                                <span class="badge badge-danger">No activo</span>
                            @endif

                        </td>

                        <td>
                            <a class="mx-2" title="Detalles de este rol" href="{{url('/roles/'.$value->id)}}"><i class="fa-solid text-dark fa-info-circle"></i></a>
                            <a class="mx-2" title="Editar este rol" href="{{url('/roles/'.$value->id . '/edit')}}"><i
                                    class="fa text-dark fa-edit"></i></a>

                            @if ($value->id != 1)
                                @if($value->state == 1)
                                    <a class="mx-2" title="Desactivar este rol" href="{{url('/roles/updateState/'.$value->id)}}/0"><i
                                    class="fa text-dark fa-ban"></i></a>
                                @else
                                    <a class="mx-2" title="Activar este rol" href="{{url('/roles/updateState/'.$value->id)}}/1"><i
                                    class="fa text-dark fa-check"></i></a>
                                @endif

                            @endif


                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

            <div class="d-flex justify-content-end">
                {{-- {{ $roles->links() }} --}}
            </div>
        </div>
    </div>
</div>


@endsection


@section('scripts')
                <script>
                    $(document).ready(function () {
                        var table = $('#roles').DataTable({
                            responsive: true,
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
