@extends('adminlte::page')
@section('title','Edit Data Jenis')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="card card-warning">
                <div class="card-header with-border">
                    <h3 class="card-title">Edit Data</h3>
                </div>
                {!! Form::model($data, ['route'=> ['jenis.update',$data->id_jenis], 'method' => 'PUT' ,'class'=>'form-horizontal']) !!}
                <div class="card-body">
                    <div class="form-group row">
                        {!! Form::label('nama_jenis', 'Nama Jenis',['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('nama_jenis', null, ['class'=>'form-control ', 'id'=>'nama_jenis']) !!}
                            @error('nama_jenis')
                                <div class="text-danger"><small>{{$message}}</small></div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row ">
                        {!! Form::label('kode_jenis', 'Kode Jenis',['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                        {!! Form::text('kode_jenis', null, ['class'=>'form-control', 'id'=>'kode_jenis', 'readonly']) !!}
                        @error('nama_jenis')
                            <div class="text-danger"><small>{{$message}}</small></div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('keterangan', 'Keterangan',['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                        {!! Form::text('keterangan', null, ['class'=>'form-control', 'id'=>'keterangan']) !!}
                        @error('keterangan')
                            <div class="text-danger"><small>{{$message}}</small></div>
                        @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a class="btn btn-default"href="{{route('jenis.index')}}">
                        <i class="fa fa-backward"></i> Kembali
                    </a>
                    {!! Form::submit('Simpan', ['class'=>'btn btn-success float-right']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection