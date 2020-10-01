<?php

namespace App\Http\Controllers;

use App\MotivoCita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MotivoCitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = 'motivoCita';
        $motivoCitas = MotivoCita::paginate(6);
        return view('admin.motivo-Cita', compact('motivoCitas', 'menu'));
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
        $validatedData = Validator::make($request->all(), [
            'nombreasunto' => 'required',
        ]);
        if ($validatedData->fails()) {
            return response()->json($validatedData->errors(), 422);
        }

        $motivoCita = MotivoCita::create([
            'nombreasunto' => $request->nombreasunto,
        ]);
        return response()->json($motivoCita);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MotivoCita  $motivoCita
     * @return \Illuminate\Http\Response
     */
    public function show(MotivoCita $motivoCita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MotivoCita  $motivoCita
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asunto = MotivoCita::findOrFail($id);
        return response()->json($asunto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MotivoCita  $motivoCita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $motivoCitas = MotivoCita::findOrFail($id);
        $motivoCitas->update([
            'nombreasunto' => $request->nombreasunto,
        ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MotivoCita  $motivoCita
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) 
    {
        MotivoCita::destroy($id);
        return response()->json($id);
    }
}
