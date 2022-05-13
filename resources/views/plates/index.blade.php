@extends('layouts.panel')

@section('title-nav')
    @if ($states == 'active')
        Platillos
    @else
        Platillos no activos
    @endif
@endsection

@section('main-content')
    @if(Session::has('nameDuplicate'))
        <div class="alert alert-warning alert-dismissible" role="alert">
            <ul>
                Producto/s agredado/s a excepción de:
                @foreach(Session::get('nameDuplicate') as $namesDuplicates)
                    <li>{{$namesDuplicates}}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-3">
                    <strong>Platillos</strong>
                </div>
                <div class="col-5">

                    <a href="{{url('/plates/create')}}" class=" btn btn-sm mx-2 btn-outline-dark">Registrar platillo</a>

                    @if($states == 'active')

                        <a href="{{url('/plates/notActive')}}" class="btn mx-2 btn-sm mr-4 btn-outline-dark">Ver
                            platillos
                            desactivados</a>
                    @else
                        <a href="{{url('/plates')}}" class="btn btn-sm mx-2 btn-outline-dark">Ver platillos
                            activos</a>
                    @endif
                </div>
                <div class="col-3 offset-1 d-flex justify-content-center d-flex align-items-center">
                    <div class="input-group">
                        <input type="text" class="form-control-sm border border-dark" id="searchInput"
                               placeholder="Busqueda"
                               aria-label="Recipient's username" aria-describedby="basic-addon2">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive mb-3 text-center">
                <table id="plates" class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>Id</th>
                        <th>Categoría</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($plates as $key=>$value)

                        <tr>

                            <td>{{$value-> id}}</td>
                            <td>{{$value->categories}}</td>
                            <td>{{$value-> name}}</td>
                            <td>{{$value-> price}}</td>
                            <td>
                                @if($value->state == 1)
                                    <span class="badge badge-success">Activo</span>
                                @else
                                    <span class="badge badge-danger">No activo</span>
                                @endif

                            </td>
                            <td>
                                <a class="mx-2" data-delay="500" data-toggle="tooltip" data-placement="bottom"
                                   title="Detalles" href="{{url('/plates/'.$value->id)}}"><i
                                        class="fa-solid text-dark fa-info-circle"></i></a>
                                <a class="mx-2" data-delay="500" data-toggle="tooltip" data-placement="bottom" title="Editar" href="{{url('/plates/'.$value->id.'/edit')}}"><i
                                        class="fa text-dark fa-edit"></i></a>
                                @if($value->state == 1)
                                    <a class="mx-2" data-delay="500" data-toggle="tooltip" data-placement="bottom" title="Desactivar" href="{{url('/plates/updateState/'.$value->id)}}"><i
                                            class="fa text-dark fa-ban"></i></a>
                                @else
                                    <a class="mx-2" data-delay="500" data-toggle="tooltip" data-placement="bottom" title="Activar" href="{{url('/plates/updateState/'.$value->id)}}"><i
                                            class="fa text-dark fa-check"></i></a>
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
            var table = $('#plates').DataTable({
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
