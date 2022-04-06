@extends('layouts.panel') 
@section('main-content')

@section('styles')
    
@endsection

@if(count($errors)>0)
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="col-md-6 offset-3 mt-4">
        <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Editar usuario</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{url('users')}}" class="btn btn-sm btn-danger">
                                Regresar
                            </a>
                        </div>
                    </div>
                </div>
        <div class="card-body">
            
            <form action="{{url('/users/' . $user->id)}}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$user->id}}">
                <input type="text" class="form-control" placeholder="nombre" name="name" value="{{$user->name}}" />

                <input type="text" class="form-control mt-2" placeholder="apellidos" name="last_name"
                    value="{{$user->last_name}}" />
                <input type="text" class="form-control mt-2" placeholder="email" name="email"
                    value="{{$user->email}}" />
                <input type="text" class="form-control mt-2" placeholder="telefono" name="phone"
                    value="{{$user->phone}}" />
                <select name="idRol" id="idRol" class="form-control mt-2">
                    <option value="">seleccione el rol</option>
                    @foreach ($roles as $rol)
                    <option value="{{$rol->id}}" {{($rol->id == $user->idRol) ? 'selected' : ''}}>{{$rol->name}}</option>
                    @endforeach
                </select>
                <input type="password" class="form-control mt-2" placeholder="contraseña" name="password"
                     />
                <button type="submit" class="btn btn-primary mt-2">
                    editar usuario
                </button>
            </form>
        </div>
    </div>
</div>

@endsection