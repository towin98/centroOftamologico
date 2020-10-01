@extends('layouts.app')
@section('consultorios')

<div class="content-wrapper">
    <div class="container-fluid pl-5 pr-5">
        <div class="pt-2 pb-2 row">

            <div class="col-sm-6 col-lg-6">
                <!-- Button trigger modal -->
                <button type="button" id="modal" class="btn btn-primary">
                    CREAR CONSULTORIO
                </button>
            </div>
            <div class="col-sm-6 col-lg-6">
                <h2>Listando de medicos</h2>
            </div>
        </div>

        <div class="table-responsive-sm mt-2">
            <table class="table table-bordered mb-5">
                <thead>
                    <tr class="table-success">
                        <th>NOMBRE</th>
                        <th>DESCRIPCION</th>
                        <th style="width: 10px;">EDITAR</td>
                        <th style="width: 10px;">BORRAR</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($consultorios as $consultorio)
                    <tr>
                        <td>{{ $consultorio->nombre }}</td>
                        <td>{{ $consultorio->descripcion }}</td>
                        <td>
                            <button class="btn btn-success fas fa-edit" id="btn-editar-consultorio" data-id="{{ $consultorio->id }}"></button>
                        </td>
                        <td>
                            <button class="far fa-trash-alt btn btn-danger" id="btn-eliminar-consultorio" id="btn-eliminar-consultorio" data-id="{{ $consultorio->id }}"></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $consultorios->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Modal consultorio-->
<div class="modal fade" id="consultorioModal" tabindex="-1" aria-labelledby="consultorioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="consultorioModalLabel">Crear consultorio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-consultorio">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id-consultorio">
                    <div id="put"></div>
                    <div class="form-group">
                        <input type="text" name="nombre" id="nombre-consultorio" class="form-control" placeholder="Nombre o codigo del consultorio">
                    </div>
                    <div class="form-group">
                        <textarea name="descripcion" id="descripcion" class="form-control"
                            placeholder="OPCIONAL : alguna nota"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" id="btn-guardar-consultorio" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
    <script src=" {{ asset('js/consultorio.js') }} "></script>
@endsection
@endsection