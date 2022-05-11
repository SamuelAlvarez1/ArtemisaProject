@extends('layouts.panel')

@section('title-nav')
Perfil del usuario {{$user->name}}
@endsection

@section('main-content')
<div class="row d-flex justify-content-center">
    <div class="col-4">
        <div class="card">
            <div class="card-header d-flex justify-content-center" style="position: relative">
                <div style="width: 120px; height: 120px; background: #e2dede; border-radius: 80px;"
                    class="d-flex justify-content-center align-items-center">
                    <i class="fa-solid fa-user" style="font-size: 4rem"></i>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <span style="font-size: 1.5rem"><b>{{$user->name}} {{$user->last_name}}</b></span>
                </div>
                <div class="d-flex justify-content-center">
                    <span style="font-size: 1.2rem">Email: <b>{{$user->email}}</b></span>
                </div>
                <div class="d-flex justify-content-center">
                    <span style="font-size: 1.2rem">Número: <b>{{$user->phone}}</b></span>
                </div>
                <div class="d-flex justify-content-center">
                    <span style="font-size: 1.2rem">Rol: <b>{{$user->rol}}</b></span>
                </div>
                <div class="row my-5">
                    <a class="mx-2 btn btn-sm btn-outline-warning" href="{{url('/users/'.auth()->user()->id . '/edit')}}">Editar</a>
                    <a class="mx-2 btn btn-sm btn-outline-dark" href="{{url('/users/EditPassword/'.auth()->user()->id)}}">Editar contraseña</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection