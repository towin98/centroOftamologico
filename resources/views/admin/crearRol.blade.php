@extends('layouts.app')
@section('crearRol')

<div class="content-wrapper">

   <div class="container-fluid pl-5 pr-5">
        <!-- Button trigger modal -->
        <div class="pt-2 pb-2 position-relative">
            <div class="position-absolute" style="
            left: 0;
            right: 0;
            text-align: center;">
                <h2>Crear rol</h2>
            </div>
       
            <div class="position-relative">
                <button type="button" class="btn btn-primary" id="crearRol"
                    {{-- data-toggle="modal" data-target="#modalCrearRol" --}}>
                    Crear nuevo Rol
                </button>
            </div>
        </div>

        <div class="table-responsive-sm mt-2">
            <table class="table table-striped"">
                <thead>
                <tr>
                    <th scope=" col">Nombre Rol</th>
                <th scope="col">Permisos</th>
                <th scope="col">Acción</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $rol)
       
                    <tr>
                        <th>{{$rol->name}}</th>
                        <td>{{  implode(', ',$rol->permissions->pluck('name')->toArray())}}</th>
                        <td>
                            <button type="button" id="btnEliminarRol" class="btn btn-danger"
                                data-id="{{$rol->id}}">Borrar</button>
                            <button type="button" id="btn-editar-rol" class="btn btn-success"
                                data-id="{{$rol->id}}">Editar</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
   </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalCrearRol" tabindex="-1" role="dialog" aria-labelledby="modalCrearRolLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCrearRolLabel">Crear nuevo Rol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCrearRol">
                    <input type="hidden" name="id-rol" id="id-rol">
                    <div id="put"></div>

                    <div class="form-group">
                        <label for="name"><strong>Nombre Rol</strong></label>
                        <input type="text" class="form-control" name="name" id="name"
                            placeholder="Ingrese nombre de rol" required>
                    </div>

                    <h6 class="text-center">
                        <strong> Marque o desmarque los permisos que desea asignar al nuevo Rol</strong>
                    </h6>
                    <div class="form-check ">
                        <input class="form-check-input" type="checkbox" name="permission_id[]" value="1" id="create">
                        <label class="form-check-label" for="create">
                            create
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="permission_id[]" value="2" id="edit">
                        <label class="form-check-label" for="edit">
                            edit
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="permission_id[]" value="3" id="delete">
                        <label class="form-check-label" for="delete">
                            delete
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="permission_id[]" value="4" id="view">
                        <label class="form-check-label" for="view">
                            view
                        </label>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" id="saverol" class="btn btn-primary">Guardar Rol</button>
                        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts_Crear_Rol')
<script src="{{ asset('js/crearRol.js') }} "></script>
@endsection