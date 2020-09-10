@extends('adminlte::page')
@section('title','Edit Data Ruang')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-warning">
                <div class="card-header with-border">
                    <h3 class="card-title">Edit Data Ruang</h3>
                </div>
                {!! Form::model($data, ['route'=> ['ruang.update',$data->id_ruang], 'method' => 'PUT','autocomplete'=>'off','class'=>'form-horizontal' ]) !!}
                <div class="card-body">
                    <div class="form-group row">
                        {!! Form::label('nama_ruang', 'Nama ruang',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('nama_ruang', null, ['class'=>'form-control', 'placeholder'=>'Nama Ruang' , 'id'=>'nama_ruang']) !!}
                            @error('nama_ruang')
                                <div class="text-danger"><small>{{$message}}</small></div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('kode_ruang', 'Kode ruang',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('kode_ruang', null, ['class'=>'form-control', 'id'=>'kode_ruang','readonly']) !!}
                            @error('nama_ruang')
                                <div class="text-danger"><small>{{$message}}</small></div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('keterangan', 'Keterangan',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('keterangan', null, ['class'=>'form-control', 'placeholder'=>'Keterangan', 'id'=>'keterangan']) !!}
                            @error('keterangan')
                                <div class="text-danger"><small>{{$message}}</small></div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a class="btn btn-default"href="{{route('ruang.index')}}">
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