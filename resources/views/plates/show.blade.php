@extends('layouts.panel')

@section('styles')

@endsection

@section('title-nav')
    Detalles del platillo
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
                    <div class="row"><p>${{$plates->price}}</p></div>
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

    </script>
@endsection
