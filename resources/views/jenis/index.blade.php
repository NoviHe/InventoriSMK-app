@extends('adminlte::page')
@section('title','Data Ruang')
@section('content_header')
    <h1>Jenis <small>Data</small></h1>
@endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header with-border">
                <h3 class="card-title">Input Data Jenis</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" autocomplete="off" action="{{route('jenis.store')}}">
                    {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_jenis">Nama Jenis</label>
                        <input type="text" name="nama_jenis" id="nama_jenis"  placeholder="Nama Jenis"
                        class="form-control @error('nama_jenis') is-invalid @enderror">
                        @error('nama_jenis')
                            <div class="text-danger invalid-feedback"><small>{{$message}}</small></div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kode_jenis" >Kode Jenis</label>
                            <input type="text" class="form-control @error('nama_jenis') is-invalid @enderror" 
                            name="kode_jenis" id="kode_jenis" value="{{$kode}}" readonly>
                            @error('kode_jenis')
                            <div class="text-danger invalid-feedback"><small>{{$message}}</small></div>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan" placeholder="Keterangan"
                        class="form-control @error('keterangan') is-invalid @enderror">
                        @error('keterangan')
                            <div class="text-danger invalid-feedback"><small>{{$message}}</small></div>
                        @enderror
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header with-border">
                <h3 class="card-title">Table Jenis</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table class="table table-bordered" id="myTablejn">
                    <thead>
                        <tr>
                            <th id="no">No.</th>
                            <th>Jenis</th>
                            <th>Kode Jenis</th>
                            <th>Keterangan</th>
                            <th id="aksi">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $dt)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$dt->nama_jenis}}</td>
                        <td>{{$dt->kode_jenis}}</td>
                        <td>{{$dt->keterangan}}</td>
                        <td>
                            <a class="btn btn-sm btn-warning" 
                            href="{{route('jenis.edit',$dt->id_jenis)}}"><i class="fa fa-edit"></i></a>
                            <button class="btn btn-sm btn-danger btn-trash" type="button" data-id="{{$dt->id_jenis}}">
                                <i class="fa fa-trash"></i>
                            </button>
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
            <form method="POST" id="form-delete" action="{{route('jenis.delete')}}">
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
                <input type="hidden" name="id_jenis" id="input-id">
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

<script>
    $(document).ready( function () {
        $('#myTablejn').DataTable({
            "scrollCollapse": true
        });
    } );

    
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
        
        font-size : 12pt ;
    }
    td{
        font-size: 11pt;
    }
</style>
@endpush