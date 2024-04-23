@extends('layouts.layout')
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-lg-7">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header">
                <h4 class="text-center font-weight-light my-4"> Crear una Nueva Reserva </h4>
            </div>
            <div class="card-body">
                {{-- FORMULARIO --}}
                @isset($reserva)
                    <form method="POST" action="{{route('reservas.update', ['reserva' => $reserva->id])}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                @else
                    <form method="POST" action="{{ route('reservas.store') }}" enctype="multipart/form-data">
                        @csrf
                @endisset

                    <div class="row ">
                        <div class="mb-3 col-md-6">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo', isset($reserva) ? $reserva->titulo : '') }}">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="codigo_sipro" class="form-label">Código Sipro</label>
                            <input type="text" class="form-control" id="codigo_sipro" name="codigo_sipro" maxlength="10"
                            value="{{ old('codigo_sipro', isset($reserva) ? $reserva->codigo_sipro : '') }}">

                        </div>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="descripcion" class="form-label">Descripción</label>

                        <textarea class="form-control" id="descripcion" name="descripcion">{{ old('descripcion', isset($reserva) ? $reserva->descripcion : '') }}</textarea>

                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                                @if(!old('fecha'))
                                    @isset($reserva)
                                        @php

                                                // Obtener la fecha del valor old o de $reserva->fecha
                                                $fechaCompleta = old('fecha', $reserva->fecha);


                                                // Crear un objeto Carbon a partir de la fecha completa
                                                $carbon = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $fechaCompleta);

                                                // Obtener la parte de la fecha y la hora por separado
                                                $fecha = $carbon ? $carbon->toDateString() : null;
                                                $hora = $carbon ? $carbon->format('H:i') : null;
                                        @endphp
                                    @endisset
                                @else
                                    @php

                                        $fecha = old('fecha');
                                        $hora = old('hora');

                                    @endphp
                                @endif
                                <label for="fecha" class="form-label">Fecha de reserva</label>
                                <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha', isset($reserva) ? $fecha : '') }}">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="hora" class="form-label">Hora de reserva</label>
                            <input type="time" class="form-control" id="hora" name="hora" value="{{ old('hora', isset($reserva) ? $hora : '') }}">
                        </div>

                    </div>

                    <div class="row">
                        <div>
                            <div>
                                <label for="tipo" class="form-label">Tipo</label>
                            </div>
                            @php
                                $tipos_reserva = \App\Models\Tipo::all();
                            @endphp
                            @foreach ($tipos_reserva as $tipo)
                                    <input type="radio" value="{{ $tipo->id }}" name="tipo_id"
                                    {{ old('tipo_id', isset($reserva) ? $reserva->tipo_id : null) == $tipo->id ? 'checked' : '' }}>
                                    {{ $tipo->tipo }}

                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="sala" class="form-label">Sala de Zoom</label>
                            <select class="form-select mb-" name="sala_zoom_id">
                                <option value="">Selecciona la Sala de Zoom</option>
                                @php
                                    $salas_zoom = \App\Models\SalaZoom::all();
                                @endphp
                                @foreach ($salas_zoom as $sala)
                                <option value="{{ $sala->id }}"
                                    {{ old('sala_zoom_id', isset($reserva) ? $reserva->sala_zoom_id : null) == $sala->id ? 'selected' : '' }}>
                                    {{ $sala->nombre }}
                                </option>

                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-3">
                            <label for="users" class="form-label">Usuario</label>
                            <select class="form-select mb-" name="user_id">
                                <option value="">Selecciona el Usuario</option>
                                @auth
                                    @if (!isset($reserva))
                                        @php
                                            $user = Auth::user();
                                        @endphp
                                        <option value="{{ $user->id }}" selected>{{ $user->username }}</option>
                                    @endif
                                @endauth

                                @php $usuarios = \App\Models\User::all(); @endphp
                                @foreach ($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}"
                                        {{ old('user_id', isset($reserva) ? $reserva->user_id : null) == $usuario->id ? 'selected' : '' }}>
                                        {{ $usuario->username }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    @isset($reserva)
                        <button type="submit" class="btn btn-primary">Actualizar Reserva</button>
                    @else
                        <button type="submit" class="btn btn-primary">Reservar</button>
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
