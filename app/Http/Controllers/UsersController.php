<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
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
        $menu = 'editar-datos';
        return view('layouts.editar-datos', compact('menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function foto()
    {
        $menu = 'editar-datos';
        return view('layouts.foto-perfil', compact('menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cambiarPassword()
    {
        $menu = 'editar-datos';
        return view('auth.cambiarPassword.cambiar-password', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cambiarPasswordResult(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'passwordOld' => 'required|min:6|max:30',
            'passwordNew' => 'required|min:6|max:30',
            'passwordConfirm' => 'required|same:passwordNew',
        ]);
        if (Hash::check($request->passwordOld, $user->password)) {
            User::findOrFail($user->id)->update([
                'password' => Hash::make($request->passwordNew),
            ]);
            return back()->with('alert-success', 'Su contraseña se ha cambiado.');
        } else {
            return back()->with('alert-warning','Contraseña no coindice con la ya guardada en nuestro sistema.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
