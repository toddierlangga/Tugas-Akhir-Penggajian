@extends('layouts.app')

@section('title', 'Edit Tunjangan dan Gaji')

@section('content')
@foreach (['danger', 'warning', 'success', 'info'] as $msg)
@if(Session::has($msg))
<p class="alert alert-{{ $msg }}">{{ Session::get($msg) }} <a href="#" class="close" data-dismiss="alert"
        aria-label="close">&times;</a></p>
@endif
@endforeach 
<div class="col-md-12">
    <div class="col-md-12">
        <div class="card">
            <form method="POST" action="{{route('update_tunjangan', $data->id_karyawan)}}" class="form-horizontal" >
                @csrf
                {{ method_field('PUT') }}
                <div class="card-header card-header-text" data-background-color="purple">
                    <h4 class="card-title">Form Edit Tunjangan dan Gaji</h4>
                </div>
                <div class="card-content">
                    <div class="row">
                        <div class="alert alert-warning alert-with-icon" data-notify="container">
                            <i class="material-icons" data-notify="icon">warning</i>
                            <span data-notify="message">Atas persetujuan General Manager terkait</span>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    @if($data->id_jabatan==4||$data->id_jabatan==5||$data->id_jabatan==6||$data->id_jabatan==7||$data->id_jabatan==8||$data->id_jabatan==9||$data->id_jabatan==10)
                    <div class="row">
                        <label class="col-sm-2 label-on-left">NIP</label>
                        <div class="col-sm-10">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label"></label>
                                <input type="text" name="nip" class="form-control"
                                    placeholder="NIP" disabled value="{{ $data->nip }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Nama Karyawan</label>
                        <div class="col-sm-10">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label"></label>
                                <input type="text" name="nama_karyawan" class="form-control"
                                    placeholder="Nama Karyawan" disabled value="{{ $data->nama_karyawan }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Divisi</label>
                        <div class="col-sm-10">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label"></label>
                                <input type="text" name="divisi" class="form-control"
                                    placeholder="Divisi" disabled value="{{ $tunjangan->nama_divisi }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Jabatan</label>
                        <div class="col-sm-10">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label"></label>
                                <input type="text" name="jabatan" class="form-control"
                                    placeholder="Jabatan" disabled value="{{ $tunjangan->nama_jabatan }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Gaji Pokok</label>
                        <div class="col-sm-10">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label"></label>
                                <input type="text" name="gaji_pokok" class="form-control"
                                    placeholder="Gaji Pokok" value="{{ $tunjangan->gaji_pokok }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Tunjangan Transport</label>
                        <div class="col-sm-10">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label"></label>
                                <input type="text" name="tunjangan_transport" class="form-control"
                                    placeholder="Tunjangan Transport" value="{{ $tunjangan->tunjangan_transport }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Tunjangan Makan</label>
                        <div class="col-sm-10">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label"></label>
                                <input type="text" name="tunjangan_makan" class="form-control"
                                    placeholder="Tunjangan Makan" value="{{ $tunjangan->tunjangan_makan }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Tunjangan Sakit</label>
                        <div class="col-sm-10">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label"></label>
                                <input type="text" name="tunjangan_sakit" class="form-control"
                                    placeholder="Tunjangan Sakit" value="{{ $tunjangan->tunjangan_sakit }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Tunjangan Kompensasi</label>
                        <div class="col-sm-10">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label"></label>
                                <input type="text" name="tunjangan_kompensasi" class="form-control"
                                    placeholder="Tunjangan Kompensasi" value="{{ $tunjangan->tunjangan_kompensasi }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Tunjangan Cuti</label>
                        <div class="col-sm-10">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label"></label>
                                <input type="text" name="tunjangan_cuti" class="form-control"
                                    placeholder="Tunjangan Cuti" value="{{ $tunjangan->tunjangan_cuti }}">
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <label class="col-sm-2 label-on-left">NIP</label>
                        <div class="col-sm-10">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label"></label>
                                <input type="text" name="nip" class="form-control"
                                    placeholder="NIP" disabled value="{{ $data->nip }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Nama Karyawan</label>
                        <div class="col-sm-10">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label"></label>
                                <input type="text" name="nama_karyawan" class="form-control"
                                    placeholder="Nama Karyawan" disabled value="{{ $data->nama_karyawan }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Divisi</label>
                        <div class="col-sm-10">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label"></label>
                                <input type="text" name="divisi" class="form-control"
                                    placeholder="Divisi" disabled value="{{ $tunjangan->nama_divisi }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Jabatan</label>
                        <div class="col-sm-10">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label"></label>
                                <input type="text" name="jabatan" class="form-control"
                                    placeholder="Jabatan" disabled value="{{ $tunjangan->nama_jabatan }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Gaji Pokok</label>
                        <div class="col-sm-10">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label"></label>
                                <input type="text" name="gaji_pokok" class="form-control"
                                    placeholder="Gaji Pokok" value="{{ $tunjangan->gaji_pokok }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Tunjangan Sakit</label>
                        <div class="col-sm-10">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label"></label>
                                <input type="text" name="tunjangan_sakit" class="form-control"
                                    placeholder="Tunjangan Sakit" value="{{ $tunjangan->tunjangan_sakit }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Tunjangan Kompensasi</label>
                        <div class="col-sm-10">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label"></label>
                                <input type="text" name="tunjangan_kompensasi" class="form-control"
                                    placeholder="Tunjangan Kompensasi" value="{{ $tunjangan->tunjangan_kompensasi }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Tunjangan Cuti</label>
                        <div class="col-sm-10">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label"></label>
                                <input type="text" name="tunjangan_cuti" class="form-control"
                                    placeholder="Tunjangan Cuti" value="{{ $tunjangan->tunjangan_cuti }}">
                            </div>
                        </div>
                    </div>
                    @endif
                    <hr>
                    <button type="submit" class="btn btn-fill btn-rose">Simpan</button>
                </div>
        </div>
    </div>
    </form>
</div>
</div>
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