@extends('layouts.panel')

@section('title-nav','Mensajes')

@section('main-content')
    <div class="card">
        <div class="card-header">
            <div class="row mx-auto row-cols-2">
                <div class="col my-2">
                    <strong>Mensajes</strong>
                </div>
                <div class="col-lg">
                    <div class="input-group my-2">
                        <input type="text" class="form-control-sm border border-dark" id="searchInput" placeholder="Busqueda"
                               aria-label="Recipient's username" aria-describedby="basic-addon2">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="mx-auto mb-3">
                <table id="messages" class="table table-bordered" aria-label="Mensajes">
                    <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Mensaje</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--table content--}}
                    @foreach($messages as $message)
                        <tr>
                            <td>{{$message->id}}</td>
                            <td>{{Str::limit($message->name, 15)}}</td>
                            <td>{{Str::limit($message->email, 30)}}</td>
                            <td>{{Str::limit($message->message, 30)}}</td>
                            <td>
                                @if($message->read == 1)
                                    <span class="badge badge-success">Leído</span>
                                @else
                                    <span class="badge badge-danger">Sin leer</span>
                                @endif
                            </td>
                            <td>
                                <a class="mx-2" title="Ver más información" href="{{url('/contact/'.$message->id)}}"><em
                                        class="fa-solid text-dark fa-info-circle"></em></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endsection
        @section('scripts')
            <script>
                $(document).ready(function () {
                    var table = $('#messages').DataTable({
                        responsive: true,
                        "dom": 'tp',
                        'language': spanish
                    });
                    $('#searchInput').on('keyup', function () {
                        table.search($('#searchInput').val()).draw();
                    });
                });
            </script>
@endsection
