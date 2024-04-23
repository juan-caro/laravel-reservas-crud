@extends('layouts.layout')
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-lg-7">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header">
                <h4 class="text-center font-weight-light my-4"> Crear un Nuevo Usuario </h4>
            </div>
            <div class="card-body">
                {{-- FORMULARIO --}}
                @isset($usuario)
                    <form method="POST" action="{{route('usuarios.update', ['usuario' => $usuario->id])}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                @else
                    <form method="POST" action="{{ route('usuarios.store') }}" enctype="multipart/form-data">
                        @csrf
                @endisset

                    <div class="row ">
                        <div class="mb-3 col-md-6">
                            <label for="username" class="form-label">Nombre de usuario</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ old('username', isset($usuario) ? $usuario->username : '') }}">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', isset($usuario) ? $usuario->name : '') }}">

                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email"
                            value="{{ old('email', isset($usuario) ? $usuario->email : '') }}">

                        </div>

                    </div>

                    @isset($usuario)

                    @else
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    value="{{ old('password', isset($usuario) ? $usuario->password : '') }}">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="confirm_password" class="form-label">Confirmar Contraseña</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                                    value="{{ old('confirm_password', isset($usuario) ? $usuario->password : '') }}">
                            </div>
                        </div>

                    @endisset

                    @isset($usuario)
                        <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                    @else
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    @endisset
                </form>

                {{-- Muestra los errores de validación --}}
                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
