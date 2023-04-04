<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    protected $table = 'gaji';

    protected $primaryKey = 'id_gaji';

    public $timestamps = false; 

    protected $fillable = [ 
        'id_karyawan',
        'id_potongan',
        'id_jabatan',
        'gaji_pokok',
        'tunjangan_transport',
        'tunjangan_makan',
        'tunjangan_sakit',
        'tunjangan_kompensasi',
        'tunjangan_cuti',
    ];
    
}
