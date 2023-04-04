<!DOCTYPE html>
<html lang="en">

<head>
  <style>
    table,
    th {
      border: 1px solid black;
      border-collapse: collapse;
    }
  </style>
</head>

<body>
  <table style="width:100%">
    <tr>
      <td colspan="7" style="text-align:center"><img src="{{ public_path('logo_perusahaan_2.png') }}" /></td>
    </tr>
    <tr>
      <th colspan="7">Slip Gaji {{$bulan_gaji}} {{$tahun_gaji}}</th>
    </tr>
    <tr>
      <td>NIP</td>
      <td style="text-align:center">:</td>
      <td colspan="5">{{$data->nip}}</td>
    </tr>
    <tr>
      <td>Nama</td>
      <td style="text-align:center">:</td>
      <td colspan="5">{{$data->nama_karyawan}}</td>
    </tr>
    <tr>
      <td>Divisi</td>
      <td style="text-align:center">:</td>
      <td colspan="5">{{$nama_divisi}}</td>
    </tr>
    <tr>
      <td>Jabatan</td>
      <td style="text-align:center">:</td>
      <td colspan="5">{{$nama_jabatan}}</td>
    </tr>
    <tr>
      <td height="20" colspan="7"></td>
    </tr>
    <tr>
      <td style="text-align:left" colspan="4"><b>Penerimaan</b></td>
      <td style="text-align:left" colspan="3"><b>Potongan</b></td>
    </tr>
    <tr>
      <td>Gaji Pokok</td>
      <td style="text-align:center">:</td>
      <td style="text-align:right">Rp {{ number_format($gaji_pokok,0,',','.') }}</td>
      <td style="width:10%"></td>
      <td>Biaya Jabatan</td>
      <td style="text-align:center">:</td>
      <td style="text-align:right">Rp {{ number_format($biaya_jabatan,0,',','.') }}</td>
    </tr>
    <tr>
      <td>Tunjangan Transport</td>
      <td style="text-align:center">:</td>
      <td style="text-align:right">Rp {{ number_format($tunjangan_transport,0,',','.') }}</td>
      <td> </td>
      <td>Jaminan Hari Tua</td>
      <td style="text-align:center">:</td>
      <td style="text-align:right">Rp {{ number_format($jht,0,',','.') }}</td>
    </tr>
    <tr>
      <td>Tunjangan Makan</td>
      <td style="text-align:center">:</td>
      <td style="text-align:right">Rp {{ number_format($tunjangan_makan,0,',','.') }}</td>
      <td> </td>
      <td>Jaminan Pensiun</td>
      <td style="text-align:center">:</td>
      <td style="text-align:right">Rp {{ number_format($jp,0,',','.') }}</td>
    </tr>
    <tr>
      <td>Tunjangan Sakit</td>
      <td style="text-align:center">:</td>
      <td style="text-align:right">Rp {{ number_format($tunjangan_sakit,0,',','.') }}</td>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Tunjangan Kompensasi</td>
      <td style="text-align:center">:</td>
      <td style="text-align:right">Rp {{ number_format($tunjangan_kompensasi,0,',','.') }}</td>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Tunjangan Cuti</td>
      <td style="text-align:center">:</td>
      <td style="text-align:right">Rp {{ number_format($tunjangan_cuti,0,',','.') }}</td>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td height="20" colspan="7"></td>
    </tr>
    <tr>
      <td>Total Penerimaan</td>
      <td style="text-align:center">:</td>
      <td style="text-align:right">Rp {{ number_format($gaji_kotor,0,',','.') }}</td>
      <td> </td>
      <td>Total Potongan</td>
      <td style="text-align:center">:</td>
      <td style="text-align:right">Rp {{ number_format($total_potongan,0,',','.') }}</td>
    </tr>
    <tr>
      <th height="20" colspan="7"></th>
    </tr>
    <tr>
      <td>Gaji Bersih</td>
      <td style="text-align:center">:</td>
      <td style="text-align:right">Rp {{ number_format($gaji_bersih_bulan,0,',','.') }}</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td height="50" colspan="7"></td>
    </tr>
    <tr>
      <td style="text-align:center" colspan="3">PT. INDOTIRTA SUAKA LIVESTOCK</td>
      <td></td>
      <td style="text-align:center" colspan="3">Penerima</td>
    </tr>
    <tr>
      <td height="70" colspan="7"></td>
    </tr>
    <tr>
      <td style="text-align:center" colspan="3">General Manager HRD</td>
      <td></td>
      <td style="text-align:center" colspan="3">{{$data->nama_karyawan}}</td>
    </tr>
  </table>
</body>

</html>