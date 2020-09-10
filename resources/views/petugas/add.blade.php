@extends('adminlte::page')
@section('title','Input Data Petugas')
@section('content_header')
    <h1>Petugas <small>Input</small></h1>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header with-border">
                    <h3 class="card-title">Input Data Petugas</h3>
                </div>
                <form method="post" action="{{route('petugas.store')}}" class="form-horizontal">
                    {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama Petugas</label>
                        <div class="col-sm-10">
                            <input placeholder="Name" type="text" class="form-control @error('name') is-invalid @enderror" 
                            name="name" id="name">
                            @error('name')
                                <div class="text-danger invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" 
                            name="email" id="email">
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
                        <label for="level" class="col-sm-2 col-form-label">Level</label>
                        <div class="col-sm-10">
                            @php
                                $val = old('level');
                            @endphp
                            <select name="level" id="level" class="form-control @error('level') is-invalid @enderror">
                                <option value="" {{$val==""?'selected':''}}>Pilih :</option>
                                <option value="Operator" {{$val=="operator"?'selected':''}}>Operator</option>
                                <option value="Admin" {{$val=="admin"?'selected':''}}>Adminisator</option>
                            </select>
                            @error('level')
                                <div class="text-danger invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a class="btn btn-default"href="{{route('petugas.index')}}">
                        <i class="fa fa-backward"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection