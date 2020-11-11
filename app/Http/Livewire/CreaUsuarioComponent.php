<?php

namespace App\Http\Livewire;

use App\Eps;
use App\especialidad;
use App\Medico;
use App\Motivo_citas_has__especialidad;
use App\MotivoCita;
use App\User;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class CreaUsuarioComponent extends Component
{
    public  $tipo, $photo, $documentNumber, $name, $lastname,
        $tipo_sangre, $tipo_eps, $phone, $email, $direccion, $password, $rol, $especialidadMedico, $asuntosCita = [];

    public $especialidad;
    
    public function render()
    {
        $tipoSangre = array(
            "A+",
            "B+",
            "O+",
            "AB+",
            "A-",
            "B-",
            "O-",
            "AB-"
        );
        $eps = Eps::all();
        $roles = Role::all();
        $especialidades = especialidad::all();
        $MotivoCitas = MotivoCita::all();
        if ($this->rol == 2) {
            $this->especialidad = true;
        } else {
            $this->especialidad = false;
        }
        return view('livewire.crea-usuario-component', compact('roles', 'eps', 'tipoSangre', 'especialidades', 'MotivoCitas'));
    }

    public function store()
    {
        if ($this->rol != 2) {

            $this->validate([
                'documentNumber' => 'required|unique:users',
                'name' => 'required|max:23',
                'lastname' => 'required|max:23',
                'phone' => 'required|Numeric',
                'tipo' => 'required',
                'tipo_sangre' => 'required',
                'tipo_eps' => 'required',
                'direccion' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'rol' => 'required',
            ]);
        } else if ($this->rol == 2) {
            $this->validate([
                'documentNumber' => 'required|unique:users',
                'name' => 'required',
                'lastname' => 'required',
                'phone' => 'required|Numeric',
                'tipo' => 'required',
                'tipo_sangre' => 'required',
                'tipo_eps' => 'required',
                'direccion' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'rol' => 'required',
                'especialidadMedico' => 'required',
                'asuntosCita' => 'required'
            ]);
        }

        $userRolPaciente = User::create([
            'documentNumber' => $this->documentNumber,
            'tipo' => $this->tipo,
            'name' => $this->name,
            'lastname' => $this->lastname,
            'phone' => $this->phone,
            'email' => $this->email,
            'password' => Hash::make($this->password),

            'direccion' => $this->direccion,
            'tipo_sangre' => $this->tipo_sangre,
            'tipo_eps' => $this->tipo_eps,
            'photo' => 'fotos/perfil-undefined/personPerfil.png',
        ]);
        $userRolPaciente->assignRole($this->rol);

        if ($this->rol == 2) {
            $medico = Medico::create([
                'id_especialidad' => $this->especialidadMedico,
                'id_user' => $userRolPaciente->id,
                'photo' => 'fotos/personPerfil.png',
            ]);

            foreach ($this->asuntosCita as $asuntosCita) {
                Motivo_citas_has__especialidad::create([
                    'MOTIVO_CITAS_id' => $asuntosCita,
                    'ESPECIALIDADS_id' => $this->especialidadMedico,
                    'MEDICOS_id' => $medico->id
                ]);
            }
        }

        session()->flash('message', 'Datos guardados correctamente');
        return redirect()->to('/crear-usuario');
    }
}
