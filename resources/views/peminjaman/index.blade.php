@extends('adminlte::page')
@section('title','Data Peminjaman')
@section('content_header')
    <h1>Peminjaman <small>Data</small></h1>
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
                    <h3 class="card-title">Peminjaman Data</h3>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="myTable1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Peminjaman</th>
                                <th>Nomer Pinjaman</th>
                                <th>Lama Pinjaman</th>
                                <th>Status</th>
                                <th>Detail</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $dt)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$dt->name}}</td>
                            <td>{{$dt->kode_pinjam}}</td>
                            <td>{{$dt->lama_pinjam}} Hari</td>
                            @php
                            switch ($dt->status) {
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
                            <td><span class="badge badge-{{$b}}">{{$a}}</span></td>
                            <td>
                                <a href="{{route('peminjaman.show', $dt->id_peminjaman)}}"
                                    class="btn btn-info">
                                <i class="fa fa-eye"></i> Detail
                                </a>
                            </td>
                            <td>
                                @if ($dt->status == 'Dipinjam') 
                                <a href="{{route('pengembalian.add',$dt->id_peminjaman)}}"
                                    class="btn btn-warning">
                                <i class="fa fa-download"></i> Kembali
                                </a>
                                @elseif($dt->status == 'Kurang')
                                <a href="{{route('pengembalian.edit',$dt->id_peminjaman)}}"
                                    class="btn btn-warning">
                                <i class="fa fa-download"></i> Update
                                </a>
                                @else
                                <button class="btn btn-default" onClick="Swal.fire('Data Sudah Dikembalikan')">
                                    <i class="fa fa-download"></i> Kembali
                                </button>
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
                        <a href="{{route('pinjam.excel')}}" target="_blank" class="col-12 btn btn-success float-sm-left">
                            <i class="fa fa-print"></i>
                            REPORT Excel
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{route('pinjam.pdf')}}" target="_blank" class="col-12 btn btn-danger float-sm-left">
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

@push('js')
    <script>
        $(document).ready(function(){
            $('#myTable1').DataTable({
                "scrollY":"250px",
                "scrollCollapse": true
                
            })
        })
    </script>
@endpush