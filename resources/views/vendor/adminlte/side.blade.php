{{-- @extends('adminlte::master') --}}
<li class="nav-header">MAIN NAVIGATION</li>
<li class="nav-item">
    <a href="{{route('dashboard')}}" class="nav-link">
        <i class="nav-icon fa fa-tachometer-alt "></i>
        <span>Dashboard</span>
    </a>
</li>
<li class="nav-header">DATA MASTER</li>
@if (Session::get('admin'))
<li class="nav-item">
    <a href="{{route('petugas.index')}}" class="nav-link">
        <i class="nav-icon fa fa-user "></i>
        <span>Petugas</span>
    </a>
</li>
@endif
<li class="nav-item">
    <a href="{{route('pegawai.index')}}" class="nav-link">
        <i class="nav-icon fa fa-users"></i>
        <span>Pegawai</span>
    </a>
</li>
<li class="nav-header">DATA ENTRI</li>
<li class="nav-item has-treeview">
    <a class="nav-link nav-item" href="#">
        <i class="nav-icon fa fa-database "></i>
        <p>Data Data
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a class="nav-link" href="{{route('ruang.index')}}">
                <i class="far fa-sm fa-circle nav-icon"></i>
                <span>Ruang</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('jenis.index')}}">
                <i class="far fa-sm fa-circle nav-icon"></i>
                <span>Jenis</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('kategori.index')}}">
                <i class="far fa-sm fa-circle nav-icon"></i>
                <span>Kategori</span>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link nav-item">
        <i class="nav-icon fa fa-table"></i>
        <p>Inventaris
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a class="nav-link" href="{{route('inventaris.index')}}">
                <i class="far fa-sm fa-circle nav-icon"></i>
                <span>Master Data</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('inventaris.create')}}">
                <i class="far fa-sm fa-circle nav-icon"></i>
                <span>Input Data</span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-upload"></i>
        <p>Peminjaman
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">{{Session::has('cart') ? Session::get('cart')->totalQty : ''}}</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a class="nav-link" href="{{route('peminjaman.index')}}">
                <i class="far fa-sm fa-circle nav-icon"></i>
                <span>Master Data</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('peminjaman.create')}}">
                <i class="far fa-sm fa-circle nav-icon"></i>
                <span>Input Data</span>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-download"></i>
        <p>Pengembalian
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a class="nav-link" href="{{route('pengembalian.index')}}">
                <i class="far fa-sm fa-circle nav-icon"></i>
                <span>Master Data</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('pengembalian.create')}}">
                <i class="far fa-sm fa-circle nav-icon"></i>
                <span>Input Data</span>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-coins"></i>
        <p>Denda
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a class="nav-link" href="{{route('denda.index')}}">
                <i class="far fa-sm fa-circle nav-icon"></i>
                <span>Master Data</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('denda.create')}}">
                <i class="far fa-sm fa-circle nav-icon"></i>
                <span>Input Data</span>
            </a>
        </li>
    </ul>
</li>
<li class="nav-header">LOG OUT</li>
<li class="nav-item">
    <a class="nav-link" href="#"
        {{-- onclick="event.preventDefault(); document.getElementById('logout-form').submit();" --}}
        data-toggle="modal" data-target="#modal-logout"
    >
        <i class="fa fa-fw fa-power-off"></i> {{ __('adminlte::adminlte.log_out') }}
    </a>
</li>
{{-- <li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-users"></i>
        <span>Report</span>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a class="nav-link" href="{{route('report.excel')}}">
                <i class="far fa-sm fa-circle nav-icon"></i>
                <span>Report Data Excel</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('report.pdf')}}">
                <i class="far fa-sm fa-circle nav-icon"></i>
                <span>Report Data Pdf</span>
            </a>
        </li>
    </ul>
</li> --}}

@push('modal')
<div class="modal fade" id="modal-logout">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Logout {{Session::get('level')}} !!</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <p>Logout {{Session::get('level')}}&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                >Logout</button>
            </div>
        </div>
    </div>
</div>
@endpush