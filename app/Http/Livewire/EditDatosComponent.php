<?php

namespace App\Http\Livewire;

use App\Eps;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Livewire;
use Livewire\WithFileUploads;

class EditDatosComponent extends Component
{
    use WithFileUploads;

    public  $tipo ,$photo ,$documentNumber, $name, $lastname,
        $tipo_sangre, $tipo_eps, $phone, $email, $direccion;

    public $idUser;
    public $eps;
    
    public $has;
    public $fotocambia;

    public function mount()
    {
        $user = Auth::user();
        $this->tipo = $user->tipo;
        $this->idUser = $user->id;
        $this->documentNumber = $user->documentNumber;
        $this->name = $user->name;
        $this->lastname = $user->lastname;
        $this->tipo_sangre = $user->tipo_sangre;
        $this->tipo_eps = $user->tipo_eps;
        $this->phone = $user->phone;
        $this->email = $user->email;
        $this->direccion = $user->direccion;
        $this->photo = $user->photo;

        if (empty($user->tipo_eps) or empty($user->direccion) or empty($user->tipo_sangre)) {
            session()->flash('camposVacios', 'Por favor completa el formulario con tus datos 😉' );
        }
        $this->eps = Eps::all();
        return view('livewire.edit-datos-component');
    }

    public function store()
    {
        $this->validate([
            'photo' => 'required',
            'documentNumber' => 'required',
            'name' => 'required',
            'lastname' => 'required',
            'tipo' => 'required',
            'tipo_sangre' => 'required',
            'tipo_eps' => 'required',
            'email' => 'required',
            'direccion' => 'required'
        ]);   

        User::findOrFail($this->idUser)->update([
            'tipo' => $this->tipo,
            'documentNumber' => $this->documentNumber,
            'name' => $this->name,
            'lastname' => $this->lastname,
            'phone' => $this->phone,
            'email' => $this->email,
            'direccion' => $this->direccion,
            'tipo_sangre' => $this->tipo_sangre,
            'tipo_eps' => $this->tipo_eps,
           
        ]);
        
                        //$this->photo->storeAs('photos', $this->photo);
        session()->flash('message', 'Datos actualizados correctamente' );
        
        //$request->file($file)->store('photos');
        //$this->photo->store('photos');//storage/app/photos
         
    }
       
}
