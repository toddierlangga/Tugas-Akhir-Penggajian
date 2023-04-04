@extends('layouts.app')

@section('title', 'Edit Karyawan')

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
            <form method="POST" action="{{route('update_karyawan', $data->id_karyawan)}}" class="form-horizontal" >
                @csrf
                {{ method_field('PUT') }}
                <div class="card-header card-header-text" data-background-color="purple">
                    <h4 class="card-title">Form Edit Karyawan</h4>
                </div>
                {{-- <div class="card-content">
                    <div class="row">
                        <div class="alert alert-warning alert-with-icon" data-notify="container">
                            <i class="material-icons" data-notify="icon">warning</i>
                            <span data-notify="message">Atas persetujuan petinggi perusahaan</span>
                        </div>
                    </div>
                </div> --}}
                <div class="card-content">
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Nama Karyawan</label>
                        <div class="col-sm-10">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label"></label>
                                <input type="text" name="nama_karyawan" class="form-control"
                                    placeholder="Nama Karyawan" value="{{ $data->nama_karyawan }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Jenis Kelamin</label>
                        <div class="col-sm-10 checkbox-radios">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="jkel" value="Laki-laki" {{$data->jkel == 'Laki-laki' ? 'checked' : '' }}> Laki-laki
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="jkel" value="Perempuan" {{$data->jkel == 'Perempuan' ? 'checked' : '' }}> Perempuan
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Tempat Lahir</label>
                        <div class="col-sm-10">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label"></label>
                                <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" value="{{ $data->tempat_lahir }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <div class="form-group label-floating is-empty">
                                <input type="text" class="form-control datepicker" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" value="{{$data->tanggal_lahir}}"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Telepon</label>
                        <div class="col-sm-10">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label"></label>
                                <input type="text" name="telepon" class="form-control" placeholder="Telepon" value="{{$data->telepon}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Agama</label>
                        <div class="col-sm-10">
                            <select class="selectpicker" name="agama" data-style="select-with-transition"
                                title="Pilih Agama" data-size="7">
                                <option disabled> Pilih agama</option>
                                <option value="Islam" {{$data->agama == 'Islam' ? 'selected' : '' }}>Islam </option>
                                <option value="Kristen" {{$data->agama == 'Kristen' ? 'selected' : '' }}>Kristen </option>
                                <option value="Hindu" {{$data->agama == 'Hindu' ? 'selected' : '' }}>Hindu </option>
                                <option value="Buddha" {{$data->agama == 'Buddha' ? 'selected' : '' }}>Buddha </option>
                                <option value="Kong Hu Cu" {{$data->agama == 'Kong Hu Cu' ? 'selected' : '' }}>Kong Hu Cu </option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Status Pernikahan</label>
                        <div class="col-sm-10">
                            <select class="selectpicker" name="status_nikah" data-style="select-with-transition" title="Pilih Status Pernikahan" data-size="7">
                                <option disabled> Pilih status nikah</option>
                                <option value="Belum Menikah"{{$data->status_nikah == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah </option>
                                <option value="Menikah"{{$data->status_nikah == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                <option value="Duda"{{$data->status_nikah == 'Duda' ? 'selected' : '' }}>Duda</option>
                                <option value="Janda"{{$data->status_nikah == 'Janda' ? 'selected' : '' }}>Janda</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Divisi</label>
                        <div class="col-sm-10">
                            <select class="selectpicker" id="divisi" name="divisi" data-style="select-with-transition"
                                title="Pilih Divisi" data-size="7">
                                <option disabled> Pilih Divisi</option>
                                @foreach ($divisi as $divisi)
                                <option value="{{$divisi->id_divisi}}"{{$divisi->id_divisi == $data->id_divisi ? 'selected' : '' }}>{{$divisi->nama_divisi}} </option>
                                @endforeach                                
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Jabatan</label>
                        <div class="col-sm-10">
                            <select class="selectpicker" id="jabatan" name="jabatan" data-style="select-with-transition"
                                title="Pilih Jabatan" data-size="7">
                                <option disabled> Pilih jabatan</option>
                                @foreach ($jabatan as $jabatan)
                                <option value="{{$jabatan->id_jabatan}}" {{$jabatan->id_jabatan == $data->id_jabatan ? 'selected' : '' }}>{{$jabatan->nama_jabatan}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Alamat</label>
                        <div class="col-sm-10">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label"></label>
                                <input type="text" name="alamat" class="form-control" placeholder="Alamat" value="{{$data->alamat}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Tanggungan Anak</label>
                        <div class="col-sm-10">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label"></label>
                                <input type="text" name="tanggungan_anak" class="form-control"
                                    placeholder="Tanggungan Anak" value="{{$data->tanggungan_anak}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Tanggal Perekrutan</label>
                        <div class="col-sm-10">
                            <div class="form-group label-floating is-empty">
                                <input type="text" class="form-control datepicker" name="tanggal_perekrutan" id="tanggal_perekrutan" placeholder="Tanggal Perekrutan" value="{{$data->tanggal_perekrutan}}"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Tempat Perekrutan</label>
                        <div class="col-sm-10 checkbox-radios">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="tempat_perekrutan" value="Batam" {{$data->tempat_perekrutan == 'Batam' ? 'checked' : '' }}> Batam
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="tempat_perekrutan" value="Jakarta" {{$data->tempat_perekrutan == 'Jakarta' ? 'checked' : '' }}> Jakarta
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-fill btn-rose">SIMPAN</button>
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
<script>
    $('.datepicker').datetimepicker({
        format: 'YYYY-MM-DD',
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-remove'
        }
    });
</script>
@endpush
@endsection