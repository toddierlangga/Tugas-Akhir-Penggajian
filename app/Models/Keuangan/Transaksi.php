<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $primaryKey = 'id_trans';

    public $timestamps = false; 

    protected $fillable = [ 
        'id_karyawan',
        'id_potongan',
        'total_gapok',
        'total_tunjangan_transport',
        'total_tunjangan_makan',
        'total_tunjangan_sakit',
        'total_tunjangan_kompensasi',
        'total_tunjangan_cuti',
        'total_tunjangan',
        'gaji_kotor',
        'total_biaya_jabatan',
        'total_jht',
        'total_jp',
        'total_potongan',
        'gaji_bersih_bulan',
        'gaji_bersih_tahun',
        'pph21_tahun',
        'pph21_bulan',
        'status_gaji',
        'bulan_gaji',
        'tahun_gaji',
    ];
}
