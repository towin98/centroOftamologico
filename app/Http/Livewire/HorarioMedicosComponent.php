<?php

namespace App\Http\Livewire;

use App\Consultorio;
use App\Medico;
use App\Turno;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class HorarioMedicosComponent extends Component
{
    use WithPagination;
    public $view = "guardar-turno";
    public $id_Turno; //se utiliza para grabar el id de la consulta y poder editarla
    public $id_medico;
    public $fechaHorario, $hora_inicio, $hora_fin, $consultorio;

    public function render()
    {
        $medicos = DB::table('medicos')
            ->join('users', 'medicos.id_user', '=', 'users.id')
            ->select('medicos.id', 'users.name', 'users.lastname')
            ->get();
        $consultorios = Consultorio::all();

        $turnos = DB::table('turnos')
            ->join('consultorios', 'turnos.id_consultorio', '=', 'consultorios.id')
            ->where('id_medico', $this->id_medico)
            ->orderBy('dia_turno', 'desc')
            ->select('turnos.id', 'turnos.nombre', 'turnos.dia_turno', 'turnos.hora_fin', 'turnos.hora_inicio', 'consultorios.nombre as  id_consultorio')
            ->paginate(5);

        return view('livewire.horario-medicos-component', compact('medicos', 'turnos', 'consultorios'));
    }

    public function guardar()
    {
        $this->validate([
            'id_medico' => 'required',
            'fechaHorario' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'consultorio' => 'required',
        ]);

        $dias = array(
            'domingo',
            'lunes',
            'martes',
            'miércoles',
            'jueves',
            'viernes',
            'sábado',
        );
        $nombreDia = $dias[date("w", strtotime($this->fechaHorario))];
        Turno::create([
            'id_medico' => $this->id_medico,
            'nombre' => $nombreDia,
            'dia_turno' => $this->fechaHorario,
            'hora_inicio' => $this->hora_inicio,
            'hora_fin' => $this->hora_fin,
            'id_consultorio' => $this->consultorio,
        ]);
        $this->limpiarCampos();
        session()->flash('message', 'Horario creado ' . $nombreDia . ": " . $this->fechaHorario);
    }

    public function storeHorario()
    {
        $validacionTurno = Turno::where([
            'dia_turno' => $this->fechaHorario
        ])->get();

        if (count($validacionTurno) == 0) {
            return $this->guardar();
        } else {
            foreach ($validacionTurno as $turno) {
                if ($turno->id_consultorio == $this->consultorio) {
                    if (
                        $turno->hora_inicio <= $this->hora_inicio . ":00" &&
                        $turno->hora_fin >= $this->hora_inicio . ":00"
                    ) {
                        $medico = DB::table('medicos')
                        ->join('users', 'users.id', '=', 'medicos.id_user')
                        ->where('medicos.id', $turno->id_medico)
                        ->select('users.name', 'users.lastname')
                        ->first();

                        return session()->flash('Existe', 'Este horario ya esta asigando en este consultorio con el medico: '.$medico->name ." ".$medico->lastname );
                    }
                    if (
                        $turno->hora_inicio <= $this->hora_fin . ":00" &&
                        $turno->hora_fin >= $this->hora_fin . ":00"
                    ) {
                        $medico = DB::table('medicos')
                        ->join('users', 'users.id', '=', 'medicos.id_user')
                        ->where('medicos.id', $turno->id_medico)
                        ->select('users.name', 'users.lastname')
                        ->first();
                        return session()->flash('Existe', 'Este horario ya esta asigando en este consultorio con el medico: '.$medico->name ." ".$medico->lastname );
                    }
                }
            }
            return $this->guardar();
        }
    }


    public function editar_horario($id_Turno)
    {
        $this->view = "actualizar-horario";
        $turno = Turno::where('id', $id_Turno)->get();

        $this->id_Turno = $turno[0]->id;

        $this->id_medico = $turno[0]->id_medico;
        $this->fechaHorario =  $turno[0]->dia_turno;
        $this->hora_inicio =  $turno[0]->hora_inicio;
        $this->hora_fin =  $turno[0]->hora_fin;
        $this->consultorio = $turno[0]->id_consultorio;
    }

    public function updateTurno()
    {
        $this->validate([
            'id_medico' => 'required',
            'fechaHorario' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'consultorio' => 'required',
        ]);

        $dias = array(
            'domingo',
            'lunes',
            'martes',
            'miércoles',
            'jueves',
            'viernes',
            'sábado',
        );
        $nombreDia = $dias[date("w", strtotime($this->fechaHorario))];

        Turno::findOrFail($this->id_Turno)->update([
            'id_medico' => $this->id_medico,
            'nombre' => $nombreDia,
            'dia_turno' => $this->fechaHorario,
            'hora_inicio' => $this->hora_inicio,
            'hora_fin' => $this->hora_fin,
            'id_consultorio' => $this->consultorio,
        ]);
        $this->limpiarCampos();
        session()->flash('message', 'Horario Actualizado');
    }

    public function default()
    {
        $this->limpiarCampos();
        $this->view = "guardar-turno";
    }

    public function limpiarCampos()
    {
        $this->fechaHorario = '';
        $this->hora_inicio = '';
        $this->hora_fin = '';
        $this->consultorio = '';
    }

    public function destroy($id)
    {
        Turno::destroy($id);
    }
}
