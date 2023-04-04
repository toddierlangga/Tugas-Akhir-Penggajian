@extends('layouts.app')

@section('title', 'Daftar Divisi')

@section('content')
@foreach (['danger', 'warning', 'success', 'info'] as $msg)
@if(Session::has($msg))
<p class="alert alert-{{ $msg }}">{{ Session::get($msg) }} <a href="#" class="close" data-dismiss="alert"
        aria-label="close">&times;</a></p>
@endif
@endforeach
<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-icon" data-background-color="purple">
            <i class="material-icons">assignment</i>
        </div>
        <div class="card-content">
            <h4 class="card-title">Divisi</h4>
            <div class="toolbar text-right">
                <a href="{{ route('add_divisi') }}"><button type="button" class="btn btn-danger">Tambah Divisi <i
                            class="material-icons">add</i></button></a>
            </div>
            <div class="material-datatables">
                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                    width="100%" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama Divisi</th>
                            <th class="disabled-sorting text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $data)
                        <tr>
                            <td>{{ $data->nama_divisi }}</td>
                            <td class="text-center">
                                <a href="{{ route('edit_divisi', $data->id_divisi) }}"
                                    class="btn btn-simple btn-warning btn-icon edit"><i
                                        class="material-icons">dvr</i></a>
                                <a href="{{ route('hapus_divisi', $data->id_divisi) }}"
                                    class="btn delete-confirm btn-simple btn-danger btn-icon remove"><i
                                        class="material-icons">close</i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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