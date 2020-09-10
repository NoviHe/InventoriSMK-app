@extends('adminlte::page')
@section('title','Input Peminjaman')
@section('content_header')
    <h1>Peminjaman <small>Data Input</small></h1>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header with-border">
                    <h3 class="card-title">Peminjaman Data Input</h3>
                </div>
                <form action="{{route('peminjaman.keranjang')}}" autocomplete="off" method="POST" class="form-horizontal" id="quickForm">
                {{ csrf_field() }}
                <div class="card-body">
                        <div class="col-md-12">
                            <h3>Data Barang</h3>
                            <div class="form-group row">
                                <label for="id_kategori" class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2 @error('id_kategori') is-invalid @enderror" 
                                    autocomplete="off" name="id_kategori[]" id="id_kategori" multiple="multiple">
                                            
                                        @foreach ($inven as $in)
                                            <option value="{{$in->id_kategori}}">{{$in->nama_kategori}}</option>
                                        @endforeach
                                    </select>
                                    @error('id_kategori')
                                        <div class="text-danger invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kode_inventaris" class="col-sm-2 col-form-label">Kode Barang</label>
                                <div class="col-sm-10">
                                    <select name="kode_inventaris" class="form-control select2 @error('kode_inventaris') is-invalid @enderror" 
                                    autocomplete="off" id="kode_inventaris" style="width: 100%;">
                                    <option value="">Pilih Data</option>
                                    </select>
                                    @error('kode_inventaris')
                                        <div class="text-danger invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary float-right">Submit</button>
                </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Keranjang Barang Yang akan di pinjam</h3>
                </div>
                <div class="card-body">
                    @if (Session::has('cart'))
                    <ul class="list-group">
                        @foreach ($barang as $item)
                        <li class="list-group-item">
                            <div class="btn btn-group float-right">
                                @if ($item['qty'] <= 0)
                                <span class=" badge bg-danger"> - </span>     
                                {{Session::forget('cart')}}
                                @else
                                <a href="{{route('pinjam.minByOne',$item['items']['id_inventaris'])}}" 
                                class="badge bg-danger"> - </a> 
                                @endif
                                <span class=" badge bg-primary"> {{$item['qty']}}</span> 
                                <a href="{{route('pinjam.plusByOne',$item['items']['id_inventaris'])}}" class="badge bg-danger"> + </a>
                            </div>
                            <strong> {{$item['items']['nama']}}</strong>
                            <span class="badge badge-success">{{$item['kode']}}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer">
                    <strong>Total Barang : {{$totalQty}}</strong>
                    <a href="{{route('checkout')}}" type="button" class="btn btn-success float-right">Checkout</a>
                    @else 
                    <h3>Tidak ada barang</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header with-border">
                    <h3 class="card-title">Table Daftar Barang</h3>
                    <div class="card-tools pull-right">
                        <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse"
                                data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="myTable3" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th width="10px">No</th>
                                <th>Nama Barang</th>
                                <th width="80px">Kategori</th>
                                <th width="60px">Kode</th>
                                <th width="150px">Stock</th>
                                <th width="90px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inve as $in)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$in->nama}}</td>
                                    <td>{{$in->nama_kategori}}</td>
                                    <td>{{$in->kode_inventaris}}</td>
                                    @php
                                        if ($in->jumlah <= 0) {
                                            $s = 'danger';
                                            $k = 'Kosong';
                                        } else {
                                            $s = 'success';
                                            $k = 'Tersedia';
                                        }
                                    @endphp
                                    <td>{{$in->jumlah}} <span class="badge float-right bg-{{$s}}">{{$k}}</span></td>
                                    <td>
                                        @if ($in->jumlah <= 0)
                                        <button class="btn btn-sm btn-default" type="button" onClick="Swal.fire('Stock Kosong')">
                                            <i class="fa fa-sm fa-upload"></i> Pinjam
                                        </button>
                                        @else    
                                        <a class="btn btn-sm btn-warning" href="{{route('inventaris.addToCart',$in->id_inventaris)}}">
                                            <i class="fa fa-sm fa-upload"></i> Pinjam
                                        </a>
                                        @endif
                                    </td>
                                </tr>    
                            @endforeach
                        </tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
$(function () {
    
    // $('#myTable2').DataTable();
    $('#myTable2').DataTable({
        'searching'   : false
    });
    // $('#myTable3').DataTable({
    //     'searching'   : false,
        
    // });
    $('#myTable3').DataTable({
                "scrollY":"280px",
                "scrollCollapse": true
                
            })
    $("#nama_pegawai").select2({
        placeholder: "Pilih Nama Pegawai",
        allowClear: true,
        tags : true
    });
})
</script>
<script>
$(document).ready(function(){
    $("#id_kategori").multiselect({
        nonSelectedText: "Pilih Data",
        // placeholder: "Pilih",
        buttonWidth: '100%',
        // allowClear: true,
        // tags : true,
        onChange: function(option,selected){
            var id_kategori = this.$select.val();
            var token = $("input[name= '_token'").val();
            if (id_kategori.length > 0 ) {
                $.ajax({
                    url : "{{route('jabar')}}" ,
                    method : 'POST',
                    data : {id_kategori:id_kategori, _token:token},
                    success: function(data){
                        $('#kode_inventaris').html(data);
                        $('#kode_inventaris').select2('rebuild');
                    }
                })
            }
        }
    });

    $("#kode_inventaris").select2({
        placeholder: "Pilih Kode / Nama Barang",
        allowClear: true,
        // buttonWidth: '100%',
        // nonSelectedText: "Pilih Data",
    });
        $.fn.select2.defaults.set('amdBase', 'select2/');
        $.fn.select2.defaults.set('amdLanguageBase', 'select2/i18n/');
    
    $('#nama_pegawai').change(function(){
        var kode = $('#nama_pegawai').val();
        var token = $("input[name='_token']").val();
        $.ajax({
            url : "{{route('cariPegawai')}}",
            method: 'POST',
            data: {id: kode, _token:token},
            success: function(res){
                console.log(res.data);
                $('#nip').val(res.data.nip)
                $('#id_pegawai').val(res.data.id_pegawai)
            }
        })
    })
})

</script>
@endpush
