{{-- @extends('adminlte::master') --}}
<li class="nav-header">MAIN NAVIGATION</li>
<li class="nav-item">
    <a href="{{route('home')}}" class="nav-link">
        <i class="nav-icon fa fa-tachometer-alt "></i>
        <span>Dashboard</span>
    </a>
</li>
<li class="nav-header">DATA MASTER</li>
<li class="nav-item">
    <a href="{{route('pegawai.daftar')}}" class="nav-link">
        <i class="nav-icon fa fa-eye"></i>
        <span>Detail Pegawai</span>
    </a>
</li>
<li class="nav-header">DATA INVENTARIS</li>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link nav-item">
        <i class="nav-icon fa fa-table"></i>
        <span>Inventaris</span>
        <span class="float-right-container">
            <i class="fas fa-angle-left float-right"></i>
        </span>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a class="nav-link" href="{{route('inventaris.daftar')}}">
                <i class="far fa-sm fa-circle nav-icon"></i>
                <span>Master Data</span>
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
            <a class="nav-link" href="{{route('pinjam.histori')}}">
                <i class="far fa-sm fa-circle nav-icon"></i>
                <span>History Data</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('pinjam.addUser')}}">
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
            <a class="nav-link" href="{{route('denda.histori')}}">
                <i class="far fa-sm fa-circle nav-icon"></i>
                <span>History Data</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('denda.cek')}}">
                <i class="far fa-sm fa-circle nav-icon"></i>
                <span>Cek Denda</span>
            </a>
        </li>
    </ul>
</li>