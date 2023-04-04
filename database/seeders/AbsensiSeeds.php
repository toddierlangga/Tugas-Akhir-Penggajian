<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Personalia\Absensi;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Schema;
use Faker\Factory as Faker;

class AbsensiSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        //buat divisi
        Absensi::truncate();
        $faker = Faker::create('id_ID');
        for($i = 0; $i < 4000; $i++){
            Absensi::create([
                'id_karyawan'         => $faker->numberBetween(1, 200),
                'jam_datang'          => $faker->dateTimeInInterval('-7 hours','+3 hours'),
                'jam_pulang'          => $faker->dateTimeInInterval('+2 hours','-2 hours'),
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
