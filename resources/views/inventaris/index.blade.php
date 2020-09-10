@extends('adminlte::page')
@section('title','Data Inventaris')
@section('content_header')
    <h1>Inventaris <small>Data</small></h1>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            {{-- Ruang --}}
            <div class="card card-danger">
                <div class="card-header with-border">
                    @if (Session::get('admin'))
                    <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#modal-report">
                        <i class="fa fa-print"></i> REPORT
                    </button>
                    @else
                    <h3 class="card-title">Inventaris</h3>
                    @endif
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="myTableInven" class="table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Kode Inventaris</th>
                            <th>Kondisi</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Detail</th>
                            <th width="130px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $dt)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$dt->nama}}</td>
                            <td>{{$dt->kode_inventaris}}</td>
                            <td>{{$dt->kondisi}}</td>
                            <td>{{$dt->get_kategori->nama_kategori}}</td>
                            @php
                                if ($dt->jumlah <= 0) {
                                    $s = 'danger';
                                    $k = 'Kosong';
                                } else {
                                    $s = 'success';
                                    $k = 'Tersedia';
                                }
                            @endphp
                            <td>{{$dt->jumlah}} <span class="badge float-right bg-{{$s}}">{{$k}}</span></td>
                            <td>
                                <a class="btn btn-sm btn-info" href="{{route('inventaris.show',$dt->id_inventaris)}}">
                                    <i class="fa fa-sm fa-eye"></i> Detail</a>
                            </td>
                            <td>
                                <div>
                                <a class="btn btn-sm btn-warning" href="{{route('inventaris.edit',$dt->id_inventaris)}}">
                                    <i class="fa fa-sm fa-edit"></i>
                                </a>
                                <button class="btn btn-sm btn-danger btn-trash" type="submit" data-id="{{$dt->id_inventaris}}">
                                    <i class="fa fa-sm fa-trash"></i>
                                </button>
                                @if ($dt->jumlah <= 0)
                                    <button class="btn btn-sm btn-default" type="button" onClick="Swal.fire('Stock Kosong')">
                                        <i class="fa fa-sm fa-upload"></i> Pinjam
                                    </button>
                                @else    
                                    <a class="btn btn-sm btn-warning" href="{{route('inventaris.addToCart',$dt->id_inventaris)}}">
                                        <i class="fa fa-sm fa-upload"></i> Pinjam
                                    </a>
                                @endif
                            </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Kode Inventaris</th>
                            <th>Kondisi</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Detail</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                </div>
              </div>
              <!-- /.card -->
            </div>
        </div>
    </div>
</div>

@endsection
@push('modal')
<div class="modal fade" id="modalHapus">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <form method="POST" id="form-delete" action="{{route('inventaris.delete')}}">
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
                <input type="hidden" name="id_inventaris" id="input-id">
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
                <h5>Report semua</h5>
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{route('inventaris.excel')}}" target="_blank" class="col-12 btn btn-success float-sm-left">
                            <i class="fa fa-print"></i>
                            REPORT Excel
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{route('inventaris.pdf')}}" target="_blank" class="col-12 btn btn-danger float-sm-left">
                            <i class="fa fa-print"></i>
                            REPORT Pdf
                        </a>
                    </div>
                </div>
                <br>
            </div>
            <div class="modal-footer">
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

@push('js')
    <script>
        $(document).ready(function(){
            $('#myTableInven').DataTable({
                "scrollY":"250px",
                "scrollCollapse": true
                
            })
        })
    </script>
@endpush

@push('css')
<style>
    th{
        font-size : 13pt ;
    }
    td{
        font-size: 12pt;
    }
</style>
@endpush

