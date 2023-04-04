<?php

namespace App\Http\Controllers\Personalia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Personalia\Divisi;
use App\Models\Personalia\Jabatan;
use App\Models\Personalia\Karyawan;
use App\Models\Personalia\Absensi;
use App\Models\Keuangan\Gaji;
use Faker\Factory as Faker;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\KaryawanImport;

class ManagementController extends Controller
{
    public function showDivisi(){
        $divisi = Divisi::all();
        return view('personalia.divisi', [
            'data' => $divisi
        ]);
    }

    public function addDivisi(){
        return view('personalia.tambahdivisi');
    }

    public function storeDivisi(Request $request){
        $this->validate($request, [
            'nama_divisi'      => 'required'
        ]);

        Divisi::create([
            'nama_divisi'          => $request->nama_divisi,
        ]);
        $request->session()->flash('info', 'Tambah Divisi Berhasil');
        return redirect('/personalia/dashboard');
    }

    public function editDivisi($id){
        $divisi = Divisi::find($id);
        return view('personalia.editdivisi', [
            'data' => $divisi
        ]);
    }

    public function updateDivisi(Request $request, $id){
        $this->validate($request, [
            'nama_divisi'      => 'required'
        ]);

        $data                 = Divisi::find($id);
        $data->nama_divisi    = $request->nama_divisi;
        $data->save();

        $request->session()->flash('info', 'Edit Divisi Berhasil');
        return redirect('/personalia/dashboard');
    }

    public function deleteDivisi($id){
        $data = Divisi::find($id);
        $data->delete();
        return redirect('/personalia/dashboard');
    }

    public function showJabatan(){
        $jabatan = Jabatan::all();
        return view('personalia.jabatan', [
            'data' => $jabatan
        ]);
    }

    public function addJabatan(){
        $divisi = Divisi::all();
        return view('personalia.tambahjabatan', [
            'data' => $divisi
        ]);
    }

    public function storeJabatan(Request $request){
        // $this->validate($request, [
        //     'jabatan'     => 'required',
        // ]);

        Jabatan::create([
            'nama_jabatan'       => $request->nama_jabatan,
        ]);

        $request->session()->flash('info', 'Tambah Jabatan Berhasil');
        return redirect('/personalia/jabatan');
    }

    public function editJabatan($id){
        $jabatan = Jabatan::find($id);
        return view('personalia.editjabatan', [
            'data' => $jabatan
        ]);
    }

    public function updateJabatan(Request $request, $id){
        $this->validate($request, [
            'nama_jabatan'      => 'required'
        ]);

        $data                 = Jabatan::find($id);
        $data->nama_jabatan   = $request->nama_jabatan;
        $data->save();

        $request->session()->flash('info', 'Edit Jabatan Berhasil');
        return redirect('/personalia/jabatan');
    }

    public function deleteJabatan($id){
        $data = Jabatan::find($id);
        $data->delete();
        return redirect('/personalia/jabatan');
    }

    public function showKaryawan(){
        $karyawan = Karyawan::all();
        return view('personalia.karyawan', [
            'data' => $karyawan
        ]);
    }

    public function addKaryawan(){
        $jabatan = Jabatan::all();
        $divisi = Divisi::all();
        return view('personalia.tambahkaryawan',[
            'jabatan' => $jabatan,
            'divisi' => $divisi
        ]);
    }

    public function storeKaryawan(Request $request){

        $this->validate($request, [
            'nama_karyawan'      => 'required',
            'jkel'               => 'required',
            'tempat_lahir'       => 'required',
            // 'tanggal_lahir'      => 'required|date',
            'telepon'            => 'required',
            'agama'              => 'required',
            'status_nikah'       => 'required',
            'divisi'             => 'required',
            'jabatan'            => 'required',
            'alamat'             => 'required',
            'tanggungan_anak'    => 'required',
            // 'tanggal_perekrutan' => 'required|date',
            'tempat_perekrutan'  => 'required',
        ]);

        //tahun+ id_divisi+ id_jabatan+ no urut
        $count = Karyawan::count('id_karyawan')+1;
        $nip = date('Y').$request->divisi.$request->jabatan.$count;
        Karyawan::create([
            'nip'                => $nip,
            'nama_karyawan'      => $request->nama_karyawan,
            'jkel'               => $request->jkel,
            'tempat_lahir'       => $request->tempat_lahir,
            'tanggal_lahir'      => $request->tanggal_lahir,
            'telepon'            => $request->telepon,
            'agama'              => $request->agama,
            'status_nikah'       => $request->status_nikah,
            'id_divisi'          => $request->divisi,
            'id_jabatan'         => $request->jabatan,
            'alamat'             => $request->alamat,
            'tanggungan_anak'    => $request->tanggungan_anak,
            'tanggal_perekrutan' => $request->tanggal_perekrutan,
            'tempat_perekrutan'  => $request->tempat_perekrutan,
        ]);

        if($request->jabatan == 1){
            $cuan = 4150000;
        }elseif($request->jabatan == 2){
            $cuan = 4750000;
        }elseif($request->jabatan == 3){
            $cuan = 5000000;
        }elseif($request->jabatan == 4){
            $cuan = 7000000;
        }elseif($request->jabatan == 5){
            $cuan = 8600000;
        }elseif($request->jabatan == 6){
            $cuan = 10000000;
        }elseif($request->jabatan == 7){
            $cuan = 13750000;
        }elseif($request->jabatan == 8){
            $cuan = 18000000;
        }elseif($request->jabatan == 9){
            $cuan = 23500000;
        }else{
            $cuan = 30000000;
        };
        $id_kar = Karyawan::all('id_karyawan')->last();
        $id_kar2 = $id_kar->id_karyawan;
        Gaji::create([
            'id_karyawan'           => $id_kar2,
            'id_jabatan'            => $request->jabatan,
            'gaji_pokok'            => $cuan,
            'tunjangan_transport'   => 230000,
            'tunjangan_makan'       => 300000,
            'tunjangan_sakit'       => 0,
            'tunjangan_kompensasi'  => 0,
            'tunjangan_cuti'        => 0,
        ]);

        $request->session()->flash('info', 'Tambah Karyawan Berhasil');
        return redirect('/personalia/karyawan');

    }

