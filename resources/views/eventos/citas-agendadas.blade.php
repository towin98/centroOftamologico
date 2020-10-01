@extends('layouts.app')
@section('link')
<link rel="stylesheet" href="{{ asset('fullcalendar/main.css') }}">
@endsection
@section('citas-agendadas')



<div class="content-wrapper" id="contenido-">
    <div class="container" style="width: 300px;">
        <label for="nameMedico">Buscar citas por medico</label>
        <select class="form-control" name="" id="nameMedico">
            <option>Mostrando todas las citas agendadas</option>
            @foreach ($medicos as $medico)
            <option value=" {{ $medico->id }} "> {{ $medico->name }} {{ $medico->lastname }} </option>
            @endforeach
        </select>
    </div>

    <div class="mx-auto calendar" id='calendar'></div>
</div>




<!-- Modal -->
<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">Detalles de la cita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

              <div class="row">
                    <table class="pull-left col-md-8 ">
                        <tbody>
                            <tr>
                                <td class="h6"><strong>Nombre del Paciente:</strong></td>
                                <td> </td>
                                <td class="h5" id="namePaciente"></td>
                            </tr>
                            
                            <tr>
                                <td class="h6"><strong>Motivo de atencion:</strong></td>
                                <td> </td>
                                <td class="h5" id="title"></td>
                            </tr>
                  
                            <tr>
                                <td class="h6"><strong>Fecha cita:</strong></td>
                                <td> </td>
                                <td class="h5" id="fechaCita"></td>
                            </tr>
                  
                            <tr>
                                <td class="h6"><strong>Hora de la cita</strong></td>
                                <td> </td>
                                <td class="h5" id="horaCita"></td>
                            </tr>
                  
                            <tr>
                                <td class="h6"><strong>EPS</strong></td>
                                <td> </td>
                                <td class="h5" id="eps"></td>
                            </tr>   

                            <tr>
                                <td class="h6"><strong>Descripción</strong></td>
                                <td> </td>
                                <td id="descripcion"></td>
                            </tr>      
                        </tbody>
                    </table>
                  
                    <div class="col-md-4">
                        <img src="" id="photoPaciente" alt="teste" class="img-thumbnail">
                    </div>
                  
              </div>
            </div>

        </div>
    </div>
</div>
<!-- fim Modal-->


@endsection
@section('scripts')
<script src="{{ asset('fullcalendar/main.js') }}"></script>
<script src="js/citasFiltroCalendar.js"></script>

@endsection