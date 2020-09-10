<style>
    table,th,td{
        border:1px solid black;
        text-align: center;
        margin: 5px auto;
    }
    h2{
        text-align: center;
    }
    th{
        background-color: cyan;
    }
</style>
<h2>Data Inventaris</h2>
<hr>
<table> 
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Kondisi</th>
            <th>Stok</th>
            <th>Tanggal Masuk</th>
            <th>Jenis</th>
            <th>Kategori</th>
            <th>PengInput</th>
            <th>Keterangan</th>
        </th>
    </thead>
    <tbody>
        @foreach ($data as $dt)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$dt->kode_inventaris}}</td>
            <td>{{$dt->nama}}</td>
            <td>{{$dt->kondisi}}</td>
            <td>{{$dt->jumlah}}</td>
            <td>{{$dt->tanggal_registrasi}}</td>
            <td>{{$dt->get_jenis->nama_jenis}}</td>
            <td>{{$dt->get_kategori->nama_kategori}}</td>
            <td>{{$dt->get_petugas->name}}</td>
            <td>{{$dt->keterangan}}</td>
        </tr>
        @endforeach
        @php
            // dd();
        @endphp
    </tbody>
</table>    



