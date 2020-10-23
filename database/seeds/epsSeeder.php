<?php

use App\Eps;
use App\Tipoeps;
use Illuminate\Database\Seeder;

class epsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayEpsTipo = array('Particular','Prepagada');
        foreach ($arrayEpsTipo as $tipo) {
            Tipoeps::create([
                'nombre' => $tipo
            ]);
        }

        $arrayEpsParticular = array('Medimax', 'Comfamiliar', 'Famisanad', 'Ecosalud');
        foreach ($arrayEpsParticular as $epsParticular) {
            Eps::create([
                'nombre' => $epsParticular,
                'id_tipo_eps' => 1
            ]);
        }

        $arrayEpsPrepagada = array('Promedia', 'Protegemos', 'Previred', 'Uncored', 'Glovalred', 'coven');
        foreach ($arrayEpsPrepagada as $epsPrepagada) {
            Eps::create([
                'nombre' => $epsPrepagada,
                'id_tipo_eps' => 2
            ]);
        }
    }
}
