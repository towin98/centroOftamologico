<?php

namespace App\Http\Controllers;

use App\Cita;
use App\Evento;
use App\Hora;
use App\Medico;
use App\Turno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Prophecy\Promise\ReturnPromise;
use Throwable;

class MedicosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function medicos_perfil()
    {
        $menu = 'medicos-centro';
        $medicos = DB::table('medicos')
            ->join('users', 'medicos.id_user', '=', 'users.id')
            ->select('users.name', 'users.lastname', 'users.photo')
            ->get();
        return view('medico.medicos-perfil', compact('menu', 'medicos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function medicos_registro()
    {
        $menu = 'medicos-registro';
        return view('medico.medico-registro', compact('menu'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idmedico, $day)
    //buscamos las horas disponibles por medico 
    {
        $resul = Cita::withTrashed()->selectRaw('TIME(start) AS start')
            ->where('id_medico', $idmedico)
            ->whereDay('start', $day)
            ->get();
        return response()->json($resul);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function mostrarMedicosEvento($id_motivoCita)
    {
        try {
            //SELECT medicos.id,users.name FROM `motivo_citas_has__especialidads` INNER JOIN medicos ON motivo_citas_has__especialidads.MEDICOS_id = medicos.id INNER JOIN users ON users.id = medicos.id_user WHERE motivo_citas_has__especialidads.MOTIVO_CITAS_id = 7
            $medicos = DB::table('motivo_citas_has__especialidads')
                ->join('medicos', 'motivo_citas_has__especialidads.MEDICOS_id', '=', 'medicos.id')
                ->join('users', 'users.id', '=', 'medicos.id_user')
                ->where('motivo_citas_has__especialidads.MOTIVO_CITAS_id', $id_motivoCita)
                ->select('medicos.id', 'users.name', 'users.lastname')
                ->get();
            return response()->json($medicos);
        } catch (Throwable $th) {
            return response()->json('error al buscar medicos');
        }
    }
}
