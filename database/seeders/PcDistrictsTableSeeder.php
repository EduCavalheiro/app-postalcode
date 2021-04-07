<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PcDistrictsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('pc_districts')->delete();

        \DB::table('pc_districts')->insert(array(
            0 => array(
                'id' => 1,
                'cod_district' => '01',
                'desig_district' => 'Aveiro',
            ),
            1 => array(
                'id' => 2,
                'cod_district' => '02',
                'desig_district' => 'Beja',
            ),
            2 => array(
                'id' => 3,
                'cod_district' => '03',
                'desig_district' => 'Braga',
            ),
            3 => array(
                'id' => 4,
                'cod_district' => '04',
                'desig_district' => 'Bragança',
            ),
            4 => array(
                'id' => 5,
                'cod_district' => '05',
                'desig_district' => 'Castelo Branco',
            ),
            5 => array(
                'id' => 6,
                'cod_district' => '06',
                'desig_district' => 'Coimbra',
            ),
            6 => array(
                'id' => 7,
                'cod_district' => '07',
                'desig_district' => 'Évora',
            ),
            7 => array(
                'id' => 8,
                'cod_district' => '08',
                'desig_district' => 'Faro',
            ),
            8 => array(
                'id' => 9,
                'cod_district' => '09',
                'desig_district' => 'Guarda',
            ),
            9 => array(
                'id' => 10,
                'cod_district' => '10',
                'desig_district' => 'Leiria',
            ),
            10 => array(
                'id' => 11,
                'cod_district' => '11',
                'desig_district' => 'Lisboa',
            ),
            11 => array(
                'id' => 12,
                'cod_district' => '12',
                'desig_district' => 'Portalegre',
            ),
            12 => array(
                'id' => 13,
                'cod_district' => '13',
                'desig_district' => 'Porto',
            ),
            13 => array(
                'id' => 14,
                'cod_district' => '14',
                'desig_district' => 'Santarém',
            ),
            14 => array(
                'id' => 15,
                'cod_district' => '15',
                'desig_district' => 'Setúbal',
            ),
            15 => array(
                'id' => 16,
                'cod_district' => '16',
                'desig_district' => 'Viana do Castelo',
            ),
            16 => array(
                'id' => 17,
                'cod_district' => '17',
                'desig_district' => 'Vila Real',
            ),
            17 => array(
                'id' => 18,
                'cod_district' => '18',
                'desig_district' => 'Viseu',
            ),
            18 => array(
                'id' => 19,
                'cod_district' => '31',
                'desig_district' => 'Ilha da Madeira',
            ),
            19 => array(
                'id' => 20,
                'cod_district' => '32',
                'desig_district' => 'Ilha de Porto Santo',
            ),
            20 => array(
                'id' => 21,
                'cod_district' => '41',
                'desig_district' => 'Ilha de Santa Maria',
            ),
            21 => array(
                'id' => 22,
                'cod_district' => '42',
                'desig_district' => 'Ilha de São Miguel',
            ),
            22 => array(
                'id' => 23,
                'cod_district' => '43',
                'desig_district' => 'Ilha Terceira',
            ),
            23 => array(
                'id' => 24,
                'cod_district' => '44',
                'desig_district' => 'Ilha da Graciosa',
            ),
            24 => array(
                'id' => 25,
                'cod_district' => '45',
                'desig_district' => 'Ilha de São Jorge',
            ),
            25 => array(
                'id' => 26,
                'cod_district' => '46',
                'desig_district' => 'Ilha do Pico',
            ),
            26 => array(
                'id' => 27,
                'cod_district' => '47',
                'desig_district' => 'Ilha do Faial',
            ),
            27 => array(
                'id' => 28,
                'cod_district' => '48',
                'desig_district' => 'Ilha das Flores',
            ),
            28 => array(
                'id' => 29,
                'cod_district' => '49',
                'desig_district' => 'Ilha do Corvo',
            ),
        ));
    }
}
