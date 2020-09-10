@extends('layouts.page')
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
                    <h3 class="card-title">Inventaris</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="myTableInven" class="table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Kode</th>
                            <th>Kondisi</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Detail</th>
                            <th width="80">Aksi</th>
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
                            <th>Kode</th>
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

