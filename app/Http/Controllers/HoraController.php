<?php

namespace App\Http\Controllers;

use App\Hora;
use App\Turno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class HoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Hora  $hora
     * @return \Illuminate\Http\Response
     */
    public function show($fechaDia, $idMedico)
    //SELECT * FROM `turnos` WHERE `id_user` = 1 and `dia_turno` = '2020-08-27'
    {
        try {
            $turno = Turno::where(
                [
                    'id_medico' => $idMedico,
                    'dia_turno' => $fechaDia
                ]
            )->get();  //consulto si tiene un turno 

            $turnoInicia  = $turno[0]->hora_inicio;
            $turnoFin = $turno[0]->hora_fin;

            //SELECT * FROM `horas` WHERE `hora_inicio_cita` BETWEEN '06:00:00' AND '10:00:00'

            $filtroHoras = Hora::whereBetween('hora_inicio_cita', [$turnoInicia, $turnoFin])->get();
            return response()->json($filtroHoras);
        } catch (Throwable $th) {
            return response()->json(false);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hora  $hora
     * @return \Illuminate\Http\Response
     */
    public function edit(Hora $hora)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hora  $hora
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hora $hora)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hora  $hora
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hora $hora)
    {
        //
    }
}
