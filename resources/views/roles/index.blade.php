@extends('layouts.panel')

@section('styles')

@endsection


@section('main-content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-3">
                <strong>Roles</strong>
            </div>
            <div class="col-5">

                <a href="{{url('/roles/create')}}" class="btn mx-2 btn-outline-dark">crear rol</a>

                @if($states == '0')
                <a href="{{url('/roles')}}" class="btn btn-outline-dark">Ver roles activos</a>
                @endif
                @if ($states == "1")
                    <a href="{{url('/roles/notActive')}}" class="btn btn-outline-dark">Ver roles deshabilitados</a>
                @endif        
                
            </div>
            <div class="col-4">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="searchInput" placeholder="Busqueda"
                           aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-dark" id="searchButton" type="button">Buscar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive mb-3 text-center">
            <table id="roles" class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th>Id</th>
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
                            <a class="mx-2" href="{{url('/roles/updateState/'.$value->id)}}"><i
                                    class="fa-solid text-dark fa-magnifying-glass"></i></a>
                            <a class="mx-2" href="{{url('/roles/updateState/'.$value->id)}}"><i
                                    class="fa text-dark fa-edit"></i></a>
                            @if($value->state == 1)
                                <a class="mx-2" href="{{url('/roles/updateState/'.$value->id)}}/0"><i
                                        class="fa text-dark fa-ban"></i></a>
                            @else
                                <a class="mx-2" href="{{url('/roles/updateState/'.$value->id)}}/1"><i
                                        class="fa text-dark fa-check"></i></a>
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
                            "dom": 't'
                        });

                        $('#searchButton').on('keyup click', function () {
                            table.search($('#searchInput').val()).draw();
                        });
                    });
                </script>



@endsection