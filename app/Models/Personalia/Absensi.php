<?php

namespace App\Models\Personalia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $primaryKey = 'id_absensi';
    
    public $timestamps = false;

    protected $fillable = [
        'id_karyawan',
        'jam_datang',
        'jam_pulang',
    ];
}