    public function editKaryawan($id){
        $karyawan = Karyawan::find($id);
        // dd($karyawan);
        $jabatan = Jabatan::all();
        $divisi = Divisi::all();
        // $jabatan = Jabatan::join('divisi', 'jabatan.id_divisi', '=', 'divisi.id_divisi')->get();
        return view('personalia.editkaryawan', [
            'data' => $karyawan,
            'jabatan' => $jabatan,
            'divisi' => $divisi
        ]);
    }

    public function updateKaryawan($id, Request $request){
        $this->validate($request, [
            'nama_karyawan'      => 'required',
            'jkel'               => 'required',
            'tempat_lahir'       => 'required',
            // 'tanggal_lahir'      => 'required|date',
            'telepon'            => 'required',
            'agama'              => 'required',
            'status_nikah'       => 'required',
            'divisi'             => 'required',
            'jabatan'            => 'required',
            'alamat'             => 'required',
            'tanggungan_anak'    => 'required',
            // 'tanggal_perekrutan' => 'required|date',
            'tempat_perekrutan'  => 'required',
        ]);

        $data                        = Karyawan::find($id);
        $data->nama_karyawan         = $request->nama_karyawan;
        $data->jkel                  = $request->jkel;
        $data->tempat_lahir          = $request->tempat_lahir;
        $data->tanggal_lahir         = $request->tanggal_lahir;
        $data->telepon               = $request->telepon;
        $data->agama                 = $request->agama;
        $data->status_nikah          = $request->status_nikah;
        $data->id_divisi             = $request->divisi;
        $data->id_jabatan            = $request->jabatan;
        $data->alamat                = $request->alamat;
        $data->tanggungan_anak       = $request->tanggungan_anak;
        $data->tanggal_perekrutan    = $request->tanggal_perekrutan;
        $data->tempat_perekrutan     = $request->tempat_perekrutan;
        $data->save();

        if($request->jabatan == 1){
            $cuan = 4150000;
        }elseif($request->jabatan == 2){
            $cuan = 4750000;
        }elseif($request->jabatan == 3){
            $cuan = 5000000;
        }elseif($request->jabatan == 4){
            $cuan = 7000000;
        }elseif($request->jabatan == 5){
            $cuan = 8600000;
        }elseif($request->jabatan == 6){
            $cuan = 10000000;
        }elseif($request->jabatan == 7){
            $cuan = 13750000;
        }elseif($request->jabatan == 8){
            $cuan = 18000000;
        }elseif($request->jabatan == 9){
            $cuan = 23500000;
        }else{
            $cuan = 30000000;
        };
        $gaji                        = Gaji::find($id);
        $gaji->id_jabatan            = $request->jabatan;
        $gaji->gaji_pokok            = $cuan;
        $gaji->tunjangan_transport   = 230000;
        $gaji->tunjangan_makan       = 300000;
        $gaji->tunjangan_sakit       = 0;
        $gaji->tunjangan_kompensasi  = 0;
        $gaji->tunjangan_cuti        = 0;
        $gaji->save();

        $request->session()->flash('info', 'Karyawan Berhasil Diubah');
        return redirect('/personalia/karyawan');
    }

    public function deleteKaryawan($id){
        $karyawan = Karyawan::find($id)->first();
        $karyawan->delete();

        return redirect('/personalia/karyawan')->with([
            'danger' => 'Karyawan Berhasil Dihapus'
        ]);
    }

    //import excel
    public function import(){
        return view('personalia.import');
    }

    public function storeImport(Request $request){
        $this->validate($request, [
            'file'      => 'required',
        ]);
        $file = $request->file('file');
        Excel::import(new KaryawanImport, $request->file);

        return redirect('/personalia/karyawan')->with('success', 'Data Karyawan Berhasil Diimport');
    }

}
