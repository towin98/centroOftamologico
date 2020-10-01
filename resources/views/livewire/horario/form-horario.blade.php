<div class="col-sm-3">
    <label for="dia_turno">Ingrese fecha asignar turno</label>
    <input type="date" wire:model="fechaHorario" name="dia_turno" id="dia_turno" class="form-control"
        placeholder="Ingrese fecha asignar turno">
    @error('fechaHorario')
    <span class="badge badge-danger"> {{ $message }} </span>
    @enderror
</div>
<div class="col-sm-3">
    <label for="hora_inicio">Hora de ingresa turno</label>
    <input type="time" wire:model="hora_inicio" name="hora_inicio" id="hora_inicio"
        class="form-control">
    @error('hora_inicio')
    <span class="badge badge-danger"> {{ $message }} </span>
    @enderror
</div>
<div class="col-sm-2">
    <label for="hora_fin">Hora finaliza turno</label>
    <input type="time" wire:model="hora_fin" name="hora_fin" id="hora_fin" class="form-control">
    @error('hora_fin')
    <span class="badge badge-danger"> {{ $message }} </span>
    @enderror
</div>
<div class="col-sm-2">
    <label for="Noconsultorio">Consultorio</label>
    <select name="Noconsultorio" wire:model="consultorio" class="form-control">
        <option>Seleccione</option>
        @foreach ($consultorios as $consultorio)
        <option value=" {{ $consultorio->id }} ">{{ $consultorio->nombre }}</option>
        @endforeach
    </select>
    @error('consultorio')
    <span class="badge badge-danger"> {{ $message }} </span>
    @enderror

</div>