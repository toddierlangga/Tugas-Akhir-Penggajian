<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(DivisiSeed::class);
        $this->call(UserSeeds::class);
        $this->call(JabatanSeeds::class);
        // $this->call(KaryawanSeeds::class);
        // $this->call(GajiSeeds::class);
        // $this->call(AbsensiSeeds::class);
    }
}
