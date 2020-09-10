@extends('layouts.page')
@section('title','User Histori Data Peminjaman')
@section('content_header')
    <h1>Histori <small>Data Peminjaman</small></h1>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header with-border">
                    <h3 class="card-title">Histori Data Peminjaman</h3>
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
                                <a href="{{route('pinjam.show', $dt->id_peminjaman)}}"
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