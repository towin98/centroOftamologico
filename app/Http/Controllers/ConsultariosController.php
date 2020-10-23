<?php

namespace App\Http\Controllers;

use App\Consultorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ConsultariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $menu = 'consultorios';
        $consultorios = Consultorio::paginate(6);
        return view('medico.consultorios', compact('menu', 'consultorios'));
    }

    public function edit($id)
    {
        $asunto = Consultorio::findOrFail($id);
        return response()->json($asunto);
    }

    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);
        if ($validatedData->fails()) {
            return response()->json($validatedData->errors(), 422);
        }

        $res = Consultorio::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);
        return response()->json($res);
    }

    public function update(Request $request, $id)
    {
        $motivoCitas = Consultorio::findOrFail($id);
        $motivoCitas->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);
        return redirect()->back();
    }


    public function destroy($id)
    {
        Consultorio::destroy($id);
        return response()->json($id);
    }
    public function buscarConsultorioPorHora($id_medico, $hora_inicio, $fechaDia)
    {

        /* SELECT consultorios.nombre, turnos.hora_inicio FROM `turnos`
        INNER JOIN consultorios
        oN consultorios.id = turnos.id_consultorio
        WHERE id_medico = 1 and hora_inicio and turnos.dia_turno = '2020-10-29' <  '08:40:00' and hora_fin > '08:49:00' */

        $turnoConsultorio = DB::table('turnos')
            ->join('consultorios', 'turnos.id_consultorio', '=', 'consultorios.id')

            ->where('id_medico', '=', $id_medico)
            ->where('dia_turno', '=', $fechaDia)

            ->where('turnos.hora_inicio', '<=', $hora_inicio)
            ->where('turnos.hora_fin', '>=', $hora_inicio)

            ->select('consultorios.nombre')
            ->first();

        return response()->json($turnoConsultorio);
    }
}
