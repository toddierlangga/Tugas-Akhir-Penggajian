@extends('layouts.app')

@section('title', 'Laporan Gaji')

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
            <form method="POST" action="{{route('store_gaji')}}" class="form-horizontal">
                <div class="card-header card-header-text" data-background-color="purple">
                    <h4 class="card-title">Laporan Gaji Karyawan</h4>
                </div>
                @csrf
                <div class="card-content">
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Bulan</label>
                        <div class="col-sm-10">
                            <select class="selectpicker" name="bulan" data-style="select-with-transition"
                                title="Pilih Bulan Laporan Gaji" data-size="7">
                                <option disabled> Pilih Bulan Laporan Gaji</option>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 label-on-left">Tahun</label>
                        <div class="col-sm-10">                            
                            <input type="text" class="form-control datepicker" name="tahun" id="tahun" />
                        </div>
                    </div>
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
<script>
    $('.datepicker').datetimepicker({
        format: 'Y',
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