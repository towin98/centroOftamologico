<?php

use App\especialidad;
use App\Medico;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str; //importante Str

class MedicosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = array('Ópticos' => 1, 'Optometristas' => 2, 'Oftalmólogos' => 3);

        foreach ($array as $name => $value) {
            especialidad::create([
                'name' => $name
            ]);
        }
    
        foreach ($array as $name => $value) {
            Medico::create([
                'nombres' => Str::random(10),
                'apellidos' => Str::random(10),
                'id_especialidad' => $value,
                'id_user' => null,
                'descripcion_perfil' => Str::random(20),
                'photo' => 'HHC56aSCWw0rHOZSRqAMZXLQA26LI8XEagyhLreT.jpeg'
            ]);
        }
    }
}
