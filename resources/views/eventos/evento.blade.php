@extends('layouts.app')

@section('link')

<link rel="stylesheet" href="{{ asset('fullcalendar/main.css') }}">

@endsection


@section('scripts')

<script src="{{ asset('fullcalendar/main.js') }}"></script>
<script src="{{ asset('js/calendario.js') }}"></script>


@endsection



@section('content')

<!-------medicos card--->
<div class="content-wrapper" id="contenido-">
    <div class="mx-auto calendar" id='calendar'></div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">Agendar Cita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_evento" autocomplete="off" enctype="multipart/form-data">
                <div id="put"></div>
                <div class="modal-body">
                    <input type="hidden" name="id" class="form-control" id="id">

                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="motivo_cita">Motivo de la cita</label>
                                <select class="form-control" name="title" id="motivo_cita" required>
                                    <option value="">Seleccione</option>
                                    @foreach ($motivos as $motivo)
                                    <option value="{{ $motivo->id }}">{{ $motivo->nombreasunto }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!----agregado---->
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="medico_id">Medico</label>
                                <select class="form-control" name="medico" id="medico_id" required>
                                    <option value="">Seleccione motivo cita</option>
                                  {{--   @foreach ($medicos as $medico)
                                    <option value="{{$medico->id}}">{{$medico->name." ".$medico->lastname }}</option>
                                    @endforeach --}}
                                </select>
                            </div>                            
                        </div>
                        <!----end--->

                        <div class="col-sm-6 col-md-6">  
                            <label for="start">Dia de la cita:</label>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <p id="start_mostrar"></p>
                            <input type="hidden" class="form-control" name="start" id="start" readonly>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="hora">Seleccione Hora:</label>
                                <select class="form-control" name="hora" id="hora" required>
                                </select>
                            </div>
                            <div>
                                <label for="">Consultorio asistir</label>
                                <input type="text" class="form-control" name="consultorio" id="consultorio"  readonly placeholder="Consultorio al cual debe ir">
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="remiteEPS">Remite EPS</label>
                                <select class="form-control" name="remiteEPS" id="remiteEPS" required>
                                    <option value="">Seleccione EPS</option>
                                </select>
                            </div>
                            <div class="form-check">
                                <div class="form-group">
                                    <input  type="radio" name="eps" id="particular" value="1">
                                    <label class="form-check-label" for="particular">
                                        Particular
                                    </label>                                
                                    <input type="radio" name="eps" id="prepagada" value="2">
                                    <label class="form-check-label" for="prepagada">
                                        Prepagada
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="orden">Orden medica (REQUERIDO) imagen o archivo PDF</label>
                                <input type="file" name="orden" id="orden" class="form-control-file">
                                <input type="hidden" name="ordenUpdate" id="ordenUpdate" class="form-control-file">
                                <button id="verDocumento" class="btn btn-link">Ver documento</button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" name="end" id="end">

                    <div class="form-group">
                        <textarea name="descripcion" class="form-control" id="descripcion" cols="30" rows="2"
                            placeholder="¿Agregar algun dato mas? opcional*"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button id="btn-Agregar" type="submit" class="btn btn-primary">Agregar</button>
                    <button id="btn-Modificar" type="submit" class="btn btn-warning">Modificar</button>
                    <button id="btn-Borrar" type="submit" class="btn btn-danger">Borrar</button>
                    <button id="btn-Cancelar" data-dismiss="modal" type="submit" class="btn btn-dark">Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade bd-example-modal-xl" id="staticBackdrop" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Orden</h5>
                <button type="button" class="close" id="hiddenModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="verOrden" src="" width="100%" height="680px"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="hiddenModal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endsection