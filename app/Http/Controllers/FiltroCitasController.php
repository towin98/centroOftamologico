<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function show()
    {
        $eventos = DB::table('citas')
            ->join('motivo_citas', 'motivo_citas.id', '=', 'citas.title')
            ->join('users', 'users.id', '=', 'citas.user_id')
            ->select(
                'citas.id',
                'motivo_citas.nombreasunto as title',
                'citas.id_medico',
                'citas.descripcion',
                'citas.color',
                'citas.remiteEPS',
                'citas.fecha_cita',
                'citas.start',
                'citas.end',
                'citas.user_id',
                'citas.title as id_title',
                'users.name as nombrePaciente',
                'users.lastname as apellidoPaciente',
                'users.photo as photoPaciente',
                'citas.orden',
            )
            ->get();
        return $eventos;
    }
}
