@extends('adminlte::page')
@section('title','Input Data Pegawai')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary ">
                <div class="card-header with-border">
                    <h3 class="card-title">Input Data Pegawai</h3>
                </div>
                <form method="post" action="{{route('pegawai.store')}}" class="form-horizontal" autocomplete="off">
                    {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama Pegawai</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                            placeholder="Nama Pegawai" name="name" id="name">
                        @error('name')
                                <div class="text-danger invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email Pegawai</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                            placeholder="Nama Pegawai" name="email" id="email">
                        @error('email')
                                <div class="text-danger invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" 
                            name="password" id="password">
                            @error('password')
                                <div class="text-danger invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rePassword" class="col-sm-2 col-form-label">Re rePassword</label>
                        <div class="col-sm-10">
                            <input placeholder="Re Password" type="password" class="form-control @error('rePassword') is-invalid @enderror" 
                            name="rePassword" id="rePassword">
                            @error('rePassword')
                                <div class="text-danger invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_telp" class="col-sm-2 col-form-label">No Hp</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control @error('no_telp') is-invalid @enderror" 
                            placeholder="Nomor Telepon" name="no_telp" id="no_telp"  maxlength="13"
                            pattern="/^-?\d+\.?\d*$" onkeypress="if(this.value.length==13) return false;">
                        @error('no_telp')
                                <div class="text-danger invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" 
                            placeholder="Alamat" name="alamat" id="alamat">
                        @error('alamat')
                                <div class="text-danger invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a class="btn btn-default"href="{{route('pegawai.index')}}">
                        <i class="fa fa-backward"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary float-right" >Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
