@extends('layouts.layout')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Reservas</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Reservas</li>
    </ol>
    <div>
        <a href="/reservas/create" class="btn btn-success mb-4 fs-6"> + Nueva Reserva </a>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Reservas
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Usuario</th>
                        <th scope="col">Fecha</th>
                        <th>Tipo</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Código Sipro</th>
                        <th>Estado</th>
                        <th>Nombre Sala Zoom</th>
                        <th>Código Sala Zoom</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Código Sipro</th>
                        <th>Estado</th>
                        <th>Nombre Sala Zoom</th>
                        <th>Código Sala Zoom</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($reservas as $reserva)
                        <tr>
                            <td>{{$reserva->user->username}}</td>
                            <td>{{$reserva->fecha}}</td>
                            <td>{{$reserva->tipo->tipo}}</td>
                            <td>{{$reserva->titulo}}</td>
                            <td>{{$reserva->descripcion}}</td>
                            <td>{{$reserva->codigo_sipro}}</td>
                            <td>{{$reserva->estado}}</td>
                            <td>{{$reserva->salaZoom->nombre}}</td>
                            <td>{{$reserva->salaZoom->codigo}}</td>

                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium" role="group" aria-label="Botones">
                                <div class="btn-group">
                                    <a href="/reservas/{{ $reserva->id }}/edit" class="btn btn-primary fs-6" style="margin-right: 5px">Editar</a>

                                    <button type="button" class="btn btn-danger fs-6" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{$reserva->id}}">Eliminar</button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="confirmDeleteModal{{$reserva->id}}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel{{$reserva->id}}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmación de Eliminación</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Estás seguro de que deseas eliminar esta reserva?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <form id="deleteForm" method="POST" action="/reservas/{{$reserva->id}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
