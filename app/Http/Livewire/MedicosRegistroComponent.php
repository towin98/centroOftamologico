<?php

namespace App\Http\Livewire;

use App\especialidad;
use App\Medico;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class MedicosRegistroComponent extends Component
{
    use WithFileUploads;
    public $photo, $photoMostrar;


    use WithPagination;
    public  $id_medico, $nombres, $apellidos, $id_especialidad, $descripcion_perfil;
    public $especializaciones;  //mostrar registros en tabla
    public $view = 'tabla-medicos';

    public function render()
    {
        return view('livewire.medicos-registro-component', [
            'medicos' => Medico::where('id_user', Auth::user()->id)->orderBy('id', 'desc')->paginate(5)
        ]);
    }

    public function guardar()
    {
        $this->especializaciones = especialidad::all();
        $this->view = 'guardar';
    }

    public function store()
    {
        $this->validate([
            'nombres' => 'required|min:3',
            'apellidos' => 'required|min:3',
            'id_especialidad' =>  'required|not_in:0',
            'descripcion_perfil' => 'required|max:255',
            'photo' => 'required',
        ]);
        Medico::create([
            'nombres' => $this->nombres,
            'apellidos' => $this->apellidos,
            'id_especialidad' =>  $this->id_especialidad,
            'id_user' => Auth::user()->id,
            'descripcion_perfil' => $this->descripcion_perfil,
            'photo' => $this->photo->store('fotos', 'public'),
        ]);

        session()->flash('message', 'Un nuevo medico agregado corectamente!');
        return redirect()->to('/medicos-registro');
    }
    public function edit($id)
    {
        $medicos = Medico::findOrFail($id);
        $this->id_medico = $medicos->id;
        $this->nombres = $medicos->nombres;
        $this->apellidos = $medicos->apellidos;
        $this->id_especialidad = $medicos->id_especialidad;
        $this->descripcion_perfil = $medicos->descripcion_perfil;
        $this->photoMostrar = $medicos->photo;
        $this->especializaciones = especialidad::all();

        $this->view = 'edit';
    }
    public function update()
    {
        $this->validate([
            'nombres' => 'required|min:3',
            'apellidos' => 'required|min:3',
            'id_especialidad' =>  'required|not_in:0',
            'descripcion_perfil' => 'required|max:255',

            //'photo' => 'required',

        ]);

        $medico = Medico::findOrFail($this->id_medico);
        if (!empty($this->photo)) {
            Storage::delete("public/" . $medico->photo);
            $medico->update([
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos,
                'id_especialidad' =>  $this->id_especialidad,
                'descripcion_perfil' => $this->descripcion_perfil,
                'photo' => $this->photo->store('fotos', 'public'),
            ]);
        } else {
            $medico->update([
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos,
                'id_especialidad' =>  $this->id_especialidad,
                'descripcion_perfil' => $this->descripcion_perfil,
            ]);
        }

        session()->flash('message', 'Datos actualizados');
    }

    public function destroy($id)
    {
        $medico = Medico::findOrFail($id);
        Storage::delete("public/" . $medico->photo);
        Medico::destroy($id);
        session()->flash('message', 'Registro eliminado!');
    }

    public function atras()
    {
        return redirect()->to('/medicos-registro');
    }
}
