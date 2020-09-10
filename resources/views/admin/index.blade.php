@extends('adminlte::page')

@section('title', 'Dashboard Admin')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    {{-- <div class="row"> --}}
        @component('cekLogin')
        @endcomponent
    {{-- </div> --}}
    <div class="row">
        @if(Session::get('admin'))
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{Auth::user()->count()}}</h3>
                    <p>Petugas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i>
                </div>
                <a href="{{route('petugas.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        @endif

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{App\User::all()->count()}}</h3>
                    <p>Pegawai</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-stalker"></i>
                </div>
                <a href="{{route('pegawai.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
            <div class="inner">
                <h3>{{App\Inventaris::all()->count()}}</h3>
                <p>Data Barang</p>
            </div>
            <div class="icon">
                <i class="ion ion-cube"></i>
            </div>
            <a href="{{route('inventaris.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
            <h3>{{App\Peminjaman::all()->count()}}</h3>

            <p>Total Pinjaman</p>
            </div>
            <div class="icon">
            <i class="ion ion-ios-upload"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name </th><td>{{Session::get('name')}}</td>
                        </tr>
                        <tr>
                            <th>Email </th><td>{{Session::get('email')}}</td>
                        </tr>
                        <tr>
                            <th>Level </th><td>{{Session::get('level')}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
