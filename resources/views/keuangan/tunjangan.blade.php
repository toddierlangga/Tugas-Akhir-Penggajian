@extends('layouts.app')

@section('title', 'Daftar Tunjangan')

@section('content')
@foreach (['danger', 'warning', 'success', 'info'] as $msg)
@if(Session::has($msg))
<p class="alert alert-{{ $msg }}">{{ Session::get($msg) }} <a href="#" class="close" data-dismiss="alert"
        aria-label="close">&times;</a></p>
@endif
@endforeach
<div class="col-md-12">
    <div class="card">
        <form method="POST" action="{{route('store_karyawan')}}" class="form-horizontal">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Tunjangan</h4>
                <div class="toolbar text-right">
                    <a href="{{ route('create_slip_gaji') }}"><button type="button" class="btn btn-danger">Buat slip
                            gaji <i class="material-icons">add</i></button></a>
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                        width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>NIP</th>
                                <th>Nama Karyawan</th>
                                <th>Divisi</th>
                                <th>Jabatan</th>
                                <th>Gaji</th>
                                <th>Tunjangan Transport</th>
                                <th>Tunjangan Makan</th>
                                <th>Tunjangan Sakit</th>
                                <th>Tunjangan Kompensasi</th>
                                <th>Tunjangan Cuti</th>
                                <th class="disabled-sorting text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $data)
                            <tr>
                                <td>{{ $data->nip }}</td>
                                <td>{{ $data->nama_karyawan }}</td>
                                <td>{{ $data->nama_divisi }}</td>
                                <td>{{ $data->nama_jabatan }}</td>
                                <td>Rp {{ number_format($data->gaji_pokok,0,',','.') }}</td>
                                <td>Rp {{ number_format($data->tunjangan_transport,0,',','.') }}</td>
                                <td>Rp {{ number_format($data->tunjangan_makan,0,',','.') }}</td>
                                <td>Rp {{ number_format($data->tunjangan_sakit,0,',','.') }}</td>
                                <td>Rp {{ number_format($data->tunjangan_kompensasi,0,',','.') }}</td>
                                <td>Rp {{ number_format($data->tunjangan_cuti,0,',','.') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('edit_tunjangan', $data->id_karyawan) }}"
                                        class="btn btn-simple btn-warning btn-icon edit"><i
                                            class="material-icons">dvr</i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
        <!-- end content-->
    </div>
    <!--  end card  -->
</div>
@push('script')
<script>
    $('.remove').on('click', function (event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Apakah anda yakin?',
                text: 'Data yang telah di hapus tidak dapat dikembalikan!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus data!',
                cancelButtonText: 'Tidak, Biarkan data',
                confirmButtonClass: "btn btn-success",
                cancelButtonClass: "btn btn-danger",
                buttonsStyling: false
            }).then(function (value) {
                swal({
                    title: 'Data terhapus!',
                    text: 'Data berhasil dihapus!.',
                    type: 'success',
                    confirmButtonClass: "btn btn-success",
                    buttonsStyling: false
                })
                setTimeout(function() {
                if (value) {
                    window.location.href = url;}
                }, 2000);

            }, function (dismiss) {
                // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
                if (dismiss === 'cancel') {
                    swal({
                        title: 'Dibatalkan',
                        text: 'Data tidak terhapus :)',
                        type: 'error',
                        confirmButtonClass: "btn btn-info",
                        buttonsStyling: false
                    })
                }
            })
        });
</script>
@endpush
@endsection