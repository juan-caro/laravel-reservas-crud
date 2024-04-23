@extends('layouts.layout')
@section('content')
<div class="col-lg-7">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
            <h4 class="text-center font-weight-light my-4"> Editar Reserva </h4>
        </div>
        <div class="card-body">
            {{-- FORMULARIO --}}
            <form method="POST" action="/reservas/{{$reserva->id}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" value="{{old('titulo', $reserva->titulo)}}">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="codigo_sipro" class="form-label">Código Sipro</label>
                        <input type="text" class="form-control" id="codigo_sipro" name="codigo_sipro" maxlength="10" value="{{old('codigo_sipro', $reserva->codigo_sipro)}}">
                    </div>
                </div>

                <div class="mb-3 col-md-12">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion">{{old('descripcion', $reserva->descripcion)}}</textarea>
                </div>

                <div class="row">
                    <div class="mb-3 col-md-2">
                        <label for="fecha" class="form-label">Fecha de reserva</label>
                        <script>
                            console.log(@json($reserva->fecha));
                        </script>

                        @php
                            // Obtener la fecha del valor old o de $reserva->fecha
                            $fechaCompleta = old('fecha', $reserva->fecha);

                            // Crear un objeto Carbon a partir de la fecha completa
                            $carbon = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $fechaCompleta);

                            // Obtener la parte de la fecha y la hora por separado
                            $fecha = $carbon ? $carbon->toDateString() : null;
                            $hora = $carbon ? $carbon->format('H:i') : null;
                        @endphp

                        <input type="date" class="form-control" id="fecha" name="fecha" value="{{ $fecha ?? ''}}">

                    </div>

                    <div class="mb-3 col-md-2">
                        <label for="hora" class="form-label">Hora de reserva</label>
                        <input type="time" class="form-control" id="hora" name="hora" value="{{ $hora ?? ''}}">
                    </div>

                </div>

                <div class="row">

                    <div class="mb-3 col-md-2">
                        <label for="tipo" class="form-label">Tipo</label>
                        @php
                            $tipos_reserva = \App\Models\Tipo::all();
                        @endphp
                        @foreach ($tipos_reserva as $tipo)
                            <div>

                                <input type="radio" value="{{ $tipo->id }}" name="tipo_id"
                                {{ old('tipo_id', isset($reserva) ? $reserva->tipo_id : null) == $tipo->id ? 'checked' : '' }}>
                                {{ $tipo->tipo }}


                            </div>

                        @endforeach
                    </div>

                    <div class="mb-3 col-md-3">
                        <label for="sala" class="form-label">Sala de Zoom</label>
                        <select class="form-select mb-" name="sala_zoom_id">
                            <option value="">Selecciona la Sala de Zoom</option>
                            @php
                                $salas_zoom = \App\Models\SalaZoom::all();
                            @endphp
                            @foreach ($salas_zoom as $sala)
                                <option value="{{ $sala->id }}" {{ old('sala_zoom_id', $reserva->sala_zoom_id) == $sala->id ? 'selected' : '' }}>{{ $sala->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 col-md-3">
                        <label for="users" class="form-label">Usuario</label>
                        <select class="form-select mb-" name="user_id">
                            <option value="">Selecciona el Usuario</option>
                            @php
                                $usuarios = \App\Models\User::all();
                            @endphp
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}" {{ old('user_id', $reserva->user_id) == $usuario->id ? 'selected' : '' }}>{{ $usuario->username }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">Actualizar Reserva</button>
            </form>

        </div>
    </div>
</div>
@endsection
