@extends('adminlte::page')
@section('title','Input Data Denda')
@section('content')
<div class="content" >
    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-12">
                <div class="card card-warning">
                    <div class="card-header with-border">
                        <h3 class="card-title">Input Data Denda</h3>
                    </div>
                    <form action="{{route('denda.store')}}" method="POST" class="form-horizontal" autocomplete="off">
                        {{ csrf_field() }}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Data Pengembalian</h4>
                                <div class="form-group row">
                                    <label for="kode_kembali" class="col-sm-3 col-form-label">Nomor Pengembalian</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="kode_kembali" id="kode_kembali" class="form-control"
                                        value="{{old('kode_kembali',$data->kode_kembali)}}" readonly>
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="tanggal_pinjam" class="">Tanggal Peminjaman</label>
                                        <input type="text" name="tanggal_pinjam" id="tanggal_pinjam" readonly
                                        value="{{old('tanggal_pinjam',$datas->tanggal_pinjam)}}" class="form-control">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="tanggal_kembali" class="">Tanggal Kembali</label>
                                        <input type="text" name="tanggal_kembali" id="tanggal_kembali" readonly
                                        value="{{old('tanggal_kembali',$datas->tanggal_kembali)}}" class="form-control" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tanggal_pengembalian" class="col-sm-3 col-form-label">Tanggal Pengembalian</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="tanggal_pengembalian" id="tanggal_pengembalian" class="form-control" readonly
                                        value="{{old('tanggal_masuk',$data->tanggal_masuk)}}" placeholder="Tanggal Pengembalian">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="terlambat" class="col-sm-3 col-form-label">Keterlambatan</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="terlambat" id="terlambat" class="form-control"
                                        placeholder="Keterlambatan / Hari"  value="{{old('terlambat',$data->terlambat)}}" readonly>
                                        <input type="hidden" name="keterlambatan" id="lambat">
                                        @error('keterlambatan')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nama" class="col-sm-3 col-form-label">ID | Nama Peminjam</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="nama" id="nama" readonly
                                        value="{{old('user_id',$data->user_id)}} | {{old('name',$data->get_user->name)}}">
                                    </div>
                                </div>
                                <input type="hidden" name="user_id" id="user_id"  value="{{old('user_id',$data->user_id)}}">
                                <input type="hidden" name="kembali_id" id="kembali_id"  value="{{old('id_kembali',$data->id_kembali)}}">
                                <input type="hidden" name="admin_id" id="admin_id" value="{{Session::get('id')}}">

                            </div>
                            <div class="col-md-6">
                                <h4>Data Denda</h4>
                                <div class="form-group row">
                                    <label for="kode_denda" class="col-sm-3 col-form-label">Kode Denda</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="kode_denda" id="kode_denda" class="form-control"
                                        placeholder="Kode Denda" value="{{$kode}}" readonly>
                                    </div>
                                </div>

                                <h4>Nominal Denda</h4>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="form-group row">
                                            <label for="total_denda" class="col-sm-3 col-form-label">Total Denda</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="total_denda" id="total_denda" class="form-control"
                                                placeholder="Rp. Denda" value="{{$denda}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="bayar_denda" class="col-sm-3 col-form-label">Bayar Denda</label>
                                            <div class="col-sm-9">
                                                <input type="number" name="bayar_denda" id="bayar_denda" class="form-control"
                                                placeholder="Rp. Denda" onkeyup="proses()">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item bg-info">
                                        <div class="form-group row">
                                            <label for="sisa_denda" class="col-sm-3 col-form-label">Sisa Denda</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="sisa_denda" id="sisa_denda" class="form-control"
                                                placeholder="Rp. Denda"  readonly>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" name="status" id="status" class="form-control"
                                                placeholder="Status"  readonly>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                @error('cart')
                                    <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-default"href="{{route('denda.index')}}">
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
        function proses(){
            var total = $('#total_denda').val();
            var isi = $('#bayar_denda').val()
            var jumlah = total - isi
            if (jumlah>0) {
                var status = 'Kurang'
            } else {
                var status = 'Lunas'
            }
            $('#sisa_denda').val(jumlah)
            $('#status').val(status)
            console.log(status)
        }
    </script>
@endpush