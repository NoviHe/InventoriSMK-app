@extends('layouts.admin')
@section('title','Input Pengembalian')
@section('content_header')
    <h1>Pengembalian <small>Data Input</small></h1>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <form action="{{route('pengembalian.store')}}" method="POST" class="form-horizontal">
        <div class="col-md-11">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Pengembalian Data Input</h3>
                </div>
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @error('no_kembali') has-error @enderror">
                                <label for="no_kembali" class="col-sm-3 control-label">ID Pegawai</label>
                                <div class="col-sm-9">
                                    <input type="text" name="no_kembali" id="no_kembali" 
                                    class="form-control" readonly>
                                    @error('no_kembali')
                                        <div class="text-danger invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="no_pinjam" class="col-sm-3 control-label">Nomer Pinjam</label>
                                <div class="col-sm-9">
                                    {{-- <select name="no_pinjam" id="no_pinjam" 
                                    class="form-control @error('no_pinjam') is-invalid @enderror">
                                        <option value="">Pilih Nomer Pinjam</option>
                                        @foreach ($data as $dt)
                                            <option value="{{$dt->id_peminjaman}}">{{$dt->no_pinjam}}</option>
                                        @endforeach
                                    </select> --}}
                                    <input type="text" name="no_pinjam" id="no_pinjam" 
                                    class="form-control" value="{{old('no_pinjam',$data->no_pinjam)}}">
                                    @error('no_pinjam')
                                        <div class="text-danger invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="id_pegawai" class="col-sm-3 control-label">ID Pegawai</label>
                                <div class="col-sm-9">
                                    <input type="text" name="id_pegawai" id="id_pegawai" 
                                    class="form-control">
                                    @error('id_pegawai')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="id_inventaris" class="col-sm-3 control-label">Kode Barang</label>
                                <div class="col-sm-9">
                                    <input type="text" name="id_inventaris" id="id_inventaris" 
                                    class="form-control @error('id_inventaris') is-invalid @enderror">
                                    @error('id_inventaris')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_pinjam" class="col-sm-3 control-label">Tanggal Pinjam</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="datepicker-here form-control @error('tanggal_pinjam') is-invalid @enderror"
                                        data-language='en'
                                        name="tanggal_pinjam" id="tanggal_pinjam"
                                        autocomplete="off"
                                        data-position='top left'/>
                                    @error('tanggal_pinjam')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_kembali" class="col-sm-3 control-label">Tanggal Kembali</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="datepicker-here form-control @error('tanggal_kembali') is-invalid @enderror"
                                        data-language='en'
                                        name="tanggal_kembali" id="tanggal_kembali"
                                        autocomplete="off"
                                        data-position='top left'/>
                                    @error('tanggal_kembali')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_pengembalian" class="col-sm-3 control-label">Tanggal Pengembalian</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        value="{{date('Y-m-d' )}}"
                                        readonly
                                        class="datepicker-here form-control @error('tanggal_pengembalian') is-invalid @enderror"
                                        data-language='en'
                                        name="tanggal_pengembalian" id="tanggal_pengembalian"
                                        autocomplete="off"
                                        data-position='top left'/>
                                    @error('tanggal_pengembalian')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-primary pull-right">Submit</button>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection