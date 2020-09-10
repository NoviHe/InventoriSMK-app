@extends(Session::get('admin') || Session::get('operator') ? 'adminlte::page' : 'layouts.page')
@section('title','Detail Data Inventaris')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header with-border">
                    <h3 class="card-title">Detail Data</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Nama Barang</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{$data->nama}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Kode Inventaris</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{$data->kode_inventaris}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Kondisi</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{$data->kondisi}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered">
                                @php
                                    if ($data->jumlah <= 0) {
                                        $s = 'danger';
                                        $k = 'Kosong';
                                    } else {
                                        $s = 'success';
                                        $k = 'Tersedia';
                                    }
                                @endphp
                                <tr>
                                    <th>Jumlah</th><td>{{$data->jumlah}} <span class="badge float-right badge-{{$s}}">{{$k}}</span></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Masuk</th><td>{{$data->tanggal_registrasi}}</td>
                                </tr>
                            </ul>
                        </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Jenis</th><td>{{$data->get_jenis->nama_jenis}} <span class="badge float-right badge-info">{{$data->get_jenis->kode_jenis}}</span></td>
                                </tr>
                                <tr>
                                    <th>Ruang</th><td>{{$data->get_ruang->nama_ruang}} <span class="badge float-right badge-info">{{$data->get_ruang->kode_ruang}}</span></td>
                                </tr>
                                <tr>
                                    <th>Kategori</th><td>{{$data->get_kategori->nama_kategori}} <span class="badge float-right badge-info">{{$data->get_kategori->kode_kategori}}</span></td>
                                </tr>
                                <tr>
                                    @php
                                        if (!Empty(Session::get('level'))) {
                                            $if = Session::get('level');
                                        } else {
                                            $if = 'admin';
                                        }
                                    @endphp
                                    <th>Petugas</th><td>{{$data->get_petugas->name}} <span class="badge float-right badge-success">{{$if}}</span></td>
                                </tr>
                                <tr>
                                    <th>Keterangan</th><td>{{$data->keterangan}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    @if (Session::get('admin') || Session::get('operator'))
                    <a class="btn btn-default"href="{{route('inventaris.index')}}">
                        <i class="fa fa-backward"></i> Kembali
                    </a>
                    <a class="btn btn-warning"href="{{route('inventaris.edit', [$data->id_inventaris])}}">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                    <button class="btn btn-danger float-right" type="submit" data-toggle="modal" 
                    data-target="#modalHapus"><i class="fa fa-trash"></i> Delete</button>
                    @else
                    <a class="btn btn-default"href="{{route('inventaris.daftar')}}">
                        <i class="fa fa-backward"></i> Kembali
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('modal')
<div class="modal modal-danger fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{route('inventaris.destroy', [$data->id_inventaris])}}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Delete</h4>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin ingin menghapus Data&hellip;</p>
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline float-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline">Delete</button>
                </div>
            </form>
        </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endpush

@push('css')
    <style>
        table{
            font-size: 12pt;
        }
        th{
            width: 150px;
        }
    </style>
@endpush