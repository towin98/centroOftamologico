<?php

namespace App\Http\Controllers;

use App\Medico;
use App\medicoxsede;
use App\Turno;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = 'medicos-turno';
        $horarios = Turno::where('id_user', Auth::user()->id)->paginate(8);
        //return json_encode($horarios);
        return view('medico.medico-horario', compact('menu', 'horarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //crea rol
    {
        $validacionTurno = Turno::where([
            'id_user' => Auth::user()->id,
            'dia_turno' => $request->dia_turno
        ])->get();
    

        if (count($validacionTurno) !== 0) {
            return response()->json('ExisteFecha');
        }

        $idMedico = Medico::where('id_user', Auth::user()->id)->get();
        $validatedData = Validator::make($request->all(), [

            //'id_user' => 'required',
            //'id_medico' => 'required',
            'nombre' => 'required',
            'dia_turno' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'Noconsultorio' => 'required',
        ]);

        if ($validatedData->fails()) {
            return response()->json($validatedData->errors(), 422);
        }

        $turno = Turno::create([
            'id_user' => Auth::user()->id,
            'id_medico' => $idMedico[0]->id,
            'nombre' => $request->nombre,
            'dia_turno' => $request->dia_turno,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'Noconsultorio' => $request->Noconsultorio,
        ]);
        medicoxsede::create([
            'medico_id' => $idMedico[0]->id,
            'sede_id' => 1,
            'turno_id' => $turno->id,
        ]);
        return response()->json($turno);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Turno  $turno
     * @return \Illuminate\Http\Response
     */
    public function show(Turno $turno)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Turno  $turno
     * @return \Illuminate\Http\Response
     */
    public function edit(Turno $turno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Turno  $turno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Turno $turno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Turno  $turno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Turno $turno)
    {
        //
    }
}
