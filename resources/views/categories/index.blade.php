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

{{--                    <a href="{{url('/categories/create')}}" class="btn-sm btn mx-2 btn-outline-dark">Registrar Categoria</a>--}}
                    <button type="button" class="btn-sm btn mx-2 btn-outline-dark" data-toggle="modal" data-target="#exampleModal" data-whatever="Categoría">Registrar Categoria</button>

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

{{--    MODAL --}}

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form action="{{url('categories')}}" method="post">
                        @csrf
                        <div class="row mb-4">
                            <div class="col">
                                <label for="nameInput">Nombre de la categoría: <b class="text-danger">*</b></label>
                                <input value="{{old('name')}}" type="text" class="form-control" name="name" id="nameInput" placeholder="Categoría">
                            </div>
                        </div>

                        <div class="form-check mb-3">
                            <input type="hidden" name="state" value="0">
                            <input class="form-check-input" name="state" checked type="checkbox" value="1" id="state">
                            <label class="form-check-label" for="state">
                                Estado
                            </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')

    <script>

        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('Crear ' + recipient)
            modal.find('.modal-body input').val(recipient)
        })


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


