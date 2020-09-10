@extends(Session::get('admin') || Session::get('operator') ? 'adminlte::page' : 'layouts.page')
@section('title','Detail Data Denda')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header with-border">
                    <h3 class="card-title">Detail Denda</h3>
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
                                        <span class="info-box-text text-center text-muted">Kode Denda</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{$data->kode_denda}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <?=$qrcode;?>
                                </div>
                            </div>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Keterlambatan</th><td>{{$data->terlambat}} Hari</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Didenda</th><td>{{$data->tanggal_denda}}</td>
                                </tr>
                                @php
                                    switch ($data->status) {
                                        case 'Kurang':
                                            $a = 'danger';
                                            $b = $data->status;
                                            break;

                                        default:
                                            $a = 'success';
                                            $b = $data->status;
                                            break;
                                    }
                                @endphp
                                <tr>
                                    <th>Status</th><td>{{$data->status}} <span class="badge float-right badge-{{$a}}">{{$b}}</span></td>
                                </tr>
                                <tr>
                                    <th>Penginput</th><td>{{$data->get_admin->name}}</td>
                                </tr>
                            </ul>
                        </table>
                        </div>
                        <div class="col-md-6">
                            <h4>Total Denda</h4>
                            <ul class="list-group">
                                <li class="list-group-item">Total Denda <strong class="float-right">{{$data->total_denda}}</strong></li>
                                <li class="list-group-item">Bayar Denda <strong class="float-right">{{$data->bayar_denda}}</strong></li>
                                <br>
                                @php
                                    $total = $data->total_denda;
                                    $bayar = $data->bayar_denda;
                                    $hasil = $total - $bayar;
                                @endphp
                                <li class="list-group-item bg-info">Sisa Bayar <strong class="float-right">{{$hasil}}</strong></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    @if (Session::get('admin') || Session::get('operator'))
                    <a href="{{route('denda.index')}}" class="btn btn-default">
                        <i class="fa fa-backward"></i>
                        Kembali
                    </a>
                        @if ($data->status == 'Kurang')
                        <a href="{{route('denda.edit',$data->id_denda)}}"class="btn btn-sm btn-warning float-right">
                            <i class="fa fa-coins"></i> 
                                Lunasi
                        </a>
                        @else
                        <button class="btn btn-sm btn-default float-right" onClick="Swal.fire('Sudah Lunas')">
                            <i class="fa fa-check"></i> 
                                Lunasi
                        </button>
                        @endif
                    @else 
                    <a href="{{route('denda.index')}}" class="btn btn-default">
                        <i class="fa fa-backward"></i>
                        Kembali
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