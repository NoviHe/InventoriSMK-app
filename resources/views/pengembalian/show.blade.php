@extends(Session::get('admin') || Session::get('operator') ? 'adminlte::page' : 'layouts.page')
@section('title','Detail Data Pengembalian')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header with-border">
                    <h3 class="card-title">Detail Data Pengembalian</h3>
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
                                        <span class="info-box-text text-center text-muted">No. Pengembalian</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{$data->kode_kembali}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="">
                                        <?=$qrcode?>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered">
                                @php
                                    switch ($data->status) {
                                        case 'Clear':
                                            $status = '<span class="badge float-right badge-success">Clear</span>';
                                            break;

                                        case 'Terlambat':
                                            $status = '<span class="badge float-right badge-danger">Terlambat</span>';
                                            break;

                                        case 'Kurang':
                                            $status = '<span class="badge float-right badge-warning">Kurang</span>';
                                            break;

                                        default:
                                            $status = '<span class="badge float-right badge-danger">Terlambat & Kurang</span>';
                                            break;
                                    }
                                @endphp
                                <tr>
                                    <th>Status</th><td>{{$data->status}} <?=$status?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Pengembalian</th><td>{{$data->tanggal_masuk}}</td>
                                </tr>
                                <tr>
                                    @php
                                        if (!empty($data->terlambat)) {
                                            $hari = $data->terlambat. "Hari";
                                        } else {
                                            $hari = "Tepat Waktu";
                                        }
                                    @endphp
                                    <th>Terlambat</th><td>{{$hari}}</td>
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
                                @if ($data->status == 'Kurang' || $data->status == 'Terlambat & Kurang' )
                                    @foreach ($cart_sisa as $item)
                                        <li class="list-group-item">
                                            <span class="float-right badge bg-primary"> {{$item['qty']}}</span>
                                            <strong> {{$item['items']['nama']}}</strong>
                                            <span class="badge badge-success">{{$item['kode']}}</span>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="list-group-item">Kosong</li>
                                @endif
                            </ul><br>
                            <h4>Barang Di Kembalikan</h4>
                            <ul class="list-group">
                                @foreach ($cart as $item)
                                <li class="list-group-item">
                                    <span class="float-right badge bg-primary"> {{$item['qty']}}</span>
                                    <strong> {{$item['items']['nama']}}</strong>
                                    <span class="badge badge-success">{{$item['kode']}}</span>
                                </li>
                                @endforeach
                                <li class="list-group-item bg-info">Total Barang : <strong>{{$totalQty}}</strong>
                                    @if (Session::get('admin'))
                                        <a class="btn btn-sm btn-info float-right" href="{{route('peminjaman.show', $data->pinjam_id)}}"> Detail</a>
                                    @else 
                                    <a class="btn btn-sm btn-info float-right" href="{{route('pinjam.show', $data->pinjam_id)}}"> Detail</a>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    @if (Session::get('admin') || Session::get('operator'))
                    <a class="btn btn-default"href="{{route('pengembalian.index')}}">
                        <i class="fa fa-backward"></i> Kembali
                    </a>
                    @else
                    <a class="btn btn-default"href="{{route('denda.cek')}}">
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