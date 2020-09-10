@extends('adminlte::page')
@section('title','Data Denda')
@section('content_header')
    <h1>Denda <small>Add Data</small></h1>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header with-border">
                    <h3 class="card-title">Tambah Data Denda</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Peminjam</th>
                                <th>Kode Pengembalian</th>
                                <th>Terlambat</th>
                                <th>Denda</th>
                                <th>Detail</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $dt)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$dt->get_user->name}}</td>
                                    <td>{{$dt->kode_kembali}}</td>
                                    <td>{{$dt->terlambat}} <span class="badge float-right bg-danger">{{$dt->status}}</span></td>
                                    <td>Rp. {{$hasil = $dt->terlambat * 1000}}</td>
                                    <td>
                                        <a href="{{route('pengembalian.show',$dt->id_kembali)}}" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i>
                                            Detail
                                        </a>
                                    </td>
                                    <td>
                                        @if ($dt->status == 'Terlambat & Kurang')
                                            <a  href="{{route('pengembalian.edit',$dt->pinjam_id)}}" class="btn btn-sm btn-warning" onClick="Swal.fire('Lengkapi Dulu barang Pinjaman')"><i class="fa fa-coins"></i> Denda</a>
                                            @else
                                            <a href="{{route('denda.add',$dt->id_kembali)}}" class="btn btn-sm btn-danger"><i class="fa fa-coins"></i> Denda</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('modal')
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Large Modal</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{route('denda.store')}}">

            </form>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
</div>
@endpush