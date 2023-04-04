<?php

namespace App\Http\Controllers\GM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keuangan\Gaji;
use App\Models\Keuangan\Transaksi;
use App\Models\Personalia\Karyawan;
use App\Models\Personalia\Divisi;
use App\Models\Personalia\Jabatan;
use PDF;

class ManagementController extends Controller
{
    public function showGaji(){
        $gaji = Karyawan::join('divisi', 'karyawan.id_divisi', '=', 'divisi.id_divisi')
        ->join('jabatan', 'karyawan.id_jabatan', '=', 'jabatan.id_jabatan')
        ->join('gaji', 'karyawan.id_karyawan', '=', 'gaji.id_karyawan')
        ->get();
        return view('GM.validasi_slip_gaji', [
            'data' => $gaji
        ]);
    }

    public function validateGaji(Request $request){
        $gaji = Karyawan::join('gaji','karyawan.id_karyawan','=','gaji.id_karyawan')
        ->join('transaksi','karyawan.id_karyawan','=','transaksi.id_karyawan')
        ->where('transaksi.status_gaji','=',0)
        ->get();

        $transaksi = Transaksi::count();
            foreach($gaji as $g){
                //Pendapatan
                $total_gapok                = $g->gaji_pokok;
                $total_tunjangan_transport  = $g->tunjangan_transport;
                $total_tunjangan_makan      = $g->tunjangan_makan;
                $total_tunjangan_sakit      = $g->tunjangan_sakit;
                $total_tunjangan_kompensasi = $g->tunjangan_kompensasi;
                $total_tunjangan_cuti       = $g->tunjangan_cuti;
                $total_tunjangan            = $total_tunjangan_transport + $total_tunjangan_makan + $total_tunjangan_sakit + $total_tunjangan_kompensasi + $total_tunjangan_cuti;
                $gaji_kotor                 = $total_gapok + $total_tunjangan;
                
                //Pengurangan/Potongan
                if($gaji_kotor*0.05>=500000){
                    $total_biaya_jabatan    = 500000;
                }else{
                    $total_biaya_jabatan    = $gaji_kotor * 0.05;
                }
                $total_jht                  = $total_gapok * 0.02;
                $total_jp                   = $total_gapok * 0.01;
                $total_potongan             = $total_biaya_jabatan + $total_jht + $total_jp;
    
                //Gaji Bersih
                $gaji_bersih_bulan          = $gaji_kotor - $total_potongan;
                $gaji_bersih_tahun          = $gaji_bersih_bulan * 12;
    
                //Penghasilan Tidak Kena Pajak
                if($g->status_nikah == "Belum Menikah" || $g->status_nikah == "Duda" || $g->status_nikah == "Janda" && $g->tanggungan_anak == 0){
                    $pkp = $gaji_bersih_tahun - 54000000;
                }else if($g->status_nikah == "Belum Menikah" || $g->status_nikah == "Duda" || $g->status_nikah == "Janda" && $g->tanggungan_anak == 1){
                    $pkp = $gaji_bersih_tahun - 58500000;
                }else if($g->status_nikah == "Belum Menikah" || $g->status_nikah == "Duda" || $g->status_nikah == "Janda" && $g->tanggungan_anak == 2){
                    $pkp = $gaji_bersih_tahun - 63000000;
                }else if($g->status_nikah == "Belum Menikah" || $g->status_nikah == "Duda" || $g->status_nikah == "Janda" && $g->tanggungan_anak == 3){
                    $pkp = $gaji_bersih_tahun - 67500000;
                }else if($g->status_nikah == "Menikah" && $g->tanggungan_anak == 0){
                    $pkp = $gaji_bersih_tahun - 58500000;
                }else if($g->status_nikah == "Menikah" && $g->tanggungan_anak == 1){
                    $pkp = $gaji_bersih_tahun - 63000000;
                }else if($g->status_nikah == "Menikah" && $g->tanggungan_anak == 2){
                    $pkp = $gaji_bersih_tahun - 67500000;
                }else{
                    $pkp = $gaji_bersih_tahun - 72000000;
                }
    
                //Pph 21
                if($pkp <= 50000000){
                    $pph21 = $pkp * 0.05;
                }else if($pkp >=50000001 || $pkp<=250000000){
                    $tahap1 = $pkp - 50000000;
                    $hitung1 = 2500000;
                    $hitung2 = $tahap1 * 0.15;
                    $pph21 = $hitung1 + $hitung2;
                }else if($pkp >=250000001 || $pkp<=500000000){
                    $tahap1 = $pkp - 250000000;
                    $hitung1 = 2500000;
                    $hitung2 = 30000000;
                    $hitung3 = $tahap1 * 0.25;
                    $pph21 = $hitung1 + $hitung2 + $hitung3;
                }else{
                    $tahap1 = $pkp - 500000000;
                    $hitung1 = 2500000;
                    $hitung2 = 30000000;
                    $hitung3 = 62500000;
                    $hitung4 = $tahap1 * 0.3;
                    $pph21 = $hitung1 + $hitung2 + $hitung3 + $hitung4;
                }

                if($pph21<=0){
                    $pph21_fix = 0;
                }else{
                    $pph21_fix = $pph21;
                }

                $data                              = Transaksi::find($g->id_trans);
                $data->id_karyawan                 = $g->id_karyawan;
                $data->total_gapok                 = $total_gapok;
                $data->total_tunjangan_transport   = $total_tunjangan_transport;
                $data->total_tunjangan_makan       = $total_tunjangan_makan;
                $data->total_tunjangan_sakit       = $total_tunjangan_sakit;
                $data->total_tunjangan_kompensasi  = $total_tunjangan_kompensasi;
                $data->total_tunjangan_cuti        = $total_tunjangan_cuti;
                $data->total_tunjangan             = $total_tunjangan;
                $data->gaji_kotor                  = $gaji_kotor;
                $data->total_biaya_jabatan         = $total_biaya_jabatan;
                $data->total_jht                   = $total_jht;
                $data->total_jp                    = $total_jp;
                $data->total_potongan              = $total_potongan;
                $data->gaji_bersih_bulan           = $gaji_bersih_bulan;
                $data->gaji_bersih_tahun           = $gaji_bersih_tahun;
                $data->pph21_tahun                 = $pph21_fix;
                $data->pph21_bulan                 = $pph21_fix / 12;
                $data->status_gaji                 = 1;
                $data->save();
            }
        
        $request->session()->flash('info', 'Slip Gaji Berhasil Divalidasi');
        return redirect('/gm/dashboard');
    }

