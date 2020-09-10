@extends('layouts.page')
@section('title','User Histori Data Denda')
@section('content_header')
    <h1> Histori <small>Data Denda</small></h1>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @if ($data == "[]")
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <h3 behavior="alternate" class="text-center"> Anda belum memiliki histori Denda apapun</h3>
                </div>
            @else
            <div class="card">
                <div class="card-header with-border">
                    <h3 class="card-title">Histori Data Denda</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Denda</th>
                                <th>Nama</th>
                                <th>status</th>
                                <th>Detail</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $dt)                                
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$dt->kode_denda}}</td>
                                <td>{{$dt->get_user->name}}</td>
                                @php
                                    switch ($dt->status) {
                                        case 'Kurang':
                                            $status = '<span class="badge badge-danger">Kurang</span>';
                                            break;
                                        
                                        default:
                                            $status = '<span class="badge badge-success">Lunas</span>';
                                            break;
                                    }
                                @endphp
                                <td><?=$status;?></td>
                                <td>
                                    <a href="{{route('denda.show',$dt->id_denda)}}" class="btn btn-sm btn-info">
                                        <i class="fa fa-eye"></i> 
                                            Detail
                                    </a>
                                </td>
                                <td>
                                    @if ($dt->status == 'Kurang')
                                    <button class="btn btn-sm btn-warning" onClick="Swal.fire('Ke Operator Untuk melunasi Denda')">
                                        <i class="fa fa-coins"></i> 
                                            Lunasi
                                    </button>
                                    @else
                                    <button class="btn btn-sm btn-default" onClick="Swal.fire('Sudah Lunas')">
                                        <i class="fa fa-check"></i> 
                                            Lunasi
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
            @endif
        </div>
    </div>
</div>
@endsection