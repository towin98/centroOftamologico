<?php

namespace App\Http\Controllers;

use App\Cita;
use App\Evento;
use App\Hora;
use App\Medico;
use App\Turno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Prophecy\Promise\ReturnPromise;

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
        $medicos = Medico::all();
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
        $resul= Cita::selectRaw('TIME(start) AS start')
        ->where('medicoxsede_medico_idmedico', $idmedico)
        ->whereDay('start',$day)
        ->get();
        return response()->json($resul);


        /*  //buscamos las horas disponibles por medico 
        $resul= Cita::selectRaw('TIME(start) AS start')
        ->where('medico_id', $idmedico)
        ->whereDay('start',$day)
        ->get();
        return response()->json($resul); */
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
}
