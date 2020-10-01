<?php

namespace App\Http\Controllers;

use App\Consultorio;
use Illuminate\Http\Request;
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
}
