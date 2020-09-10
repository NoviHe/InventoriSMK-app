@extends('layouts.page')
@section('title','Data Pegawai')
@section('content_header')
<h1>Pegawai <small>Data</small></h1>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header with-border">
                    <h3 class="card-title">Detail Data</h3>
                    <a href="{{route('pegawai.setting')}}" class="btn btn-primary float-right">Setting Data</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Nama Pegawai</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{$data->name}}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-sm-6">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">No Telepon</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{$data->no_telp}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-7">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nama</th><td>{{$data->name}} </td>
                                </tr>
                                <tr>
                                    <th>Email</th><td>{{$data->email}} </td>
                                </tr>
                                <tr>
                                    <th>No Telp</th><td>{{$data->no_telp}} </td>
                                </tr>
                                <tr>
                                    <th>Alamat</th><td>{{$data->alamat}} </td>
                                </tr>
                                <tr>
                                    <th>Tanggal Registrasi</th><td>{{$data->created_at}}</td>
                                </tr>
                            </ul>
                        </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
