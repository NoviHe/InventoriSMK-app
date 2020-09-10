@extends('adminlte::page')
@section('title','Data Petugas')
@section('content_header')
    <h1>Petugas <small>Data</small></h1>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header with-border">
                    {{-- <h3 class="card-title">Data Petugas</h3> --}}
                    <button type="button" class="btn btn-default float-sm-left" data-toggle="modal" data-target="#modal-report">
                        <i class="fa fa-print"></i> REPORT
                    </button>
                    <a href="{{route('petugas.create')}}" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Tambah Data</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th>Nama Petugas</th>
                                <th>Email Petugas</th>
                                <th>Akses</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $dt)
                            <tr>
                                <td>{{$dt->name}}</td>
                                <td>{{$dt->email}}</td>
                                <td>{{$dt->level}}</td>
                                <td>
                                    <a class="btn btn-sm btn-warning" 
                                    href="{{route('petugas.edit', $dt->id)}}">Edit</a>
                                    @if ($dt->id != Auth::id())
                                    <button class="btn btn-sm btn-danger btn-trash" type="submit" 
                                    data-id="{{$dt->id}}">Delete</button>
                                    @endif
                                    {{-- data-toggle="modal"  
                                    data-target="#modalHapus" --}}
                                </td>
                            </tr>  
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{-- <a href="{{route('admin.excel')}}" target="_blank" class="btn btn-default float-sm-left">
                        <i class="fa fa-print"></i>
                        REPORT
                    </a> --}}
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
            <form method="POST" id="form-delete" action="{{route('petugas.delete')}}">
            <div class="modal-header">
                <h4 class="modal-title">Delete Data Petugas!!</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus Data&hellip;</p>
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="id" id="input-id">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-light btn-delete">Delete!!</button>
            </div>
        </div>
    </div>
</div>

{{-- //modal Report --}}
<div class="modal fade" id="modal-report">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Report Menu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{route('admin.excel')}}" target="_blank" class="col-12 btn btn-success float-sm-left">
                            <i class="fa fa-print"></i>
                            REPORT Excel
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{route('admin.pdf')}}" target="_blank" class="col-12 btn btn-danger float-sm-left">
                            <i class="fa fa-print"></i>
                            REPORT Pdf
                        </a>
                    </div>
                </div>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-primary float-right" data-dismiss="modal">Done</button>
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