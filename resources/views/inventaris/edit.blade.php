@if (Session::get('admin'))
    @extends('adminlte::page')
@else
    @extends('layouts.page')
@endif
@section('title','Edit Data Inventaris')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-warning">
                <div class="card-header with-border">
                    <h3 class="card-title">Edit Data</h3>
                </div>
                {!! Form::model($data, ['route'=> ['inventaris.update',$data->id_inventaris], 'method' => 'PUT','class'=>'form-horizontal']) !!}
                <div class="card-body">
                    <div class="form-group row">
                        {!! Form::label('kode_inventaris', 'Kode Inventaris', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                        {!! Form::text('kode_inventaris', null, ['class'=>'form-control', 'id'=>'kode_inventaris', 'readonly']) !!}
                        @error('kode_inventaris')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('nama', 'Nama Barang', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('nama', null, ['class'=>'form-control', 'id'=>'nama', 'placeholder'=>'Nama Barang']) !!}
                            @error('nama')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        {!! Form::label('kondisi', 'Kondisi', ['class' => 'col-sm-2 col-form-label'] ) !!}
                        <div class="col-sm-10">
                            <?php $val = old('kondisi',$data->kondisi); ?>
                            <select name="kondisi" id="kondisi" class="form-control">
                                <option {{$val=="Baru"?'selected':''}}>Baru</option>
                                <option {{$val=="Lama"?'selected':''}}>Lama</option>
                            </select>
                            @error('kondisi')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('jumlah', 'Jumlah', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                        {!! Form::number('jumlah', null, ['class'=>'form-control', 'id'=>'jumlah', 'placeholder'=>'Jumlah']) !!}
                        @error('jumlah')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('id_jenis', 'Jenis', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            <select name="id_jenis" id="id_jenis" class="form-control">
                                <?php $jen = old('id_jenis',$data->id_jenis); ?>
                                @foreach ($jenis as $jn)
                                <option value="{{$jn->id_jenis}}" {{$jen=="$jn->id_jenis"?'selected':''}}>{{$jn->nama_jenis}}</option>    
                                @endforeach
                            </select>
                            @error('id_jenis')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        {{-- {!! Form::number('id_jenis', null, ['class'=>'form-control', 'id'=>'id_jenis']) !!} --}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('id_ruang', 'Ruang', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            <select name="id_ruang" id="id_ruang" class="form-control">
                                <?php $rua = old('id_ruang',$data->id_ruang); ?>
                                @foreach ($ruang as $ru)
                                <option value="{{$ru->id_ruang}}" {{$rua=="$ru->id_ruang"?'selected':''}}>{{$ru->nama_ruang}}</option>    
                                @endforeach
                            </select>
                            @error('id_ruang')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        {{-- {!! Form::number('id_ruang', null, ['class'=>'form-control', 'id'=>'id_ruang']) !!} --}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('id_kategori', 'kategori', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            <select name="id_kategori" id="id_kategori" class="form-control">
                                <?php $kat = old('id_kategori',$data->id_kategori); ?>
                                @foreach ($kategori as $ka)
                                <option value="{{$ka->id_kategori}}" {{$kat=="$ka->id_kategori"?'selected':''}}>{{$ka->nama_kategori}}</option>    
                                @endforeach
                            </select>
                            @error('id_ruang')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        {{-- {!! Form::number('id_ruang', null, ['class'=>'form-control', 'id'=>'id_ruang']) !!} --}}
                        </div>
                    </div>
                    <div class="form-group row ">
                        {!! Form::label('keterangan', 'Keterangan', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                        {!! Form::text('keterangan', null, ['class'=>'form-control', 'id'=>'keterangan', 'placeholder'=>'Keterangan']) !!}
                        @error('keterangan')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a class="btn btn-default"href="{{route('inventaris.index')}}">
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
