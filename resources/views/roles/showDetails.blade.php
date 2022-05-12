
  
    @extends('layouts.panel')


@section('title-nav')
    Detalles del rol
@endsection

@section('main-content')

    <div class="col-md-7 offset-2 my-2">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col text-right">
                        <a href="{{url('/roles/'.$rol->id.'/edit')}}" class="btn btn-sm btn-warning">
                            Editar esta rol
                        </a>
                        <a href="{{url('/roles')}}" class="btn btn-sm btn-danger">
                            Regresar
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body d-block m-auto text-center">
                <h4 class="card-subtitle mt-2">Nombre del rol</h4>
                <p class="card-text">{{$rol->name}}</p>
                <h4 class="card-subtitle mt-2 mb-3">Descripción</h4>
                <p class="card-text">{{$rol->description}}</p>
                <h4 class="card-subtitle mt-2">Estado</h4>
                @if ($rol->state == 0)
                    <span class="badge badge-danger">No activo</span>
                @else
                    <span class="badge badge-success">Activo</span>
                @endif
            </div>


        </div>


@endsection

  


