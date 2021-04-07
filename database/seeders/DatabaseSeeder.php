<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(PcCountiesTableSeeder::class);
        $this->call(PcDistrictsTableSeeder::class);
        $this->call(PcPostalCodesTableSeeder1::class);
        $this->call(PcPostalCodesTableSeeder2::class);
        $this->call(PcPostalCodesTableSeeder3::class);
        $this->call(PcPostalCodesTableSeeder4::class);
        $this->call(PcPostalCodesTableSeeder5::class);
        $this->call(PcPostalCodesTableSeeder6::class);
        $this->call(PcPostalCodesTableSeeder7::class);
        $this->call(PcPostalCodesTableSeeder8::class);
        $this->call(PcPostalCodesTableSeeder9::class);
        $this->call(PcPostalCodesTableSeeder10::class);
    }
}
