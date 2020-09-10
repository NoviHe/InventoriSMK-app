@extends('adminlte::page')
@section('title','Input Data Pengembalian')
@section('content')
<div class="content" >
    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-12">
                <div class="card card-warning">
                    <div class="card-header with-border">
                        <h3 class="card-title">Input Data Pengembalian</h3>
                    </div>
                    <form action="{{route('peminjaman.update', $data->id_peminjaman)}}" method="POST" class="form-horizontal" autocomplete="off">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Data Peminjaman</h4>
                                <div class="form-group row">
                                    <label for="kode_pinjam" class="col-sm-3 col-form-label">Nomor Peminjaman</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="kode_pinjam" id="kode_pinjam" class="form-control"
                                        value="{{old('kode_pinjam', $data->kode_pinjam)}}" readonly>
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="tanggal_pinjam" class="">Tanggal Peminjaman</label>
                                        <input type="text" name="tanggal_pinjam" id="tanggal_pinjam" readonly
                                        class="form-control" value="{{old('tanggal_pinjam',$data->tanggal_pinjam)}}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="tanggal_kembali" class="">Tanggal Kembali</label>
                                        <input type="text" name="tanggal_kembali" id="tanggal_kembali" readonly
                                        class="form-control" value="{{old('tanggal_kembali',$data->tanggal_kembali)}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tanggal_pengembalian" class="col-sm-3 col-form-label">Tanggal Pengembalian</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="tanggal_pengembalian" id="tanggal_pengembalian" class="form-control" readonly
                                        placeholder="Tanggal Pengembalian" value="{{date('Y-m-d',strtotime(now()))}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="terlambat" class="col-sm-3 col-form-label">Keterlambatan</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="terlambat" id="terlambat" class="form-control"
                                        placeholder="Keterlambatan / Hari" value="" onclick="selisih()">
                                        <input type="hidden" name="keterlambatan" id="lambat">
                                        @error('keterlambatan')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                        <div id="p1" class="text-primary">Click di Atas untuk mengetahui Keterlambatan</div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nama" class="col-sm-3 col-form-label">ID | Nama Peminjam</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="nama" id="nama" readonly
                                        value="{{old('user_id', $data->user_id)}} | {{old('name', $data->get_user->name)}}">
                                    </div>
                                </div>
                                <input type="hidden" name="user_id" id="user_id" value="{{old('user_id', $data->user_id)}}">
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
                                <ul class="list-group">
                                    @foreach ($items as $item)
                                    <li class="list-group-item" >
                                        <input class="" type="checkbox" name="cart[]" checked
                                        id="{{$item['kode']}}" value="{{$item['items']['id_inventaris']}}">
                                        <span class="float-right badge bg-primary"> {{$item['qty']}}</span>
                                        <label for="{{$item['kode']}}"> {{$item['items']['nama']}}</label>
                                        <span class="badge badge-success">{{$item['kode']}}</span>
                                    </li>
                                    @endforeach
                                    <li class="list-group-item bg-info">Total Barang : <strong>{{$totalQty}}</strong></li>
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
                        <button class="btn btn-warning float-right">Submit</button>
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
            var p1 = "Kosong Berarti Tepat Waktu"
            if (b) {
                perbedaan = (b-a)/1000
                slsh = (Math.floor(perbedaan/86400)) //24*60*60
                console.log(slsh);
            }
            if (parseInt(slsh) > 0) {
                $('#tanggal_kembali').css("background","red")
                $('#terlambat').val(slsh)
                $('#lambat').val('1')
            } else {
                $('#tanggal_kembali').css("background","lightgreen")
                $('#terlambat').val('')
                $('#lambat').val('2')
                document.getElementById("p1").innerHTML = p1
            }
        }

        $(document).ready(function(){
            $("#status").select2({
                placeholder: "Pilih Kondisi ",
                allowClear: true,
                // buttonWidth: '100%',
                // nonSelectedText: "Pilih Data",
            });
                $.fn.select2.defaults.set('amdBase', 'select2/');
                $.fn.select2.defaults.set('amdLanguageBase', 'select2/i18n/');
            
        })
    </script>
@endpush