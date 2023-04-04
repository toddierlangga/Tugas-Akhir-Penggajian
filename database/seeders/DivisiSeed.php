<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Personalia\Divisi;
use Illuminate\Support\Facades\Schema;

class DivisiSeed extends Seeder
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
        Divisi::truncate();

        Divisi::create([
            'nama_divisi'  => 'Departemen Audit',
        ]);

        Divisi::create([
            'nama_divisi'  => 'Departemen Personalia',
        ]);

        Divisi::create([
            'nama_divisi'  => 'Departemen Enzim',
        ]);

        Divisi::create([
            'nama_divisi'  => 'Departemen Pertanian',
        ]);
        
        Divisi::create([
            'nama_divisi'  => 'Departemen Dokter Hewan',
        ]);

        Divisi::create([
            'nama_divisi'  => 'Departemen Produksi',
        ]);

        Divisi::create([
            'nama_divisi'  => 'Departemen Keamanan Hayati',
        ]);
        
        Divisi::create([
            'nama_divisi'  => 'Departemen Laboratorium',
        ]);

        Divisi::create([
            'nama_divisi'  => 'Departemen Pabrik Pakan',
        ]);

        Divisi::create([
            'nama_divisi'  => 'Departemen Keuangan',
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
