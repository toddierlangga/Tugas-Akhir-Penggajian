<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Keuangan\Gaji;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Schema;
use Faker\Factory as Faker;

class GajiSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        // //buat tunjangan
        // Gaji::truncate();
        // Gaji::create([
        //     'tunjangan_transport'  => '11500',
        //     'tunjangan_makan'      => '14800',
        //     'tunjangan_sakit'      => '0',
        //     'tunjangan_kompensasi' => '0',
        //     'tunjangan_cuti'       => '0',
        // ]);

        // Schema::enableForeignKeyConstraints();

        $faker = Faker::create('id_ID');
        
        for($i = 0; $i < 200; $i++){

            Gaji::create([
                'id_karyawan'                => $faker->unique()->numberBetween(1, 200),
                'id_jabatan'                 => $faker->numberBetween(1, 11),
                'gaji_pokok'                 => $faker->randomElement([4150000, 4750000, 5000000, 7000000, 8600000, 10000000, 13750000, 18000000, 23500000, 30000000]),
                'tunjangan_transport'        => 230000,
                'tunjangan_makan'            => 300000,
                'tunjangan_sakit'            => 0,
                'tunjangan_kompensasi'       => 0,
                'tunjangan_cuti'             => 0,
            ]);

        }
        Schema::enableForeignKeyConstraints();
    }
}
