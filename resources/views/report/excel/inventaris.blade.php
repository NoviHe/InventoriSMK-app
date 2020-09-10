<table>
    <thead>
        <tr>
            <th>No</th>
            <th width="20px">Kode Barang</th>
            <th width="20px">Nama Barang</th>
            <th>Kondisi</th>
            <th>Stok</th>
            <th width="20px">tanggal Masuk</th>
            <th width="20px">Jenis</th>
            <th width="20px">Kategori</th>
            <th  width="20px">Peng Input</th>
            <th width="20px">Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inven as $dt)
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