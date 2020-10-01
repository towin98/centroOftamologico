@extends('layouts.app')

@section('motivo-cita')

<div class="content-wrapper">

    <div class="container-fluid pl-5 pr-5">
        <div class="pt-2 pb-2 row mx-auto" style="max-width:635px">

            <div class="col-sm-6 col-lg-6">
                <button type="button" class="btn btn-primary" id="modalMotivo">
                    Agregar asunto citas oftamologicas
                </button>
            </div>
            <div class="col-sm-6 col-lg-6">
                <h2 class="text-center">ASUNTOS - cita</h2>
            </div>
        </div>

        <div class="table-responsive-sm mt-2 mx-auto d-block" style="max-width: 635px;">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr class="table-primary">
                        <th>NOMBRE ROL</th>
                        <th style="width: 100px;">EDITAR</th>
                        <th style="width: 100px;">ELIMINAR</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($motivoCitas as $motivoCita)

                    <tr>
                        <td>{{$motivoCita->nombreasunto}}</td>
                        <td>
                            <div class="d-flex flex-column">
                                <button type="button" id="btn-editar-asunto" class="btn btn-success fas fa-edit"
                                    data-id="{{$motivoCita->id}}">
                                   
                                </button>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <button type=" button" id="btnEliminarAsunto" class="btn btn-danger far fa-trash-alt"
                                    data-id="{{$motivoCita->id}}">
                                    
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $motivoCitas->links()  }}
            </div>
        </div>
    </div>
</div>

<!-- Modal motivo cita-->
<div class="modal fade" id="modalMotivoCita" tabindex="-1" role="dialog" aria-labelledby="modalMotivoCitaLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalMotivoCitaLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAsuntoCita">
                    <input type="hidden" name="id-asunto" id="id-asunto">
                    <div id="put"></div>
                    <div class="form-group">
                        <label for="nombreasunto">Nombre Asunto de cita</label>
                        <input type="text" name="nombreasunto" id="nombreasunto" class="form-control">
                    </div>

                    <div class="modal-footer">
                        <button type="submit" id="saveAsunto" class="btn btn-primary">Guardar asunto</button>
                        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
<script src="{{ asset('js/crearAsuntoCita.js') }}"></script>
@endsection