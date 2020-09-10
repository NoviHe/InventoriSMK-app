@extends('adminlte::page')
@section('title','Data Pengembalian')
@section('content_header')
    <h1>Pengembalian <small>Data</small></h1>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header with-border">
                    @if (Session::get('admin'))
                        <button type="button" class="btn btn-primary float-sm-left" data-toggle="modal" data-target="#modal-report">
                            <i class="fa fa-print"></i> REPORT
                        </button>
                        @else
                        <h3 class="card-title">Pengembalian Data</h3>
                    @endif
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Peminjaman</th>
                                    <th>Nomer Pengembalian</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Status</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $dt)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$dt->get_user->name}}</td>
                                <td>{{$dt->kode_kembali}}</td>
                                <td>{{$dt->tanggal_masuk}}</td>
                                @php
                                    switch ($dt->status) {
                                        case 'Clear':
                                            $status = '<span class="badge badge-success">Clear</span>';
                                            break;

                                        case 'Terlambat':
                                            $status = '<span class="badge badge-danger">Terlambat</span>';
                                            break;

                                        case 'Kurang':
                                            $status = '<span class="badge badge-warning">Kurang</span>';
                                            break;

                                        case 'Complete':
                                            $status = '<span class="badge badge-success">Complete</span>';
                                            break;
                                        default:
                                            $status = '<span class="badge badge-danger">Terlambat & Kurang</span>';
                                            break;
                                    }
                                @endphp
                                <td><?=$status;?></td>
                                <td>
                                    <a href="{{route('pengembalian.show', $dt->id_kembali)}}"
                                        class="btn btn-info">
                                    <i class="fa fa-eye"></i> Detail
                                    </a>
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
<div class="modal fade" id="modal-report">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Report Menu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{route('kembali.excel')}}" target="_blank" class="col-12 btn btn-success float-sm-left">
                            <i class="fa fa-print"></i>
                            REPORT Excel
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{route('kembali.pdf')}}" target="_blank" class="col-12 btn btn-danger float-sm-left">
                            <i class="fa fa-print"></i>
                            REPORT Pdf
                        </a>
                    </div>
                </div>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-primary float-right" data-dismiss="modal">Done</button>
            </div>
        </div>
    </div>
</div>
@endpush
