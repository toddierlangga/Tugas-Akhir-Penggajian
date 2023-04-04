<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Personalia\Jabatan;
use Illuminate\Support\Facades\Schema;

class JabatanSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        //buat tunjangan
        Jabatan::truncate();

        Jabatan::create([
            'nama_jabatan'         => 'Worker',
        ]);

        Jabatan::create([
            'nama_jabatan'         => 'Foreman',
        ]);

        Jabatan::create([
            'nama_jabatan'         => 'Technician',
        ]);

        Jabatan::create([
            'nama_jabatan'         => 'Jr. Supervisor',
        ]);

        Jabatan::create([
            'nama_jabatan'         => 'Supervisor',
        ]);

        Jabatan::create([
            'nama_jabatan'         => 'Jr. Superintendent',
        ]);

        Jabatan::create([
            'nama_jabatan'         => 'Superintendent',
        ]);

        Jabatan::create([
            'nama_jabatan'         => 'Assistant Manager',
        ]);
        
        Jabatan::create([
            'nama_jabatan'         => 'Manager',
        ]);

        Jabatan::create([
            'nama_jabatan'         => 'General Manager',
        ]);

        Schema::enableForeignKeyConstraints();

    }
}
