@extends('layouts.panel')

@section('styles')


@endsection

@section('main-content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-3">
                    <strong>Platillos</strong>
                </div>
                <div class="col-6">

                    <a href="{{url('/plates/create')}}" class=" btn btn-sm mx-2 btn-outline-dark">Registrar platillo</a>

                    @if($states == 'active')

                        <a href="{{url('/plates/notActive')}}" class="btn mx-2 btn-sm mr-4 btn-outline-dark">Ver platillos
                            desactivados</a>
                    @else
                        <a href="{{url('/plates')}}" class="btn btn-sm mx-2 btn-outline-dark">Ver platillos
                            activos</a>
                    @endif
                </div>
                <div class="col-3 d-flex justify-content-center d-flex align-items-center">
                <div class="input-group">
                    <input type="text" class="form-control border border-dark" id="searchInput" placeholder="Busqueda"
                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-sm btn-outline-dark" id="searchButton" type="button">Buscar</button>
                    </div>
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
                                <a class="mx-2" href="{{url('/plates/'.$value->id)}}"><i
                                        class="fa-solid text-dark fa-magnifying-glass"></i></a>
                                <a class="mx-2" href="{{url('/plates/'.$value->id.'/edit')}}"><i
                                        class="fa text-dark fa-edit"></i></a>
                                @if($value->state == 1)
                                    <a class="mx-2" href="{{url('/plates/updateState/'.$value->id)}}"><i
                                            class="fa text-dark fa-ban"></i></a>
                                @else
                                    <a class="mx-2" href="{{url('/plates/updateState/'.$value->id)}}"><i
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
                            'language': {
                                "paginate": {
                                    "first": "Inicio",
                                    "last": "Fin",
                                    "next": "→",
                                    "previous": "←"
                                }
                            }
                        });

                        $('#searchButton').on('keyup click', function () {
                            table.search($('#searchInput').val()).draw();
                        });
                    });
                </script>



@endsection
