<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'documentNumber' => ['required', 'max:20', 'unique:users'],
            'tipo' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'min:5', 'max:40'],
            'phone' => ['required', 'min:8', 'max:14'],

            'direccion' =>  ['required', 'max:255'],
            'tipo_sangre' => 'required',
            'tipo_eps' => 'required',

            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],

            'passwordNew'              => 'required|min:6|max:30',
            'passwordConfirm' => 'required|same:passwordNew',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $userRolPaciente = User::create([
            'tipo' => $data['tipo'],
            'documentNumber' => $data['documentNumber'],
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'phone' => $data['phone'],

            'direccion' => $data['direccion'],
            'tipo_sangre' => $data['tipo_sangre'],
            'tipo_eps' => $data['tipo_eps'],

            'email' => $data['email'],
            'password' => Hash::make($data['passwordNew']),
            'photo' => 'fotos/perfil-undefined/personPerfil.png',
        ]);
        $userRolPaciente->assignRole('Paciente');

        return $userRolPaciente;
    }
}
