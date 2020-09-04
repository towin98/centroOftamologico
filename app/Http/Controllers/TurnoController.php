<?php

namespace App\Http\Controllers;

use App\Turno;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
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
        $horarios = Turno::where('id_user', 1)->paginate(8);
        //return json_encode($horarios);
        return view('medico.medico-horario',compact('menu','horarios'));
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
        $validatedData = Validator::make($request->all(), [

            'id_user' => 'required',
            'nombre' => 'required',
            'dia_turno' => 'required|date|unique:turnos',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'Noconsultorio' => 'required',
        ]);

        if ($validatedData->fails()) {
            return response()->json($validatedData->errors(), 422);
        }
        Turno::create($request->all());
        return $request->all();

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
