@extends('layouts.layout')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Usuarios</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Usuarios</li>
    </ol>
    <div>
        <a href="/usuarios/create" class="btn btn-success mb-4 fs-6"> + Nuevo Usuario </a>
    </div>
    <div class="card mb-4">
        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Usuarios
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nombre de usuario</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th class="d-flex justify-content-end">Acciones</th>

                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th scope="col">Nombre de usuario</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th class="d-flex justify-content-end">Acciones</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{$usuario->username}}</td>
                            <td>{{$usuario->name}}</td>
                            <td>{{$usuario->email}}</td>


                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium" role="group" aria-label="Botones">
                                <div class="d-flex justify-content-end">
                                    <div class="btn-group">
                                        <a href="/usuarios/{{ $usuario->id }}/edit" class="btn btn-primary fs-6" style="margin-right: 5px">Editar</a>

                                        <button type="button" class="btn btn-danger fs-6" style="margin-right: 5px" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{$usuario->id}}">Eliminar</button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="confirmDeleteModal{{$usuario->id}}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmación de Eliminación</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Estás seguro de que deseas eliminar este usuario?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <form id="deleteForm" method="POST" action="/usuarios/{{$usuario->id}}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-secondary fs-6" data-bs-toggle="modal" data-bs-target="#confirmChangePasswordModal{{$usuario->id}}">Cambiar Contraseña</button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="confirmChangePasswordModal{{$usuario->id}}" tabindex="-1" aria-labelledby="confirmChangePasswordModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmChangePasswordModalLabel">Cambio de contraseña</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="updatePasswordForm" method="POST" action="{{ route('usuarios.update_password', ['usuario' => $usuario->id]) }}">
                                                            @csrf
                                                            @method('PATCH')

                                                            <!-- Campos para la nueva contraseña y su confirmación -->
                                                            <input type="password" id="password" name="password" placeholder="Nueva contraseña">
                                                            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirmar nueva contraseña">

                                                            <button type="button" class="btn btn-secondary mt-5" data-bs-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-primary mt-5">Actualizar contraseña</button>
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
