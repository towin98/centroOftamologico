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
            <form id="form_evento" autocomplete="off">
                <div id="put"></div>
                <div class="modal-body">
                    <input type="hidden" name="id" class="form-control" id="id" placeholder="id">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <label for="medico_id">Medico</label>
                                <select class="form-control" name="medicoxsede_medico_idmedico" id="medico_id" required>
                                    <option value="">Seleccione</option>
                                    @foreach ($medico as $medic)
                                        <option value="{{$medic->id}}">{{$medic->nombres." ".$medic->apellidos  }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!----agregado---->
                            <div class="col-sm-6 col-md-6">
                                <label for="motivo_cita">Motivo de la cita</label>
                                <select class="form-control" name="title" id="motivo_cita" required>
                                    <option value="">Seleccione</option>
                                    @foreach ($motivos as $motivo)
                                    <option value="{{ $motivo->id }}">{{ $motivo->nombreasunto }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!----end agg--->
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="start">Dia de la cita:</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <p id="start_mostrar"></p>
                                <input type="hidden" class="form-control" name="start" id="start" readonly >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!----agregado---->
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="hora">Seleccione Hora:</label>
                                <select class="form-control" name="hora" id="hora" required>
                                </select>
                            </div>
                        </div>

                        <!----agregado---->

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="remiteEPS">Remite EPS</label>
                                <select class="form-control" name="remiteEPS" id="remiteEPS" required>
                                    <option value="">EPS</option>
                                    <option value="Sanitas">Sanitas</option>
                                    <option value="Comfamiliar">Comfamiliar</option>
                                    <option value="Nueva EPS">Nueva Eps</option>
                                    <option value="Comparta">Comparta</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="form-group">
                        <label for="title">Titulo:</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Titulo">
                    </div> --}}

                    <input type="hidden" class="form-control" name="end" id="end">

                    <div class="form-group">
                        <textarea name="descripcion" class="form-control" id="descripcion" cols="30"
                            rows="4" placeholder="¿Agregar algun dato mas? opcional*"></textarea>
                    </div>
                </div>


                <div class="modal-footer">
                    <button id="btn-Agregar" type="submit" class="btn btn-primary">Agregar</button>
                    <button id="btn-Modificar" type="submit" class="btn btn-warning">Modificar</button>
                    <button id="btn-Borrar" type="submit" class="btn btn-danger">Borrar</button>
                    <button id="btn-Cancelar" data-dismiss="modal" type="submit" class="btn btn-dark">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection