<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keuangan\Gaji;
use App\Models\Keuangan\Transaksi;
use App\Models\Personalia\Karyawan;
use App\Models\Personalia\Divisi;
use App\Models\Personalia\Jabatan;
use PDF;

use DB;

class ManagementController extends Controller
{
    public function showTunjangan(){
        $gaji = Karyawan::join('divisi', 'karyawan.id_divisi', '=', 'divisi.id_divisi')
        ->join('jabatan', 'karyawan.id_jabatan', '=', 'jabatan.id_jabatan')
        ->join('gaji', 'karyawan.id_karyawan', '=', 'gaji.id_karyawan')
        ->get();
        // dd($gaji);
        return view('keuangan.tunjangan', [
            'data' => $gaji
        ]);
    }

    public function editTunjangan($id){
        $karyawan = Karyawan::find($id);
        $tunjangan = Karyawan::join('divisi', 'karyawan.id_divisi', '=', 'divisi.id_divisi')
        ->join('jabatan', 'karyawan.id_jabatan', '=', 'jabatan.id_jabatan')
        ->join('gaji', 'karyawan.id_karyawan', '=', 'gaji.id_karyawan')
        ->where('karyawan.id_karyawan', $id)
        ->first();

        // dd($tunjangan);
        // dd($tunjangan);
        // $jabatan = Jabatan::all();
        // $divisi = Divisi::all();
        return view('keuangan.edittunjangan', [
            'data' => $karyawan,
            'tunjangan' => $tunjangan
        ]);
    }

    public function updateTunjangan($id, Request $request){
        // $this->validate($request, [
        //     'tunjangan_sakit'       => 'required',
        //     'tunjangan_kompensasi'  => 'required',
        //     'tunjangan_cuti'        => 'required',
        //     'tunjangan_transport'   => 'required',
        //     'tunjangan_makan'       => 'required',
        // ]);

        // echo $request->tunjangan_sakit;
        // die();
        // if($request->tunjangan_transport!=null){ 
        $gabung = Karyawan::join('gaji', 'karyawan.id_karyawan', '=', 'gaji.id_karyawan')
                            ->where('karyawan.id_karyawan', $id)
                            ->first();

        if($request->tunjangan_transport == null){
        DB::table('gaji')
            ->where('id_karyawan', $id)
            ->update([
                'tunjangan_sakit'=> $request->tunjangan_sakit,
                'tunjangan_kompensasi' => $request->tunjangan_kompensasi,
                'tunjangan_cuti' => $request->tunjangan_cuti,
            ]);
        }else{
            DB::table('gaji')
            ->where('id_karyawan', $id)
            ->update([
                'tunjangan_transport' => $request->tunjangan_transport,
                'tunjangan_makan' => $request->tunjangan_makan,
                'tunjangan_sakit' => $request->tunjangan_sakit,
                'tunjangan_kompensasi' => $request->tunjangan_kompensasi,
                'tunjangan_cuti' => $request->tunjangan_cuti,
            ]);
        }

       
        $request->session()->flash('info', 'Edit Tunjangan Berhasil');
        return redirect('/keuangan/dashboard');
    }

