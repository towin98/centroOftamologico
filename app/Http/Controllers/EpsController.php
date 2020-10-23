<?php

namespace App\Http\Controllers;

use App\Eps;
use Illuminate\Http\Request;

class EpsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function mostrarEps($idtipo)
    {
        $eps = Eps::where('id_tipo_eps',$idtipo)->get();
        return response()->json($eps);
    }

    public function mostrarEpsUpdate($idEps)
    {
        $eps = Eps::where('id',$idEps)->get();
        return response()->json($eps);
    }

    public function mostrarEpsOne($id)
    {
        $eps = Eps::where('id',$id)->first();
        return response()->json($eps);
    }
}
