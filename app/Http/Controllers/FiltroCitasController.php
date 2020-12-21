<?php

namespace App\Http\Controllers;

use App\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class FiltroCitasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $medicos = DB::table('medicos')
            ->join('users', 'medicos.id_user', '=', 'users.id')
            ->select('medicos.id', 'users.name', 'users.lastname')
            ->get();
        $menu = 'citas-agendadas';
        return view('eventos.citas-agendadas', compact('menu', 'medicos'));
    }

    public function show(Request $request)
    {
        $eventos = DB::table('citas')
            ->join('motivo_citas', 'motivo_citas.id', '=', 'citas.title')
            ->join('users', 'users.id', '=', 'citas.user_id')
            ->where('citas.fecha_cita', '>=', $request->startDate)
            ->where('citas.fecha_cita', '<=', $request->endDate)
            ->where('citas.id_medico', $request->idMedico)
            ->select(
                'citas.id',
                'motivo_citas.nombreasunto as title',
                'citas.id_medico',
                'citas.descripcion',
                'citas.color',
                'citas.remiteEPS',
                'citas.fecha_cita',
                'citas.consultorio',
                'citas.start',
                'citas.end',
                'citas.user_id',
                'citas.title as id_title',
                'users.name as nombrePaciente',
                'users.lastname as apellidoPaciente',
                'users.photo as photoPaciente',
                'citas.orden',
                'citas.asistio',
            )
            ->get();
        return $eventos;
    }

    public function asistioCita($idEvento){
        
        $respuesta = true;
        try {
           Cita::destroy($idEvento);
            
        } catch (Throwable $th) {
            $respuesta = false;
        }
        return response()->json($respuesta);
    }   
    
    public function destroy($idEvento){
        $respuesta = true;
        try {
            Cita::withTrashed()->findOrFail($idEvento)->restore();
        } catch (Throwable $th) {
            $respuesta = $th;
        }
        return response()->json($respuesta);
    }

}
