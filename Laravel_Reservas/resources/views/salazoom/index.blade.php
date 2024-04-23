@extends('layouts.layout')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Salas de Zoom</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Salas de Zoom</li>
    </ol>
    <div>
        <a href="/salazoom/create" class="btn btn-success mb-4 fs-6"> + Nueva Sala </a>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Salas de Zoom
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Código</th>
                        <th class="d-flex justify-content-end">Acciones</th>

                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th class="d-flex justify-content-end">Acciones</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($salas as $sala)
                        <tr>
                            <td>{{$sala->nombre}}</td>
                            <td class="mx-lg-2">{{$sala->codigo}}</td>

                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium" role="group" aria-label="Botones">
                                <div class="d-flex justify-content-end">
                                    <div class="btn-group">
                                        <a href="/salazoom/{{ $sala->id }}/edit" class="btn btn-primary fs-6" style="margin-right: 5px">Editar</a>

                                        <button type="button" class="btn btn-danger fs-6" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{$sala->id}}">Eliminar</button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="confirmDeleteModal{{$sala->id}}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmación de Eliminación</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Estás seguro de que deseas eliminar esta sala?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <form id="deleteForm" method="POST" action="/salazoom/{{$sala->id}}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                                        </form>
                                                    </div>
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
