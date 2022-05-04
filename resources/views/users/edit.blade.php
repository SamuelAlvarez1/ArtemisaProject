@extends('layouts.panel') 
@section('main-content')

@section('styles')
    
@endsection

@section('title-nav')
    Editar usuario
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

                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombres') }}<b class="text-danger">*</b></label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="nombre" name="name" value="{{$user->name}}" />

                        
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Apellidos') }}<b class="text-danger">*</b></label>

                    <div class="col-md-6">
                       
                        <input type="text" class="form-control mt-2" placeholder="apellidos" name="last_name"
                        value="{{$user->last_name}}" />
                        
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Correo') }}<b class="text-danger">*</b></label>

                    <div class="col-md-6">
                       
                        <input type="text" class="form-control mt-2" placeholder="email" name="email"
                    value="{{$user->email}}" />
                        
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Celular') }}<b class="text-danger">*</b></label>

                    <div class="col-md-6">
                       
                        <input type="text" class="form-control mt-2" placeholder="telefono" name="phone"
                    value="{{$user->phone}}" />
                        
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary mt-2">
                    Editar usuario
                </button>
            </form>
        </div>
    </div>
</div>

@endsection