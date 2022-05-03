@extends('layouts.panel')


@section('title-nav')
    @if ($states == 'active')
        Categorias
    @else
        Categorias no activas
    @endif
@endsection

@section('main-content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-2 d-flex justify-content-center d-flex align-items-center">
                    <strong>Categorias</strong>
                </div>
                <div class="col-6 d-flex justify-content-center d-flex align-items-center">

                    <a href="{{url('/categories/create')}}" class="btn-sm btn mx-2 btn-outline-dark">Registrar Categoria</a>

                    @if($states == 'active')

                        <a href="{{url('/categories/notActive')}}" class="btn-sm btn mx-2 mr-4 btn-outline-dark">Ver categorias
                            desactivadas</a>
                    @else
                        <a href="{{url('/categories')}}" class="btn-sm btn mx-2 btn-outline-dark">Ver categorias
                            activas</a>
                    @endif
                </div>
                <div class="col-3 offset-1 d-flex justify-content-center d-flex align-items-center">
                    <div class="input-group">
                        <input type="text" class="form-control-sm border border-dark" id="searchInput" placeholder="Busqueda"
                               aria-label="Recipient's username" aria-describedby="basic-addon2">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive mb-3 text-center">
                <table id="categories" class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--table content--}}
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>
                                @if($category->state == 1)
                                    <span class="badge badge-success">Activo</span>
                                @else
                                    <span class="badge badge-danger">No activo</span>
                                @endif

                            </td>
                            <td>
                                <a class="mx-2" data-delay="500" data-toggle="tooltip" data-placement="bottom" title="Detalles" href="{{url('/categories/'.$category->id)}}"><i class="fa-solid text-dark fa-info-circle"></i></a>
                                <a class="mx-2" data-delay="500" data-toggle="tooltip" data-placement="bottom" title="Editar" href="{{url('/categories/'.$category->id.'/edit')}}"><i class="fa text-dark fa-edit"></i></a>
                                @if($category->state == 1)
                                    <a class="mx-2" data-delay="500" data-toggle="tooltip" data-placement="bottom" title="Desactivar" href="{{url('/categories/updateState/'.$category->id)}}"><i class="fa text-dark fa-ban"></i></a>
                                @else
                                    <a class="mx-2" data-delay="500" data-toggle="tooltip" data-placement="bottom" title="Activar" href="{{url('/categories/updateState/'.$category->id)}}"><i class="fa text-dark fa-check"></i></a>
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
            var table = $('#categories').DataTable({
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


