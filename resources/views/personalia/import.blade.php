@extends('layouts.app')

@section('title', 'Tambah Karyawan')

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
            <form method="POST" action="{{route('store_import')}}" class="form-horizontal" enctype="multipart/form-data">
                <div class="card-header card-header-text" data-background-color="purple">
                    <h4 class="card-title">Form Tambah Karyawan</h4>
                </div>
                @csrf
                <div class="card-content">
                    <div class="row">
                        <label class="col-sm-2 label-on-left">File Upload</label>
                        <div class="col-sm-10">
                            <div class="custom-file">
                                <br>
                                <input type="file" name="file" class="custom-file-input" id="inputGroupFile02">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-fill btn-rose">Upload</button>
                </div>
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