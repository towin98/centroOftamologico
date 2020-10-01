@extends('layouts.app')

@section('asignarRolUser')

<div class="content-wrapper">
    <div class="container-fluid pl-5 pr-5">
        <div class="pt-2 pb-2">
            <h2 class="text-center">Asignar roles</h2>
        </div>
        <div class="table-responsive-sm">
            <table class="table table-bordered table-striped">
                <thead>
                <tr class="table-primary">
                    <th scope=" col">Nombre usuario</th>
                    <th scope="col">Email</th>
                    <th scope="col">Rol asignado</th>
                    <th scope="col">Acción</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
        
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</th>
                        <td>{{implode (', ',$user->getRoleNames()->toArray())}}</th>
                        <td>
                            <button class="btn btn-primary" id="cambiarRolBtn" 
                        onclick="asignarRol({{ $user->id }},'{{ implode (', ',$user->getRoleNames()->toArray()) }}')" 
                            data-toggle="modal" data-target="#modalAsignarRol">Cambiar Rol</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalAsignarRol" tabindex="-1" role="dialog" aria-labelledby="modalAsignarRolLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAsignarRolLabel">Asignar Rol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAsignarRol">
                    <h6 class="text-center">
                        <strong> Seleccione el Rol que desea que tenga un Usuario</strong>
                    </h6>
                    <input type="hidden" name="id" id="idUser">
                    <input type="hidden" name="rolAnterior" id="rolAnterior">
                    <div class="form-group">
                        <select class="form-control" name="name" id="name">       
                        </select> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveAsignarRol">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts_Asginar_Rol')
    <script src="{{ asset('js/asignarRol.js') }}"></script>
@endsection