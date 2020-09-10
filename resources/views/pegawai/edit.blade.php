@extends('adminlte::page')
@section('title','Edit Data Pegawai')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-warning">
                <div class="card-header with-border">
                    <h3 class="card-title">Edit Data Pegawai</h3>
                </div>
                {!! Form::model($data, ['route'=> ['pegawai.update',$data->id], 'method' => 'PUT', 'class'=>'form-horizontal' ]) !!}
                <div class="card-body">
                    <div class="form-group row">
                        {!! Form::label('name', 'Nama Pegawai',['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('name', null, ['class'=>'form-control', 'id'=>'name', 'placeholder' => 'Nama Pegawai']) !!}
                            @error('name')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('email', 'Email Pegawai',['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('email', null, ['class'=>'form-control', 'id'=>'email','placeholder' => 'Email Pegawai']) !!}
                            @error('email')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('password', 'Password',['class'=>'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::password( null, ['class'=>'form-control', 'id'=>'password','placeholder'=>'Password', 'name'=>'password']) !!}
                            <div class="form-text text-muted">
                                <small>*Kosongkan Password apabila tidak di ubah</small>
                                @error('password')
                                    <div class="invalid-feedback text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('rePassword', 'Re Password',['class'=>'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::password( null, ['class'=>'form-control', 'id'=>'rePassword','placeholder'=>'Re Password']) !!}
                            @error('rePassword')
                                <div class="invalid-feedback text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('no_telp', 'No Hp ',['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::number('no_telp', null, [ 'placeholder' => 'Nomor Telepon',
                                'class'=>'form-control', 'id'=>'no_telp', 'pattern'=>'/^-?\d+\.?\d*$',
                                'onkeypress'=>'if(this.value.length==12) return false;'
                                ]) !!}
                            @error('no_telp')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('alamat', 'Alamat Pegawai',['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('alamat', null, [ 'placeholder' => 'Alamat','class'=>'form-control', 'id'=>'alamat']) !!}
                            @error('alamat')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a class="btn btn-default"href="{{route('pegawai.index')}}">
                        <i class="fa fa-backward"></i> Kembali
                    </a>
                    {!! Form::submit('Update', ['class'=>'btn btn-warning float-right']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection