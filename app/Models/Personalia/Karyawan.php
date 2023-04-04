<?php

namespace App\Models\Personalia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';

    protected $primaryKey = 'id_karyawan';
    
    public $timestamps = false;

    protected $fillable = [
        'id_absensi',
        'id_jabatan',
        'id_divisi',
        'nip',
        'nama_karyawan',
        'jkel',
        'tempat_lahir',
        'tanggal_lahir',
        'telepon',
        'agama',
        'status_nikah',
        'alamat',
        'tanggungan_anak',
        'tanggal_perekrutan',
        'tempat_perekrutan',
    ];
}
