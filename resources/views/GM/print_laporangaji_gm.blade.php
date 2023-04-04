<!DOCTYPE html>
<html>

<head>
  <style>
    table,
    th,
    td {
      border: 1px solid black;
      border-collapse: collapse;
    }
  </style>
</head>

<body>

  <h2 style="text-align:center">PT. INDOTIRTA SUAKA LIVESTOCK</h2>
  <p style="text-align:center">Laporan Gaji Karyawan {{$bulan_gaji}}  {{$tahun_gaji}}</p>

  <table style="width:100%">
    <tr>
      <th style="text-align:center">No</th>
      <th style="text-align:center">Nama Karyawan</th>
      <th style="text-align:center">Divisi</th>
      <th style="text-align:center">Jabatan</th>
      <th style="text-align:center">Gaji Pokok</th>
      <th style="text-align:center">Total Tunjangan</th>
      <th style="text-align:center">Total Potongan</th>
      <th style="text-align:center">Gaji Bersih</th>
    </tr>
    <?php
    $no = 1;
    ?>
    @foreach ($data as $data)
    
    <tr>
      <td style="text-align:center">{{$no++}}</td>
      <td>{{$data->nama_karyawan}}</td>
      <td>{{$data->nama_divisi}}</td>
      <td>{{$data->nama_jabatan}}</td>
      <td style="text-align:left">Rp {{ number_format($data->total_gapok,0,',','.') }}</td>
      <td style="text-align:left">Rp {{ number_format($data->total_tunjangan,0,',','.') }}</td>
      <td style="text-align:left">Rp {{ number_format($data->total_potongan,0,',','.') }}</td>
      <td style="text-align:left">Rp {{ number_format($data->gaji_bersih_bulan,0,',','.') }}</td>
    </tr>
    @endforeach
    <tr>
      <th colspan="7">Total Penggajian Karyawan</th>
      <th style="text-align:right">Rp {{ number_format($total_gaji,0,',','.') }}</th>
    </tr>
  </table>
</body>

</html>