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
        if ($request->hasFile('orden')) {
            $file = $request->file('orden');
            $ruta = public_path() . '/storage/ordenes';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($ruta, $fileName);
        } else {
            return response()->json('error');
        }

        $validatedData = Validator::make($request->all(), [
            'title' => 'required',
            'medico' => 'required',
            'remiteEPS' => 'required',
            'start' => 'required',
            'consultorio' => 'required',
        ]);
        if ($validatedData->fails()) {
            return response()->json('error'/* $validatedData->errors(), 422 */);
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
                'citas.consultorio',
                'citas.start',
                'citas.end',
                'citas.user_id',
                'citas.title as id_title',
                'citas.orden'
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
        $fileName = $request->ordenUpdate;

        if ($request->hasFile('orden')) {
            //luego eliminamos archivo
            Storage::delete("public/ordenes/".$fileName);

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
        $cita = Cita::where('id',$id)->get();
        Storage::delete("public/ordenes/".$cita[0]->orden);
        Cita::destroy($id);
        return response()->json(true);        
    }
}
