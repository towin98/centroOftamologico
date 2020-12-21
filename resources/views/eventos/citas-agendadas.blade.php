@extends('layouts.app')
@section('link')
    <link rel="stylesheet" href="{{ asset('fullcalendar/main.css') }}">
@endsection
@section('citas-agendadas')

    <div class="content-wrapper" id="contenido-">
        <div class="container" style="width: 90%">
            <form id="formFiltro" class="form-row was-validated">
                <div class="col-md-3">
                    <label for="startDate">Desde</label>
                    <input type="date" id="startDate" name="startDate" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="endDate">Hasta</label>
                    <input type="date" id="endDate" name="endDate" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label for="nameMedico">Medico</label>
                    <select class="custom-select" id="nameMedico" name="idMedico" required>
                        <option value="">Seleccione</option>
                        @foreach ($medicos as $medico)
                            <option value=" {{ $medico->id }} "> {{ $medico->name }} {{ $medico->lastname }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex flex-row justify-content-center align-items-center">
                    <button type="button" class="btn btn-primary mt-3" id="btnBuscar">Buscar</button>
                </div>
            </form>
        </div>

        <div class="mx-auto calendar" id='calendar'></div>
    </div>

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="exampleModalLabel">Detalles de la cita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <table class="pull-left col-md-8 table">
                            <tbody>
                                <tr>
                                    <td class="h6"><strong>Nombre del Paciente:</strong></td>
                                    <td> </td>
                                    <td class="h6" id="namePaciente"></td>
                                </tr>

                                <tr>
                                    <td class="h6"><strong>Motivo de atencion:</strong></td>
                                    <td> </td>
                                    <td class="h6" id="title"></td>
                                </tr>

                                <tr>
                                    <td class="h6"><strong>Fecha cita:</strong></td>
                                    <td> </td>
                                    <td class="h6" id="fechaCita"></td>
                                </tr>

                                <tr>
                                    <td class="h6"><strong>Hora de la cita:</strong></td>
                                    <td> </td>
                                    <td class="h6" id="horaCita"></td>
                                </tr>

                                <tr>
                                    <td class="h6"><strong>Consultorio:</strong></td>
                                    <td> </td>
                                    <td class="h6" id="consultorio"></td>
                                </tr>

                                <tr>
                                    <td class="h6"><strong>EPS:</strong></td>
                                    <td> </td>
                                    <td class="h6" id="eps"></td>
                                </tr>

                                <tr>
                                    <td class="h6"><strong>Descripción:</strong></td>
                                    <td> </td>
                                    <td id="descripcion"></td>
                                </tr>

                                <tr>
                                    <td class="h6"><strong>Orden:</strong></td>
                                    <td> </td>
                                    <td id="orden"> <button data-toggle="modal" class="btn btn-link"
                                            data-target="#staticBackdrop" id="verDocumento">ver Documento</button></td>

                                </tr>
                            </tbody>
                        </table>

                        <div class="col-md-4">
                            <div class="d-flex justify-content-center">
                                <img src="" id="photoPaciente" alt="teste" class="img-thumbnail">
                            </div>
                            <div id="estadoCita" class="mt-4 alert " role="alert">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnAsistio" class="btn btn-success">Paciente asistió a la cita</button>
                        <button type="button" id="btnNoAsistio" class="btn btn-danger">Paciente no asistió</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- fim Modal-->

    <!-- Modal -->
    <div class="modal fade bd-example-modal-xl" id="staticBackdrop" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Orden</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="hiddenModal">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <iframe id="verOrden" src="" width="100%" height="680px"></iframe>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('fullcalendar/main.js') }}"></script>
    <script src="{{ asset('fullcalendar/lib/locales-all.js') }}"></script>
    <script src="js/citasFiltroCalendar.js"></script>
@endsection
