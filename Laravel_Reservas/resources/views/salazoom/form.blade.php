@extends('layouts.layout')
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-lg-7">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header">
                <h4 class="text-center font-weight-light my-4"> Crear una Nueva Sala de Zoom </h4>
            </div>
            <div class="card-body">
                {{-- FORMULARIO --}}
                @isset($salazoom)

                    <form method="POST" action="{{route('salazoom.update', ['salazoom' => $salazoom->id])}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                @else
                    <form method="POST" action="{{ route('salazoom.store') }}" enctype="multipart/form-data">
                        @csrf
                @endisset

                    <div class="row ">
                        <div class="mb-3 col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', isset($salazoom) ? $salazoom->nombre : '') }}">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="codigo" class="form-label">Código</label>
                            <input type="text" class="form-control" id="codigo" name="codigo" maxlength="11"
                            value="{{ old('codigo', isset($salazoom) ? $salazoom->codigo : '') }}">

                        </div>
                    </div>

                    @isset($salazoom)
                        <button type="submit" class="btn btn-primary">Actualizar Sala</button>
                    @else
                        <button type="submit" class="btn btn-primary">Crear</button>
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
