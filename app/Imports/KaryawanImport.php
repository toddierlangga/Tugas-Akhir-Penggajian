<?php

namespace App\Imports;

use App\Models\Personalia\Karyawan;
use App\Models\Personalia\Divisi;
use App\Models\Personalia\Jabatan;
use App\Models\Keuangan\Gaji;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class KaryawanImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        $divisi = Divisi::all();
        foreach($divisi as $data){
           if($data->nama_divisi == $row[8]){
                $divisi_id = $data->id_divisi;
            
                $jabatan = Jabatan::all();
                foreach($jabatan as $data){
                if($data->nama_jabatan == $row[9]){
                $jabatan_id = $data->id_jabatan;

                $count = Karyawan::count('id_karyawan')+1;
                $nip = date('Y').$divisi_id.$jabatan_id.$count;
        
                Karyawan::create([           
                    'id_jabatan'         => $jabatan_id,
                    'id_divisi'          => $divisi_id,
                    'nip'                => $nip,
                    'nama_karyawan'      => $row[0],
                    'jkel'               => $row[1],
                    'tempat_lahir'       => $row[2],
                    'tanggal_lahir'      => $row[3],
                    'telepon'            => $row[4],
                    'agama'              => $row[5],
                    'status_nikah'       => $row[6],
                    'alamat'             => $row[7],
                    'tanggungan_anak'    => $row[10],
                    'tanggal_perekrutan' => $row[11],
                    'tempat_perekrutan'  => $row[12],
                ]);

                if($jabatan_id == 1){
                    $cuan = 4150000;
                }elseif($jabatan_id == 2){
                    $cuan = 4750000;
                }elseif($jabatan_id == 3){
                    $cuan = 5000000;
                }elseif($jabatan_id == 4){
                    $cuan = 7000000;
                }elseif($jabatan_id == 5){
                    $cuan = 8600000;
                }elseif($jabatan_id == 6){
                    $cuan = 10000000;
                }elseif($jabatan_id == 7){
                    $cuan = 13750000;
                }elseif($jabatan_id == 8){
                    $cuan = 18000000;
                }elseif($jabatan_id == 9){
                    $cuan = 23500000;
                }else{
                    $cuan = 30000000;
                };
                $id_kar = Karyawan::all('id_karyawan')->last();
                $id_kar2 = $id_kar->id_karyawan;
                return new Gaji([
                    'id_karyawan'           => $id_kar2,
                    'id_divisi'             => $divisi_id,
                    'id_jabatan'            => $jabatan_id,
                    'gaji_pokok'            => $cuan,
                    'tunjangan_transport'   => 230000,
                    'tunjangan_makan'       => 300000,
                    'tunjangan_sakit'       => 0,
                    'tunjangan_kompensasi'  => 0,
                    'tunjangan_cuti'        => 0,
                ]);

                    }
                }

            }
        }
    }
}
