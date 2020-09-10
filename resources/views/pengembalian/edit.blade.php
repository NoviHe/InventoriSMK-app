@extends('adminlte::page')
@section('title','Input Data Pengembalian')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-warning">
                    <div class="card-header with-border">
                        <h3 class="card-title">Update Pengembalian</h3>
                    </div>
                    <form action="{{route('pengembalian.update',$data->id_kembali)}}" method="POST" class="form-horizontal" autocomplete="off">
                        {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    <div class="card-body">
                        <div class="row">
                            <label class="col-sm-2 col-form-label" for="kode_kembali">Nomor Pengembalian</label>
                            <div class="col-sm-10">
                                <input type="text" name="kode_kembali" id="kode_kembali"
                                value="{{old('kode_kembali',$data->kode_kembali)}}"
                                class="form-control" readonly>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="user" class="col-sm-3 col-form-label">ID | Nama Pegawai</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" readonly 
                                        value="{{old('user_id', $data->user_id)}} | {{old('name', $data->get_user->name)}}"
                                        name="user" id="user">
                                        <input type="hidden" name="user_id" id="user_id" value="{{old('user_id',$data->user_id)}}">
                                        <input type="hidden" name="pinjam_id" id="pinjam_id" value="{{old('pinjam_id',$data->pinjam_id)}}">
                                        <input type="hidden" name="id_kembali" id="id_kembali" value="{{old('id_kembali',$data->id_kembali)}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="status" class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control"
                                        value="{{old('status',$data->status)}}"
                                        readonly name="status" id="status">
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Data Barang Dikembalikan</h4>
                                <ul class="list-group">
                                    @foreach ($cart as $item)
                                    <li class="list-group-item" >
                                        <input class="" type="hidden" name="cartOld[]" checked
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

                            <div class="col-md-6">
                                <h4>Data Barang Belum Dikembalikan</h4>
                                <ul class="list-group">
                                    @foreach ($carts as $item)
                                    <li class="list-group-item" >
                                        <input class="" type="checkbox" name="cart[]" checked
                                        id="{{$item['kode']}}" value="{{$item['items']['id_inventaris']}}">
                                        <span class="float-right badge bg-primary"> {{$item['qty']}}</span>
                                        <label for="{{$item['kode']}}"> {{$item['items']['nama']}}</label>
                                        <span class="badge badge-success">{{$item['kode']}}</span>
                                    </li>
                                    @endforeach
                                    <li class="list-group-item bg-info">Total Barang : <strong>{{$totalQtys}}</strong></li>
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