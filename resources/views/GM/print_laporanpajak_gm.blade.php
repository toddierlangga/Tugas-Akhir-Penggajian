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
  <p style="text-align:center">Laporan Pajak Karyawan {{$bulan_gaji}}  {{$tahun_gaji}}</p>

  <table style="width:100%">
    <tr>
      <th style="text-align:center">NIP</th>
      <th style="text-align:center">Nama Karyawan</th>
      <th style="text-align:center">Status Nikah</th>
      <th style="text-align:center">Tanggungan Anak</th>
      <th style="text-align:center">Gaji Kotor</th>
      <th style="text-align:center">Total Potongan</th>
      <th style="text-align:center">Pph 21 per Bulan</th>
    </tr>
    @foreach ($data as $data)

    <tr>
      <td style="text-align:center">{{$data->nip}}</td>
      <td>{{$data->nama_karyawan}}</td>
      <td>{{$data->status_nikah}}</td>
      <td>{{$data->tanggungan_anak}}</td>
      <td style="text-align:left">Rp {{ number_format($data->gaji_kotor,0,',','.') }}</td>
      <td style="text-align:left">Rp {{ number_format($data->total_potongan,0,',','.') }}</td>
      <td style="text-align:left">Rp {{ number_format($data->pph21_bulan,0,',','.') }}</td>

    </tr>
    @endforeach
    <tr>
      <th colspan="6">Total Pajak Penghasilan Karyawan</th>
      <th style="text-align:right">Rp {{ number_format($total_pajak,0,',','.') }}</th>
    </tr>
  </table>
</body>

</html>