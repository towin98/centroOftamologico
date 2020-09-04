<?php

namespace App\Http\Controllers;

use App\Cita;
use Illuminate\Http\Request;
use App\Medico;
use App\MotivoCita;
use Carbon\Carbon;
use Facade\FlareClient\Time\Time;



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
        $medico = Medico::all();
        $motivos = MotivoCita::all();
        $menu = 'cita';
        return view('eventos.evento', compact('medico','menu','motivos'));
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
        //toda la informacion que esta en el metodo request
        //$datosEvento=request()->all();
        //echo json_encode($datosEvento);

        $result = Cita::create(request()->all());
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
        $eventos = Cita::all();
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
        //$start = Evento::all('start');
        $hora_hoy = Cita::selectRaw('TIME(start) AS start, TIME(end) AS end')
            ->whereDay('start', $id)
            ->get();
        return response()->json($hora_hoy);
        //SELECT start FROM eventos WHERE DAY(start) = 06
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
        //$eventos = evento::findOrFail($id); //aqui buscamos el primer resultado con el id
        Cita::destroy($id);
        return response()->json($id);
    }
}