    public function showLaporanGaji(){
        return view('GM.laporangaji');
    }

    public function printLaporanGaji(Request $request){
        $transaksi = Transaksi::join('karyawan','karyawan.id_karyawan','=','transaksi.id_karyawan')
        ->join('jabatan','jabatan.id_jabatan','=','karyawan.id_jabatan')
        ->join('divisi','divisi.id_divisi','=','karyawan.id_divisi')
        ->where('transaksi.bulan_gaji','=',$request->bulan)
        ->where('transaksi.tahun_gaji','=',$request->tahun)
        ->get();

        $total_gaji = 0;
        $total_gaji = Transaksi::sum('gaji_bersih_bulan');
        $bulan_gaji = $request->bulan;
        $tahun_gaji = $request->tahun;

        $all = count($transaksi);
        
        
        if($all != 0){
            $pdf = PDF::loadView('GM.print_laporangaji_gm', [
                'data' => $transaksi,
                'total_gaji' => $total_gaji,
                'bulan_gaji' => $bulan_gaji,
                'tahun_gaji' => $tahun_gaji,
            ]);
    
            return $pdf->download('laporan_gaji.pdf');

        }else{
            $request->session()->flash('danger', 'Data Laporan Gaji Tidak Ditemukan');
            return redirect('/gm/laporan');            
        }
    }

    public function showLaporanPajak(){
        return view('GM.laporanpajak');
    }

    public function printLaporanPajak(Request $request){
        $transaksi = Transaksi::join('karyawan','karyawan.id_karyawan','=','transaksi.id_karyawan')
        ->join('jabatan','jabatan.id_jabatan','=','karyawan.id_jabatan')
        ->join('divisi','divisi.id_divisi','=','karyawan.id_divisi')
        ->where('transaksi.bulan_gaji','=',$request->bulan)
        ->where('transaksi.tahun_gaji','=',$request->tahun)
        ->get();

        $total_gaji = 0;
        $total_pajak = Transaksi::sum('pph21_bulan');
        $bulan_gaji = $request->bulan;
        $tahun_gaji = $request->tahun;


        // return view('GM.print_laporangaji_gm', [
        //     'data' => $transaksi,
        //     'total_gaji' => $total_gaji,
        // ]);

        $all = count($transaksi);
        
        
        if($all != 0){
            $pdf = PDF::loadView('GM.print_laporanpajak_gm', [
                'data' => $transaksi,
                'total_pajak' => $total_pajak,
                'bulan_gaji' => $bulan_gaji,
                'tahun_gaji' => $tahun_gaji,
            ]);
    
            return $pdf->download('laporan_pajak.pdf');

        }else{
            $request->session()->flash('danger', 'Data Laporan Pajak Tidak Ditemukan');
            return redirect('/gm/pajak');            
        }
    }
}
