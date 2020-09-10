@extends('adminlte::page')
@section('title','Input Data Pengembalian')
@section('content')
<div class="content" >
    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header with-border">
                        <h3 class="card-title">Input Data Pengembalian</h3>
                    </div>
                    <form action="{{route('pengembalian.store')}}" method="POST" class="form-horizontal" autocomplete="off">
                        {{ csrf_field() }}
                    <div class="card-body">
                        <div class="row">
                                <label for="pinjam_id">Cari Data Peminjam</label>
                                <select name="pinjam_id" id="pinjam_id" class="form-control" width="100%">
                                    <option value="">Nomor Pinjaman / Nama Peminjam </option>
                                    @foreach ($data as $no)
                                    <option value="{{$no->id_peminjaman}}">{{$no->kode_pinjam}} / {{$no->name}}</option>
                                    @endforeach
                                </select>
                                @error('pinjam_id')
                                    <div class="text-danger">{{$message}}</div>
                                @enderror
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Data Peminjaman</h4>
                                <div class="form-group row">
                                    <label for="kode_pinjam" class="col-sm-3 col-form-label">Nomor Peminjaman</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="kode_pinjam" id="kode_pinjam" class="form-control"
                                        placeholder="Nomor Peminjaman" readonly>
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="tanggal_pinjam" class="">Tanggal Peminjaman</label>
                                        <input type="text" name="tanggal_pinjam" id="tanggal_pinjam"
                                        placeholder="Tanggal Pinjam" readonly
                                        class="form-control" >
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="tanggal_kembali" class="">Tanggal Kembali</label>
                                        <input type="text" name="tanggal_kembali" id="tanggal_kembali"
                                        placeholder="Tanggal Kembali" readonly
                                        class="form-control" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tanggal_pengembalian" class="col-sm-3 col-form-label">Tanggal Pengembalian</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="tanggal_pengembalian" id="tanggal_pengembalian" class="form-control" readonly
                                        placeholder="Tanggal Pengembalian" value="{{date('Y-m-d', strtotime(now()))}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="terlambat" class="col-sm-3 col-form-label">Keterlambatan</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="terlambat" id="terlambat" class="form-control"
                                        placeholder="Keterlambatan / Hari" value="">
                                        <input type="hidden" name="keterlambatan" id="lambat">
                                        @error('keterlambatan')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                        <div id="p1" class="text-primary"></div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nama" class="col-sm-3 col-form-label">ID | Nama Peminjam</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="ID | Nama Peminjam" readonly>
                                    </div>
                                </div>
                                <input type="hidden" name="user_id" id="user_id" >
                                <input type="hidden" name="admin_id" id="admin_id" value="{{Session::get('id')}}">

                            </div>
                            <div class="col-md-6">
                                <h4>Data Pengembalian</h4>
                                <div class="form-group row">
                                    <label for="kode_kembali" class="col-sm-3 col-form-label">Kode Pengembalian</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="kode_kembali" id="kode_kembali" class="form-control"
                                        placeholder="Kode Pengembalian" value="{{$kode}}" readonly>
                                    </div>
                                </div>

                                <h4>Data Barang</h4>
                                <ul class="list-group" id="list">
                                    
                                </ul>
                                @error('cart')
                                    <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-default"href="{{route('peminjaman.index')}}">
                            <i class="fa fa-backward"></i> Kembali
                        </a>
                        <button class="btn btn-primary float-right">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
        function selisih(){
            var tglSekarang = new Date
            var a = Date.parse($('#tanggal_kembali').val())
            var b = Date.parse(tglSekarang)
            var jrk = 0.0
            var perbedaan = 0
            var slsh = ''
            var p1 = "Anda Tepat Waktu"
            var p2 = "Anda Terlambat!!"
            if (b) {
                perbedaan = (b-a)/1000
                slsh = (Math.floor(perbedaan/86400)) //24*60*60
                console.log(slsh);
            }
            if (parseInt(slsh) > 0) {
                $('#tanggal_kembali').css("background","red")
                $('#terlambat').val(slsh)
                $('#lambat').val('1')
                document.getElementById("p1").innerHTML = p2
            } else {
                $('#tanggal_kembali').css("background","lightgreen")
                $('#terlambat').val('')
                $('#lambat').val('2')
                document.getElementById("p1").innerHTML = p1
            }
        }

        $(document).ready(function(){

            $('#pinjam_id').change(function(){
                var kode = $('#pinjam_id').val();
                var token = $("input[name='_token']").val();
                $.ajax({
                    url : "{{route('cari')}}",
                    method: 'POST',
                    data: {id: kode, _token:token},
                    success: function(res){
                        console.log(res.data);
                        var idNama = res.data.user_id
                        var Nama = res.data.name
                        $('#kode_pinjam').val(res.data.kode_pinjam)
                        $('#tanggal_pinjam').val(res.data.tanggal_pinjam)
                        $('#tanggal_kembali').val(res.data.tanggal_kembali)
                        $('#nama').val(idNama + " | " + Nama)
                        $('#user_id').val(res.data.user_id)
                        selisih()
                        $("#list").empty();
                        var items = JSON.parse(res.data.cart)
                        for(var item in items) {
                            var name = items[item].items.nama
                            var qty = items[item].qty
                            var kode = items[item].kode
                            var id = items[item].items.id_inventaris
                            var input = String('<input class="" type="checkbox" name="cart[]" checked id="'+kode+'" value="'+id+'">');
                            var span = String('<span class="float-right badge bg-primary" id="qty">'+qty+'</span>');
                            var label = String('<label for="'+kode+'"> '+name+'</label>');
                            var span2 = String('<span class="badge badge-success">'+kode+'</span>');
                            document.getElementById("list").innerHTML += String('<li class="list-group-item">'+' '+input+' '+span+' '+label+' '+span2+' </li>');
                        }
                        // var total = jsonDecode.totalQty
                        // var li = '<li class="list-group-item bg-info">Total Barang : <strong>'+total+'</strong></li>'
                        // document.getElementById("list").innerHTML += li;

                        // $('#qty').val()

                    }
                })
            })

            $("#pinjam_id").select2({
                placeholder: "Nomor Pinjaman / Nama Peminjam ",
                allowClear: true,
                // buttonWidth: '100%',
                // nonSelectedText: "Pilih Data",
            });
                $.fn.select2.defaults.set('amdBase', 'select2/');
                $.fn.select2.defaults.set('amdLanguageBase', 'select2/i18n/');
            
        })
    </script>
@endpush