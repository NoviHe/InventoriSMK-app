@extends('adminlte::page')
@section('title','Edit Data Kategori')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-warning">
                <div class="card-header with-border">
                    <h3 class="card-title">Edit Data</h3>
                </div>
                {!! Form::model($data, ['route'=> ['kategori.update',$data->id_kategori], 'method' => 'PUT','autocomplete'=>'off' ,'class'=>'form-horizontal']) !!}
                <div class="card-body">
                    <div class="form-group row">
                        {!! Form::label('nama_kategori', 'Nama Kategori',['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('nama_kategori', null, ['class'=>'form-control', 'id'=>'nama_kategori', 'placeholder'=>'Nama Kategori']) !!}
                            @error('nama_kategori')
                                <div class="text-danger"><small>{{$message}}</small></div>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        {!! Form::label('kode_kategori', 'Kode Kategori',['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                        {!! Form::text('kode_kategori', null, ['class'=>'form-control', 'id'=>'kode_kategori', 'readonly']) !!}
                        @error('nama_kategori')
                            <div class="text-danger"><small>{{$message}}</small></div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('keterangan', 'Keterangan',['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                        {!! Form::text('keterangan', null, ['class'=>'form-control', 'id'=>'keterangan', 'placeholder'=>'Keterangan']) !!}
                        @error('keterangan')
                            <div class="text-danger"><small>{{$message}}</small></div>
                        @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a class="btn btn-default"href="{{route('kategori.index')}}">
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