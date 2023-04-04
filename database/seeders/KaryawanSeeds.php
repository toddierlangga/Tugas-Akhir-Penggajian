<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Personalia\Karyawan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Schema;
use Faker\Factory as Faker;

class KaryawanSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $faker = Faker::create('id_ID');
        
        for($i = 0; $i < 200; $i++){

            Karyawan::create([
                'id_jabatan'         => $faker->numberBetween(1, 10),
                'id_divisi'          => $faker->numberBetween(1, 10),
                'nip'                => $faker->numberBetween(1000000000000000, 9999999999999999),
                'nama_karyawan'      => $faker->name,
                'jkel'               => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'tempat_lahir'       => $faker->city,
                'tanggal_lahir'      => $faker->dateTimeThisCentury('-20 years','-15 years'),
                'telepon'            => $faker->phoneNumber,
                'agama'              => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Kong Hu Cu']),
                'status_nikah'       => $faker->randomElement(['Belum Menikah', 'Menikah', 'Duda', 'Janda']),
                'alamat'             => $faker->address,
                'tanggungan_anak'    => $faker->numberBetween(0, 5),
                'tanggal_perekrutan' => $faker->date,
                'tempat_perekrutan'  => $faker->randomElement(['Batam', 'Jakarta']),
            ]);

        }
        Schema::enableForeignKeyConstraints();
    }
}