    public function storeSlipGaji(Request $request){
        
        $transaksi = Transaksi::count();
        $bulan_gaji = date('F');
        $tahun_gaji = date('Y');
        $bulan_tahun = Transaksi::all()->last();

        if($transaksi == 0){
            // echo ('Tidak ada transaksi dan harus create');
            // die();
            $gaji = Karyawan::join('gaji','karyawan.id_karyawan','=','gaji.id_karyawan')
            ->get();
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
                
                $data = Transaksi::create([
                    'id_karyawan'                  => $g->id_karyawan,
                    'total_gapok'                  => $total_gapok,
                    'total_tunjangan_transport'    => $total_tunjangan_transport,
                    'total_tunjangan_makan'        => $total_tunjangan_makan,
                    'total_tunjangan_sakit'        => $total_tunjangan_sakit,
                    'total_tunjangan_kompensasi'   => $total_tunjangan_kompensasi,
                    'total_tunjangan_cuti'         => $total_tunjangan_cuti,
                    'total_tunjangan'              => $total_tunjangan,
                    'gaji_kotor'                   => $gaji_kotor,
                    'total_biaya_jabatan'          => $total_biaya_jabatan,
                    'total_jht'                    => $total_jht,
                    'total_jp'                     => $total_jp,
                    'total_potongan'               => $total_potongan,
                    'gaji_bersih_bulan'            => $gaji_bersih_bulan,
                    'gaji_bersih_tahun'            => $gaji_bersih_tahun,
                    'pph21_tahun'                  => $pph21_fix,
                    'pph21_bulan'                  => $pph21_fix / 12,
                    'status_gaji'                  => 0,
                    'bulan_gaji'                   => $bulan_gaji,
                    'tahun_gaji'                   => $tahun_gaji,
                ]);
            }
        }elseif($bulan_tahun->bulan_gaji == date('F') && $bulan_tahun->tahun_gaji == date('Y')){
            // echo ('Update transaksi bulan dan tahun gaji sama ');
            // die();
            $gaji = Karyawan::join('gaji','karyawan.id_karyawan','=','gaji.id_karyawan')
            ->join('transaksi','karyawan.id_karyawan','=','transaksi.id_karyawan')
            ->get();
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
                    $data->status_gaji                 = 0;
                    $data->save();
            }
        }else{
            // echo ('Transaksi ada tapi bulan atau tahun gaji tidak sama');
            // die();
            $gaji = Karyawan::join('gaji','karyawan.id_karyawan','=','gaji.id_karyawan')
            ->join('transaksi','karyawan.id_karyawan','=','transaksi.id_karyawan')
            ->get();
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
                $data = Transaksi::create([
                    'id_karyawan'                  => $g->id_karyawan,
                    'total_gapok'                  => $total_gapok,
                    'total_tunjangan_transport'    => $total_tunjangan_transport,
                    'total_tunjangan_makan'        => $total_tunjangan_makan,
                    'total_tunjangan_sakit'        => $total_tunjangan_sakit,
                    'total_tunjangan_kompensasi'   => $total_tunjangan_kompensasi,
                    'total_tunjangan_cuti'         => $total_tunjangan_cuti,
                    'total_tunjangan'              => $total_tunjangan,
                    'gaji_kotor'                   => $gaji_kotor,
                    'total_biaya_jabatan'          => $total_biaya_jabatan,
                    'total_jht'                    => $total_jht,
                    'total_jp'                     => $total_jp,
                    'total_potongan'               => $total_potongan,
                    'gaji_bersih_bulan'            => $gaji_bersih_bulan,
                    'gaji_bersih_tahun'            => $gaji_bersih_tahun,
                    'pph21_tahun'                  => $pph21_fix,
                    'pph21_bulan'                  => $pph21_fix / 12,
                    'status_gaji'                  => 0,
                    'bulan_gaji'                   => $bulan_gaji,
                    'tahun_gaji'                   => $tahun_gaji,
                ]);
            }
        }
        $request->session()->flash('info', 'Data Gaji Berhasil Diproses');
        return redirect('/keuangan/dashboard');
    }

    public function showGaji(){
        $gaji = Transaksi::join('karyawan','karyawan.id_karyawan','=','transaksi.id_karyawan')
        ->join('jabatan','jabatan.id_jabatan','=','karyawan.id_jabatan')
        ->join('divisi','karyawan.id_divisi','=','divisi.id_divisi')
        ->get();
        // Karyawan::join('divisi', 'karyawan.id_divisi', '=', 'divisi.id_divisi')
        // ->join('jabatan', 'karyawan.id_jabatan', '=', 'jabatan.id_jabatan')
        // ->get();
        return view('keuangan.slipgaji', [
            'data' => $gaji
        ]);
    }

    public function printGaji($id){
        $karyawan = Karyawan::find($id);
        $gaji = Karyawan::join('transaksi','karyawan.id_karyawan', '=', 'transaksi.id_karyawan')
        ->join('divisi', 'karyawan.id_divisi', '=', 'divisi.id_divisi')
        ->join('jabatan', 'karyawan.id_jabatan', '=', 'jabatan.id_jabatan')
        ->where('karyawan.id_karyawan', $id)
        ->first();
        $data = [
            'data'                 => $karyawan,
            'nip'                  => $gaji->nip,
            'nama_karyawan'        => $gaji->nama_karyawan,
            'nama_divisi'          => $gaji->nama_divisi,
            'nama_jabatan'         => $gaji->nama_jabatan,
            'gaji_pokok'           => $gaji->total_gapok,
            'tunjangan_transport'  => $gaji->total_tunjangan_transport,
            'tunjangan_makan'      => $gaji->total_tunjangan_makan,
            'tunjangan_sakit'      => $gaji->total_tunjangan_sakit,
            'tunjangan_kompensasi' => $gaji->total_tunjangan_kompensasi,
            'tunjangan_cuti'       => $gaji->total_tunjangan_cuti,
            'gaji_kotor'           => $gaji->gaji_kotor,
            'gaji_bersih_bulan'    => $gaji->gaji_bersih_bulan,
            'biaya_jabatan'        => $gaji->total_biaya_jabatan,
            'jht'                  => $gaji->total_jht,
            'jp'                   => $gaji->total_jp,
            'total_potongan'       => $gaji->total_potongan,
            'bulan_gaji'           => $gaji->bulan_gaji,
            'tahun_gaji'           => $gaji->tahun_gaji,
        ];

        // dd($data);

        // return view('keuangan.printout_gaji');

        $pdf = PDF::loadView('keuangan.printout_gaji', $data);

        return $pdf->download('slip_gaji.pdf');
    }
}
