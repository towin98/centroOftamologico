<?php

namespace App\Http\Controllers;

use App\Cita;
use Illuminate\Http\Request;
use App\Medico;
use App\MotivoCita;
use Carbon\Carbon;
use Facade\FlareClient\Time\Time;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $medicos = DB::table('medicos')
            ->join('users', 'medicos.id_user', '=', 'users.id')
            ->select('medicos.id', 'users.name', 'users.lastname')
            ->get();
        $motivos = MotivoCita::all();
        $menu = 'cita';
        return view('eventos.evento', compact('medicos', 'menu', 'motivos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $start = evento::all('start');
        // return response()->json($start);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = Cita::create([
            'title' => $request->title,
            'descripcion' => $request->descripcion,
            'color' => $request->color,
            'remiteEPS' => $request->remiteEPS,
            'fecha_cita' => $request->fecha_cita,
            'start' => $request->start,
            'end' => $request->end,
            'user_id' => Auth::user()->id,
            'id_medico' => $request->medico,
        ]);
        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //desplegar inf
        $eventos = DB::table('citas')
            ->join('motivo_citas', 'motivo_citas.id', '=', 'citas.title')
            ->where('citas.user_id', Auth::user()->id)
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
                'citas.title as id_title'
            )
            ->get();
        return $eventos;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hora_hoy = Cita::selectRaw('TIME(start) AS start, TIME(end) AS end')
            ->whereDay('start', $id)
            ->get();
        return response()->json($hora_hoy);
        //SELECT DATE(`date_time_field`) AS date_part, TIME(`date_time_field`) AS time_part FROM `your_table`
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
        $res = Cita::findOrFail($id)->update($request->all());
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
        Cita::destroy($id);
        return response()->json($id);
    }
}
