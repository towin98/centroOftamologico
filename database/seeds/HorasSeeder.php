<?php

use App\Hora;
use App\MotivoCita;
use App\Sede;
use App\Turno;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str; //importante Str

class HorasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = array(
            "08:00:00",
            "08:09:59",
            "08:10:00",
            "08:19:59",
            "08:20:00",
            "08:29:59",
            "08:30:00",
            "08:39:59",
            "08:40:00",
            "08:49:59",
            "08:50:00",
            "08:59:59",
            "09:00:00",
            "09:09:59",
            "09:10:00",
            "09:19:59",
            "09:20:00",
            "09:29:59",
            "09:30:00",
            "09:39:59",
            "09:40:00",
            "09:49:59",
            "09:50:00",
            "09:59:59",
            "10:00:00",
            "10:09:59",
            "10:10:00",
            "10:19:59",
            "10:20:00",
            "10:29:59",
            "10:30:00",
            "10:39:59",
            "10:40:00",
            "10:49:59",
            "10:50:00",
            "10:59:59",
            "11:00:00",
            "11:09:59",
            "11:10:00",
            "11:19:59",
            "11:20:00",
            "11:29:59",
            "11:30:00",
            "11:39:59",
            "11:40:00",
            "11:49:59",
            "11:50:00",
            "11:59:59",
            "14:00:00",
            "14:09:59",
            "14:10:00",
            "14:19:59",
            "14:20:00",
            "14:29:59",
            "14:30:00",
            "14:39:59",
            "14:40:00",
            "14:49:59",
            "14:50:00",
            "14:59:59",
            "15:00:00",
            "15:09:59",
            "15:10:00",
            "15:19:59",
            "15:20:00",
            "15:29:59",
            "15:30:00",
            "15:39:59",
            "15:40:00",
            "15:49:59",
            "15:50:00",
            "15:59:59",
            "16:00:00",
            "16:09:59",
            "16:10:00",
            "16:19:59",
            "16:20:00",
            "16:29:59",
            "16:30:00",
            "16:39:59",
            "16:40:00",
            "16:49:59",
            "16:50:00",
            "16:59:59",
            "17:00:00",
            "17:09:59",
            "17:10:00",
            "17:19:59",
            "17:20:00",
            "17:29:59",
            "17:30:00",
            "17:39:59",
            "17:40:00",
            "17:49:59",
            "17:50:00",
            "17:59:59",
        );

        for ($i = 0; $i < count($array); $i++) {
            Hora::create([
                'hora_inicio_cita' => $array[$i],
                'hora_fin_cita' => $array[$i + 1],
            ]);
            $i++;
        }
        $arrayMotivoCita = array(
            'Consulta oftalmológica',
            'Examen Compimetria',
            'Examen Paquimetria',
            'Examen Biometria',
            'Examen Interferometria',
            'Examen Tomografia',
            'Topografia',
            'Iridocmetria',
            'Angiografia',
            'Capsutomia',
            'Ecografia',
            'Recuentro Entrecelular',
        );

        foreach ($arrayMotivoCita as $value) {
            MotivoCita::create([
                'nombreasunto' => $value,
            ]);
        }
    }
}
