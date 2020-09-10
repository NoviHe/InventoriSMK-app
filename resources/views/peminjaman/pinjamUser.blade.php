@extends('layouts.page')
@section('title','User Proses Peminjaman')
@section('content_header')
    <h1>Peminjaman <small>Proses</small></h1>
@endsection
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header with-border">
                <h3 class="card-title">Peminjaman Proses Pinjam</h3>
            </div>
            <form action="{{route('peminjaman.storeUser')}}" method="post" class="form-horizontal" autocomplete="off">
                {{ csrf_field() }}
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Data Peminjaman</h4>
                        <div class="form-group row">
                            <label for="kode_pinjam" class="col-sm-3 col-form-label">No Peminjaman</label>
                            <div class="col-sm-9">
                                <input type="text" name="kode_pinjam" id="kode_pinjam" class="form-control"
                                value="{{$kode}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tanggal_pinjam" class="col-sm-3 col-form-label">Tanggal Peminjaman</label>
                            <div class="col-sm-9">
                                <input type="text" name="tanggal_pinjam" id="tanggal_pinjam" readonly
                                class="form-control" value="{{date('Y-m-d', strtotime(now()))}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tanggal_kembali" class="col-sm-3 col-form-label">Tanggal Kembali</label>
                            <div class="col-sm-9">
                                <input type="text" name="tanggal_kembali" id="tanggal_kembali" 
                                class="form-control datepicker-here" data-language='en' 
                                placeholder="Tanggal Kembali" 
                                data-position='top right'>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jumlah" class="col-sm-3 col-form-label">Total Jumlah</label>
                            <div class="col-sm-9">
                                <input type="text" name="jumlah" id="jumlah" class="form-control"
                                placeholder="Total Jumlah Barang" value="{{$totalQty}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4>Data Pegawai</h4>
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Nama Peminjam</label>
                            <div class="col-sm-9">
                                <input name="name" type="text" id="name" value="{{$pegawai->name}}" style="width: 100%;"
                                class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="no_telp" class="col-sm-3 col-form-label">No Telp Peminjam</label>
                            <div class="col-sm-9">
                                <input type="text" name="no_telp" id="no_telp" class="form-control"
                                placeholder="No Telepon" readonly value="{{$pegawai->no_telp}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat Peminjam</label>
                            <div class="col-sm-9">
                                <input type="text" name="alamat" id="alamat" class="form-control"
                                placeholder="Alamat" readonly value="{{$pegawai->alamat}}">
                            </div>
                        </div>
                        <input type="hidden" name="id" id="id" value="{{$pegawai->id}}">
                        <h4>Data Petugas</h4>
                        <div class="form-group row">
                            <label for="id_admin" class="col-sm-3 col-form-label">Nama Petugas</label>
                            <div class="col-sm-9">
                                <select name="id_admin" id="id_admin" style="width: 100%;"
                                class="select2 form-control">
                                <option value="">Pilih Data</option>
                                    @foreach ($petugas as $pg)
                                    <option value="{{$pg->id}}">{{$pg->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a class="btn btn-default"href="{{route('peminjaman.create')}}">
                    <i class="fa fa-backward"></i> Kembali
                </a>
                <button class="btn btn-primary float-right">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    
    $(document).ready(function(){

        $("#id_admin").select2({
            placeholder: "Nama Petugas ",
            allowClear: true,
            // buttonWidth: '100%',
            // nonSelectedText: "Pilih Data",
        });
            $.fn.select2.defaults.set('amdBase', 'select2/');
            $.fn.select2.defaults.set('amdLanguageBase', 'select2/i18n/');
        

        // $('#name').change(function(){
        //     var kode = $('#name').val();
        //     var token = $("input[name='_token']").val();
        //     $.ajax({
        //         url : "{{route('cariPegawai')}}",
        //         method: 'POST',
        //         data: {id: kode, _token:token},
        //         success: function(res){
        //             console.log(res.data);
        //             $('#no_telp').val(res.data.no_telp)
        //             $('#alamat').val(res.data.alamat)
        //             $('#id').val(res.data.id)
        //         }
        //     })
        // })

        $('#tanggal_kembali').datepicker({
            language: 'en',
            minDate: new Date(), // Now can select only dates, which goes after today
            onShow: function(dp, animationCompleted){
                if (!animationCompleted) {
                    console.log('start showing')
                } else {
                    console.log('finished showing')
                }
            },
            onHide: function(dp, animationCompleted){
                if (!animationCompleted) {
                    console.log('start hiding')
                } else {
                    console.log('finished hiding')
                }
            }
        })
    })
</script>
@endpush

