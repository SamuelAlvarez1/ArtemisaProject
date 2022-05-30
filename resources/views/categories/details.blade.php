@extends('layouts.panel')


@section('title-nav')
    Detalles de la categoría
@endsection

@section('main-content')

    <div class="col-md-7 offset-2 my-2">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col text-right">
                        <a href="{{url('/categories/'.$category->id.'/edit')}}" class="btn btn-sm btn-outline-warning">
                            Editar esta categoría
                        </a>
                        <a href="{{url()->previous()}}" class="btn btn-sm btn-outline-danger">
                            Regresar
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-5 text-center">
                    <div class="col">
                        <h4 class="mt-2">Nombre de la categoría</h4>
                        <p class="card-text">{{$category->name}}</p>
                    </div>

                    <div class="col">
                        <h4 class="card-subtitle mt-2">Estado</h4>
                        @if ($category->state == 0)
                            <span class="badge badge-danger">No activo</span>
                        @else
                            <span class="badge badge-success">Activo</span>
                        @endif
                    </div>
                </div>


                <div class="row">

                    <div class="col">
                        <h4 class="mb-3 text-center">Platillos con esta categoría</h4>

                        <table class="table" id="plates">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Platillo</th>
                                <th scope="col">Precio</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(sizeof($plates) > 0)
                                @foreach ($plates as $plate)
                                    <tr>
                                        <td><a class="text-dark" href="{{url('/plates/'. $plate->id)}}"><u>{{$plate->name}}</u></a></td>
                                        <td>${{number_format($plate->price)}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="2" class="text-center">
                                        Sin información
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
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
