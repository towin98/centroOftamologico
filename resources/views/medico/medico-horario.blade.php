@extends('layouts.app')
@section('scripts')
    <script src="{{ asset('js/turno.js') }}"></script>
@endsection
@section('medico-horario')
<div class="content-wrapper">
    <div class="container">
        <div class="pt-2 pb-2 position-relative">
            <div class="position-absolute" style="
            left: 0;
            right: 0;
            text-align: center;">
                <h2>Horario</h2>
            </div>

            <div class="position-relative">
                <button class="btn btn-primary" data-toggle="modal" data-target="#horarioModal">
                    Crear Turno
                </button>
            </div>
        </div>


        <div class="table-responsive-sm mt-2">
            <table class="table table-light">
                <thead>
                    <tr>
                        <th>NOMBRE</th>
                        <th>DIA TURNO</th>
                        <th>HORA INICIA TURNO</th>
                        <th>HORA FINALIZA TURNO</th>
                        <th>EDITAR</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($horarios as $horario)
                    <tr>
                        <td>{{ $horario->nombre }}</td>
                        <td>{{ $horario->dia_turno }}</td>
                        <td>{{ $horario->hora_inicio }}</td>
                        <td>{{ $horario->hora_fin }} </td>

                        <td>
                            <button onclick="editar_horario({{$horario->id }})" class="btn btn-dark">
                                Editar
                            </button>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
        {{ $horarios->links() }}

    </div>
</div>



<!-- Modal horario -->
<div class="modal fade" id="horarioModal" tabindex="-1" aria-labelledby="horarioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="horarioModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-turno">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">

                        <label for="dia_turno">Ingrese fecha asignar turno</label>
                        <input type="date" name="dia_turno" id="dia_turno" class="form-control"
                            placeholder="Ingrese fecha asignar turno">
                    </div>
                    <div class="form-group">
                        <label for="hora_inicio">Hora de ingresa turno</label>
                        <input type="time" name="hora_inicio" id="hora_inicio"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="hora_fin">Hora finaliza turno</label>
                        <input type="time" name="hora_fin" id="hora_fin" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Noconsultorio">Consultorio</label>
                        <input type="text" name="Noconsultorio" id="Noconsultorio" class="form-control">
                    </div>                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection