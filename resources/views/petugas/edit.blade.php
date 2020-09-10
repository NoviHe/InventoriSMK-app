@extends('adminlte::page')
@section('title','Edit Data Petugas')
@section('content_header')
    <h1>Petugas <small>Edit</small></h1>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-warning">
                <div class="card-header with-border">
                    <h3 class="card-title">Edit Data Petugas</h3>
                </div>
                {!! Form::model($data, ['route'=> ['petugas.update',$data->id], 'method' => 'PUT', 'class' => 'form-horizontal' ]) !!}
                <div class="card-body">
                    <div class="card-body">
                        <div class="form-group">
                            {!! Form::label('name', 'Nama Petugas',['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('name', null, ['class'=>'form-control ', 'id'=>'name','placeholder'=>'Nama Petugas']) !!}
                                @error('name')
                                <div class="text-danger ">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', 'Email Petugas',['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::email('email', null, ['class'=>'form-control ', 'id'=>'email','placeholder'=>'Email Petugas']) !!}
                                @error('email')
                                <div class=" text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            
                        </div>
                        <div class="form-group">
                            {!! Form::label('password', 'Password',['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::password( null, ['class'=>'form-control ', 'id'=>'password','placeholder'=>'Password']) !!}
                                <div class="form-text text-muted">
                                    <small>*Kosongkan Password apabila tidak di ubah</small>
                                    @error('password')
                                        <div class=" text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('rePassword', 'Re Password',['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::password( null, ['class'=>'form-control ', 'id'=>'rePassword','placeholder'=>'Re Password']) !!}
                                @error('rePassword')
                                    <div class=" text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="level" class="col-sm-2 control-label">Level</label>
                            <div class="col-sm-10">
                                @php
                                    $val = old('level', $data->level);
                                @endphp
                                <select name="level" class="form-control  @error('level') is-invalid @enderror" id="level">
                                    <option value="" {{$val==""?'selected':''}}>Pilih :</option>
                                    <option value="admin" {{$val=="admin"?'selected':''}}>Adminisator</option>
                                    <option value="operator" {{$val=="operator"?'selected':''}}>Operator</option>
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
                    {!! Form::submit('Simpan', ['class'=>'btn btn-warning float-right']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection