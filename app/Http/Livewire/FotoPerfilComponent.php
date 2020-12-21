<?php

namespace App\Http\Livewire;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;


class FotoPerfilComponent extends Component
{
    use WithFileUploads;
    public $photo;
    
    public function render()
    {
        return view('livewire.foto-perfil-component');
    }
    public function store()
    {
        $this->validate([
            'photo' => 'required|image|mimes:jpg,png,jpeg',
        ]); 

        $user = Auth::user();

        if($user->photo !== 'fotos/perfil-undefined/personPerfil.png'){
            Storage::delete("public/".$user->photo);
        }

        User::findOrFail($user->id)->update([
            'photo' => $this->photo->store('fotos','public'),
        ]);
        
        return redirect()->to('/datos-usuario');
     
    }
    public function atras()
    {
        return redirect()->to('/datos-usuario');
    }



}
