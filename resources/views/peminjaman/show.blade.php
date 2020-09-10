@extends(Session::get('admin') || Session::get('operator') ? 'adminlte::page' : 'layouts.page')
@section('title','Detail Data Peminjaman')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header with-border">
                    <h3 class="card-title">Detail Data Peminjaman</h3>
                    <a href="#" class="btn btn-info btn-sm float-right"><i class="fa fa-print"></i> Print</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Nama Peminjam</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{$data->get_user->name}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">No. Peminjaman</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{$data->kode_pinjam}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <?=$qrcode;?>
                                </div>
                            </div>
                            <table class="table table-bordered">
                                @php
                                switch ($data->status) {
                                    case 'Dipinjam':
                                        $a = 'DIPINJAM';
                                        $b = 'success';
                                        break;
                                    case 'Kurang':
                                        $a = 'KURANG';
                                        $b = 'warning';
                                        break;
                                    default:
                                        $a = 'DIKEMBALIKAN';
                                        $b = 'danger';
                                        break;
                                }
                                @endphp
                                <tr>
                                    <th>Status</th><td>{{$data->status}} <span class="badge float-right badge-{{$b}}">{{$a}}</span></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Peminjaman</th><td>{{$data->tanggal_pinjam}}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Kembali</th><td>{{$data->tanggal_kembali}}</td>
                                </tr>
                                <tr>
                                    <th>Lama Peminjaman</th><td>{{$data->lama_pinjam}} Hari</td>
                                </tr>
                                <tr>
                                    <th>Penginput</th><td>{{$data->get_admin->name}} <span class="badge float-right badge-info">{{$data->get_admin->level}}</span></td>
                                </tr>
                            </ul>
                        </table>
                        </div>
                        <div class="col-md-6">
                            <h4>Barang Di Pinjam</h4>
                            <ul class="list-group">
                                @if ($data->cart == '[]')
                                    <li class="list-group-item">Barang Sudah Dikembalikan Semua</li>
                                @else
                                    @foreach ($items as $item)
                                    <li class="list-group-item">
                                        <span class="float-right badge bg-primary"> {{$item['qty']}}</span>
                                        <strong> {{$item['items']['nama']}}</strong>
                                        <span class="badge badge-success">{{$item['kode']}}</span>
                                    </li>
                                    @endforeach
                                    <li class="list-group-item bg-info">Total Barang : <strong>{{$totalQty}}</strong></li>
                                @endif
                            </ul><br>
                            <h4>Barang Di Kembalikan</h4>
                            <ul class="list-group">
                                @if (!empty($data->cart_full))
                                    @foreach ($result as $item)
                                    <li class="list-group-item">
                                        <span class="float-right badge bg-primary"> {{$item['qty']}}</span>
                                        <strong> {{$item['items']['nama']}}</strong>
                                        <span class="badge badge-success">{{$item['kode']}}</span>
                                    </li>
                                    @endforeach
                                @else
                                    <li class="list-group-item">Belum ada Barang yang DIKEMBALIKAN</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    @if (Session::get('admin') || Session::get('operator'))
                    <a class="btn btn-default"href="{{route('peminjaman.index')}}">
                        <i class="fa fa-backward"></i> Kembali
                    </a>
                        @if ($data->status == 'Dipinjam')
                        <a class="btn btn-warning float-right" href="{{route('peminjaman.edit',$data->id_peminjaman)}}">
                            <i class="fa fa-download"></i> Pengembalian
                        </a>
                        @elseif($data->status == 'Kurang')
                        <a class="btn btn-warning float-right" href="{{route('pengembalian.edit',$data->id_peminjaman)}}">
                            <i class="fa fa-download"></i> Update Pengembalian
                        </a>  
                        @endif
                    @else
                    <a class="btn btn-default"href="{{route('pinjam.histori')}}">
                        <i class="fa fa-backward"></i> Kembali
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection

@push('css')
    <style>
        th{
            width: 190px;
        }
    </style>
@endpush