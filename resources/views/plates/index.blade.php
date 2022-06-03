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
            <div class="row max-auto row-cols-3">
                <div class="col my-2">
                    <strong>Platillos</strong>
                </div>
                <div class="col-xl-7">

                    <a href="{{url('/plates/create')}}" class=" btn btn-sm my-2 btn-outline-dark">Registrar platillo</a>

                    @if($states == 'active')

                        <a href="{{url('/plates/notActive')}}" class="btn my-2 btn-sm mr-4 btn-outline-dark">Ver
                            platillos
                            desactivados</a>
                    @else
                        <a href="{{url('/plates')}}" class="btn btn-sm my-2 btn-outline-dark">Ver platillos
                            activos</a>
                    @endif
                </div>
                <div class="col-lg">
                    <div class="input-group my-2">
                        <input type="text" class="form-control-sm border border-dark" id="searchInput"
                               placeholder="Búsqueda"
                               aria-label="Recipient's username" aria-describedby="basic-addon2">

                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="mx-auto mb-3">
                <table id="plates" aria-label="plates" class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($plates as $key=>$value)

                        <tr>

                            <td>{{$value->id}}</td>
                            <td>{{$value->name}}</td>
                            <td><a class="text-dark" href="{{url('/categories/'.$value->idCategory)}}"><u>{{$value->categories}}</u></a></td>
                            <td>$ {{ number_format($value->price, 2)}}</td>
                            <td>
                                @if($value->state == 1)
                                    <span class="badge badge-success">Activo</span>
                                @else
                                    <span class="badge badge-danger">No activo</span>
                                @endif

                            </td>
                            <td>
                                <a class="mx-2"
                                   title="Ver la información de este platillo" href="{{url('/plates/'.$value->id)}}"><i
                                        class="fa-solid text-dark fa-info-circle"></i></a>
                                <a class="mx-2" title="Editar este platillo" href="{{url('/plates/'.$value->id.'/edit')}}"><i
                                        class="fa text-dark fa-edit"></i></a>
                                @if($value->state == 1)
                                    <a class="mx-2" title="Desactivar este platillo" href="{{url('/plates/updateState/'.$value->id)}}"><i
                                            class="fa text-dark fa-ban"></i></a>
                                @else
                                    <a class="mx-2" title="Activar este platillo" href="{{url('/plates/updateState/'.$value->id)}}"><i
                                            class="fa text-dark fa-check"></i></a>
                                @endif

                                @if($value->image != '')
                                    <a class="mx-2" data-delay="500" data-toggle="tooltip" data-placement="bottom" title="Eliminar Imagen" href="{{url('/plates/deleteImage/'.$value->id)}}">
                                        <img src="/img/icons/image.png" style="width: 18px; margin-top: -3px" alt="quitarimagen"></a>
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
                responsive:true,
                "dom": 'tp',
                responsive: true,
                'language': spanish,
                
            });

            $('#searchInput').on('keyup', function () {
                table.search($('#searchInput').val()).draw();
            });
        });
    </script>



@endsection
