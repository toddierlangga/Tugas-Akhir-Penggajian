<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Schema;

class UserSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        //buat user admin
        User::truncate();
        User::create([
            'id_karyawan'  => '1',
            'username'     => 'admin@admin.com',
            'password'     => bcrypt('admin'),
            'level'        => 'admin',
            'active'       => '1',
        ]);

        User::create([
            'id_karyawan'  => '2',
            'username'     => 'keuangan@keuangan.com',
            'password'     => bcrypt('keuangan'),
            'level'        => 'keuangan',
            'active'       => '1',
        ]);

        User::create([
            'id_karyawan'  => '3',
            'username'     => 'gm@gm.com',
            'password'     => bcrypt('gm'),
            'level'        => 'gm',
            'active'       => '1',
        ]);

        User::create([
            'id_karyawan'  => '4',
            'username'     => 'hrd@hrd.com',
            'password'     => bcrypt('hrd'),
            'level'        => 'personalia',
            'active'       => '1',
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
