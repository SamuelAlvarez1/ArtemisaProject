@extends('layouts.panel')

@section('styles')


@endsection

@section('main-content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col d-flex justify-content-center">
                    <strong>Detalles de platillo</strong>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-5">
                <div class="col-4">
                    <div class="row"><h2>Nombre</h2></div>
                    <div class="row"><p>{{$plates->name}}</p></div>
                </div>
                <div class="col-4 ">
                    <div class="row"><h2>Precio base</h2></div>
                    <div class="row"><p>${{$plates->basePrice}}</p></div>
                </div>
                <div class="col-4 ">
                    <div class="row"><h2>Estado</h2></div>
                    <div class="row">
                        @if($plates->state == 1)
                            <span class="badge badge-success">Activo</span>
                        @else
                            <span class="badge badge-danger">No activo</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="table-responsive text-center w-80 m-auto">
                <table id="variations" class="table table-bordered">
                    <thead class="text-dark">
                    <tr>
                        <th>Variación</th>
                        <th>Precio adicional</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($variations as $variation)

                        <tr>
                            <td>{{$variation->variation}}</td>
                            <td>{{$variation-> price}}</td>
                            <td>{{$variation-> description}}</td>
                            <td>
                            @if($variation->state = 1)
            <a class="btn btn-dark"  href="{{url('plates/updateStateVariation/'.$variation->id)}}" style="width: 35px; height: 35px; display: flex;margin: auto; justify-content: center"><i class="fas fa-trash"></i></a>
            </td>
            @else
            <td>
            <a class="btn btn-dark"  href="{{url('plates/updateStateVariation/'.$variation->id)}}" style="width: 35px; height: 35px; display: flex;margin: auto; justify-content: center"><i class="fas fa-check"></i></a>
            @endif    
        </td>
            

                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <a href="{{url('plates')}}" class="btn btn-outline-danger mb-4">
                Volver
            </a>
        </div>
    </div>



@endsection


@section('scripts')
    <script>
        $(document).ready(function () {
            var table = $('#plates').DataTable({
                "dom": 't'
            });
        });
    </script>



@endsection
