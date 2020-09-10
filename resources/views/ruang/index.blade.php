@extends('adminlte::page')
@section('title','Data Ruang')
@section('content_header')
    <h1>Ruang <small>Data</small></h1>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header with-border">
                <h3 class="card-title">Input Data Ruang</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" autocomplete="off" action="{{route('ruang.store')}}">
                    {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_ruang">Nama Ruang</label>
                        <input type="text" name="nama_ruang" placeholder="Nama Ruang" id="nama_ruang" 
                        class="form-control @error('nama_ruang') is-invalid @enderror">
                        @error('nama_ruang')
                            <div class="text-danger invalid-feedback "><small>{{$message}}</small></div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kode_ruang">Kode Ruang</label>
                        <input type="text" name="kode_ruang" id="kode_ruang" readonly value="{{$kode}}"
                        class="form-control   @error('nama_ruang') is-invalid @enderror">
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan" placeholder="Keterangan"
                        class="form-control @error('nama_ruang') is-invalid @enderror">
                        @error('keterangan')
                            <div class="text-danger invalid-feedback"><small>{{$message}}</small></div>
                        @enderror
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header with-border">
                <h3 class="card-title">Bordered Table</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table class="table table-bordered" id="myTable">
                    <thead>
                        <tr>
                            <th id="no">No.</th>
                            <th>Ruang</th>
                            <th>Kode Ruang</th>
                            <th>Keterangan</th>
                            <th id="aksi">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $dt)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$dt->nama_ruang}}</td>
                            <td>{{$dt->kode_ruang}}</td>
                            <td>{{$dt->keterangan}}</td>
                            <td>
                                <a class="btn btn-sm btn-warning" 
                                    href="{{route('ruang.edit', $dt->id_ruang)}}"><i class="fa fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-trash" type="submit" data-id="{{$dt->id_ruang}}"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('modal')
<div class="modal fade" id="modalHapus">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <form method="POST" id="form-delete" action="{{route('ruang.delete')}}">
            <div class="modal-header">
                <h4 class="modal-title">Delete Data!!</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus Data&hellip;</p>
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="id_ruang" id="input-id">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-light btn-delete">Delete!!</button>
            </div>
        </div>
    </div>
</div>
@endpush
@push('js')
    <script>
    $(function(){
        $('.btn-trash').click(function(){
            id = $(this).attr('data-id');
            $('#input-id').val(id);
            $('#modalHapus').modal('show');
        });

        $('.btn-delete').click(function(){
            $('#form-delete').submit();
            // alert($('#input-id').val());
        });
    })
    </script>
@endpush

@push('css')
<style>
    #no{
        width: 5px;
    }
    #aksi{
        width: 50px;
    }
    th{
        
        font-size : 11pt ;
    }
    td{
        font-size: 10pt;
    }
</style>
@endpush