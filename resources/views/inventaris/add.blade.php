@extends('adminlte::page')
@section('title','Input Data Inventaris')
@section('content_header')
    <h1>Inventaris <small>Add Data</small></h1>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <form class="form-horizontal" autocomplete="off" method="post" action="{{route('inventaris.store')}}">
            <div class="card card-primary">
                <div class="card-header with-border">
                    <h3 class="card-title">Tambah Data</h3>
                </div>
                <div class="card-body">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label for="nama" class="col-sm-3 control-label">Nama Barang</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control  @error('nama') is-invalid @enderror" 
                            value="{{old('nama')}}"  placeholder="Nama Barang"
                            name="nama" id="nama">
                            @error('nama')
                                <div class="text-danger invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kondisi" class="col-sm-3 control-label">Kondisi</label>
                        <div class="col-sm-9">
                            @php
                                $val = old('kondisi');
                            @endphp
                        <select name="kondisi" id="kondisi" class="form-control select2 @error('kondisi') is-invalid @enderror">
                            <option value="" {{$val==""?'selected':''}} >Pilih Kondisi</option>
                            <option value="Baru" {{$val=="Baru"?'selected':''}}>Baru</option>
                            <option value="Lama" {{$val=="Lama"?'selected':''}}>Lama</option>
                        </select>
                        @error('kondisi')
                            <div class="text-danger invalid-feedback">{{$message}}</div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="jumlah" class="col-sm-3 control-label">Jumlah</label>
                        <div class="col-sm-9">
                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror" 
                        value="{{old('jumlah')}}"  placeholder="Jumlah"
                        name="jumlah" id="jumlah">
                        @error('jumlah')
                            <div class="text-danger invalid-feedback">{{$message}}</div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="id_jenis" class="col-sm-3 control-label">Jenis</label>
                        <div class="col-sm-9">
                            @php
                                $jen = old('id_jenis');
                            @endphp
                        <select name="id_jenis" id="id_jenis" class="form-control select2 @error('id_jenis') is-invalid @enderror">
                            <option value="" {{$jen==""?'selected':''}} >Pilih Jenis</option>
                            @foreach ($jenis as $dt)
                            <option value="{{$dt->id_jenis}}">{{$dt->nama_jenis}}</option>
                            @endforeach
                        </select>
                        {{-- <input type="number" class="form-control" 
                        name="id_jenis" id="id_jenis"> --}}
                        @error('id_jenis')
                            <div class="text-danger invalid-feedback">{{$message}}</div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="id_ruang" class="col-sm-3 control-label">Ruang</label>
                        {{-- <input type="number" class="form-control" 
                        name="id_ruang" id="id_ruang"> --}}
                        <div class="col-sm-9">
                            @php
                                $ru = old('id_ruang');
                            @endphp
                        <select name="id_ruang" id="id_ruang" class="form-control select2 @error('id_ruang') is-invalid @enderror">
                            <option value="" {{$ru==""?'selected':''}}>Pilih ruang</option>
                            @foreach ($ruang as $dt)
                            <option value="{{$dt->id_ruang}}" >{{$dt->nama_ruang}}</option>
                            @endforeach
                        </select>
                        @error('id_ruang')
                            <div class="text-danger invalid-feedback">{{$message}}</div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="id_kategori" class="col-sm-3 control-label">Kategori</label>
                        <div class="col-sm-9">
                            @php
                                $ru = old('id_kategori');
                            @endphp
                        <select name="id_kategori" id="id_kategori" class="form-control select2 @error('id_kategori') is-invalid @enderror">
                            <option value="" {{$ru==""?'selected':''}}>Pilih kategori</option>
                            @foreach ($kategori as $dt)
                            <option value="{{$dt->id_kategori}}" >{{$dt->nama_kategori}}</option>
                            @endforeach
                        </select>
                        @error('id_kategori')
                            <div class="text-danger invalid-feedback">{{$message}}</div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="keterangan" class="col-sm-3 control-label">Keterangan</label>
                        <div class="col-sm-9">
                        {{-- <input type="text" class="form-control" placeholder="keterangan"
                        name="keterangan" id="keterangan"> --}}
                        <textarea name="keterangan" id="keterangan" cols="30" rows="3" 
                        class="form-control @error('keterangan') is-invalid @enderror" 
                        placeholder="keterangan"></textarea>
                        @error('keterangan')
                            <div class="text-danger invalid-feedback">{{$message}}</div>
                        @enderror
                        </div>  
                    </div>
                </div>
            {{-- <div class="card-footer"></div> --}}
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header"><h3 class="card-title">Tambah Data</h3></div>
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="kode_inventaris" class="col-sm-3 control-label">Kode Inventaris</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$kode}}" readonly
                        name="kode_inventaris" id="kode_inventaris">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_registrasi" class="col-sm-3 control-label">Tanggal Registrasi</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control  @error('tanggal_registrasi') is-invalid @enderror" 
                        placeholder="Tanggal Registrasi"
                        name="tanggal_registrasi" id="tanggal_registrasi" value="{{date('Y-m-d')}}" data-position='bottom left'>
                        @error('tanggal_registrasi')
                            <div class="text-danger invalid-feedback">{{$message}}</div>
                        @enderror
                        </div>  
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </div>
            </form>
            </div>
    
            <div class="card collapsed-card">
                <div class="card-header with-border">
                    <h3 class="card-title">Table Jenis</h3>
                    <div class="card-tools float-right">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body ">
                    <table class="table table-hover table-bordered" id="myTable">
                        <thead>
                        <tr>
                        <th style="width: 10px">#</th>
                        <th>Nama</th>
                        <th>Kode</th>
                        <th>Keterangan</th>
                        </tr>
                        </thead>
                            <tbody>
                            @foreach ($jenis as $jn)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$jn->nama_jenis}}</td>
                                <td>{{$jn->kode_jenis}}</td>
                                <td>{{$jn->keterangan}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="card-header with-border">
                    <h3 class="card-title">Table Kategori</h3>
                </div>
                <div class="card-body ">
                <table id="myTable1" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                        <th style="width: 10px">#</th>
                        <th>Nama</th>
                        <th>Kode</th>
                        <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($kategori as $ru)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$ru->nama_kategori}}</td>
                        <td>{{$ru->kode_kategori}}</td>
                        <td>{{$ru->keterangan}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
    
                <div class="card-header with-border">
                    <h3 class="card-title">Table Ruang</h3>
                </div>
                <div class="card-body ">
                <table id="myTable1" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                        <th style="width: 10px">#</th>
                        <th>Nama</th>
                        <th>Kode</th>
                        <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($ruang as $ru)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$ru->nama_ruang}}</td>
                        <td>{{$ru->kode_ruang}}</td>
                        <td>{{$ru->keterangan}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection



@push('js')
<script>
$(document).ready( function () {
    $('#myTable1').DataTable();

    $('#tanggal_registrasi').datepicker({
        language: 'en',
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
    });
    $(".select2").select2({
    placeholder: "Pilih Data",
    allowClear: true
    });
    $.fn.select2.defaults.set('amdBase', 'select2/');
    $.fn.select2.defaults.set('amdLanguageBase', 'select2/i18n/');

});

    
</script>
@endpush