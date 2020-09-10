@extends('adminlte::page')
@section('title','Setting Data Petugas')
@section('content_header')
    <h1>Petugas <small>Setting</small></h1>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Data Petugas</h3>
                </div>
                {!! Form::model($dt, ['route'=> ['petugas.setting'], 'method' => 'post', 'class' => 'form-horizontal' ]) !!}
                <div class="box-body">
                    <div class="form-group">
                        {!! Form::label('name', 'Nama Petugas',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('name', null, ['class'=>'form-control', 'id'=>'name','placeholder'=>'Nama Petugas']) !!}
                            @error('name')
                            <div class="text-danger invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', 'Email Petugas',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::email('email', null, ['class'=>'form-control', 'id'=>'email','placeholder'=>'Email Petugas']) !!}
                            @error('email')
                            <div class="invalid-feedback text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="form-group">
                        {!! Form::label('password', 'Password',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::password( null, ['class'=>'form-control', 'id'=>'password','placeholder'=>'Password']) !!}
                            <div class="form-text text-muted">
                                <small>*Kosongkan Password apabila tidak di ubah</small>
                                @error('password')
                                    <div class="invalid-feedback text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('rePassword', 'Re Password',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::password( null, ['class'=>'form-control', 'id'=>'rePassword','placeholder'=>'Re Password']) !!}
                            @error('rePassword')
                                <div class="invalid-feedback text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a class="btn btn-default"href="{{route('home')}}">
                        <i class="fa fa-backward"></i> Kembali
                    </a>
                    {!! Form::submit('Simpan', ['class'=>'btn btn-warning pull-right']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection