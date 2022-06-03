
@extends('layouts.panel')


@section('title-nav')
    Detalles del platillo
@endsection

@section('main-content')
    <div class="col-md-10 mx-auto my-2">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h2>Detalles del platillo</h2>
                    </div>
                    <div class="col text-right">
                        <a href="{{url('/plates/'.$plates->id.'/edit')}}" class="btn mt-2 btn-sm btn-outline-warning">
                            Editar este platillo
                        </a>
                        <a href="{{url()->previous()}}" class="btn btn-sm mt-2 btn-outline-danger">
                            Regresar
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="row mb-5">
                    <div class="col">
                        <div class="row"><h2>Nombre</h2></div>
                        <div class="row"><p>{{$plates->name}}</p></div>
                    </div>
                    <div class="col">
                        <div class="row"><h2>Precio base</h2></div>
                        <div class="row"><p>$ {{number_format($plates->price, 2)}}</p></div>
                    </div>

                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="row"><h2>Ventas con este platillo</h2></div>
                        <div class="row">
                            <p>{{$platesSalesCount}}</p>
                        </div>
                    </div>
                    <div class="col">
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
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <h2>Imagen</h2>

                        </div>
                        <div class="row">
                            @if($plates->image == null)
                                <span class="badge badge-danger">Sin imagen <i class="fas fa-image"></i></span>
                            @else
                                <button type="button" class="bg-transparent d-block m-auto border-0" data-toggle="modal"
                                        data-target=".bd-image-modal-lg">
                                    <img src="/uploads/{{$plates->image}}" width="250px" alt="Imagen no disponible"
                                         style="border-radius: 10px">
                                </button>
                                <div class="modal fade bd-image-modal-lg" tabindex="-1" role="dialog"
                                     aria-labelledby="imageModal" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel">Imagen</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <img class="align-self-center mb-4 details-img" src="/uploads/{{$plates->image}}"
                                                 alt="Imagen no disponible">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection


@section('scripts')
    <script>

    </script>
@endsection
