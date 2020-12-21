<?php

namespace App\Http\Controllers;

use App\Cita;
use App\Eps;
use Illuminate\Http\Request;
use App\Medico;
use App\MotivoCita;
use App\Turno;
use Carbon\Carbon;
use Facade\FlareClient\Time\Time;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CitaController extends Controller
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

    public function index()
    {
        $motivos = MotivoCita::all();
        $menu = 'cita';
        return view('eventos.evento', compact('menu', 'motivos'));
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
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'title' => 'required',
            'medico' => 'required',
            'remiteEPS' => 'required',
            'start' => 'required',
            'consultorio' => 'required',
            'orden' => 'required|mimes:jpg,png,jpeg,pdf|max:5000', //kb
        ]);
        if ($validatedData->fails()) {
            return response()->json('error'/* $validatedData->errors(), 422 */);
        }

        if ($request->hasFile('orden')) {
            $file = $request->file('orden');
            $ruta = public_path() . '/storage/ordenes';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($ruta, $fileName);
        } else {
            return response()->json('error');
        }

        $result = Cita::create([
            'title' => $request->title,
            'descripcion' => $request->descripcion,
            'color' => $request->color,
            'remiteEPS' => $request->remiteEPS,
            'fecha_cita' => $request->fecha_cita,
            'start' => $request->start,
            'consultorio' => $request->consultorio,
            'end' => $request->end,
            'user_id' => Auth::user()->id,
            'id_medico' => $request->medico,
            'orden' => $fileName,
        ]);
        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //desplegar inf
        $eventos = DB::table('citas')
            ->join('motivo_citas', 'motivo_citas.id', '=', 'citas.title')

            ->join('medicos', 'medicos.id', '=', 'citas.id_medico')
            ->join('users', 'users.id', '=', 'medicos.id_user')

            ->where('citas.user_id', Auth::user()->id)
            ->where('asistio', null)
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
                'citas.orden',
                'medicos.id as id_medico',
                'users.name as nombreMedico',
                'users.lastname as apellidoMedico'
            )
            ->get();
        return $eventos;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cita  $idMedico
     * @param  \App\Cita  $fechaCita
     * @return \Illuminate\Http\Response
     */
    public function buscarCitaMedico($idMedico, $fechaCita)
    {
        /* SELECT * FROM `citas` WHERE id_medico = 1 and fecha_cita = '2020-12-03' */
        $dConCit = Cita::withTrashed()->where([
            'id_medico' => $idMedico,
            'fecha_cita' => $fechaCita
        ])->get();
        return response()->json($dConCit);

        /*
        //esto es para  buscar por dia
        $hora_hoy = Cita::selectRaw('TIME(start) AS start, TIME(end) AS end')
            ->whereDay('start', $id)   // ------> cambiar tiene que ser where
            ->get();
        return response()->json($hora_hoy);
        //SELECT DATE(`start`) AS date_part, TIME(`end`) AS time_part FROM `citas`
         */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fileName = $request->ordenUpdate;

        if ($request->hasFile('orden')) {
            //luego eliminamos archivo
            Storage::delete("public/ordenes/" . $fileName);

            $file = $request->file('orden');
            $ruta = public_path() . '/storage/ordenes';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($ruta, $fileName);
        }

        $res = Cita::findOrFail($id)->update([
            'title' => $request->title,
            'descripcion' => $request->descripcion,
            'color' => $request->color,
            'remiteEPS' => $request->remiteEPS,
            'fecha_cita' => $request->fecha_cita,
            'consultorio' => $request->consultorio,
            'start' => $request->start,
            'end' => $request->end,
            'user_id' => Auth::user()->id,
            'id_medico' => $request->medico,
            'orden' => $fileName,
        ]);
        return response()->json($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cita = Cita::withTrashed()->where('id', $id)->get();
        Storage::delete("public/ordenes/" . $cita[0]->orden);
        Cita::withTrashed()->findOrFail($id)->restore();
        Cita::withTrashed()->findOrFail($id)->forceDelete();
        return response()->json(true);
    }

    /**
     * Buscar turno recibe parametros el dia y el id del medio.
     *
     * @param  \App\Cita  $
     * @param  \App\Cita  $idMedio
     * @return \Illuminate\Http\Response
     */
    public function buscamosTurnos($dia, $idMedico)
    {
        $cita = Turno::where('id_medico', $idMedico)
            ->where('dia_turno', $dia)
            ->get();

        return response()->json($cita);
    }
}
