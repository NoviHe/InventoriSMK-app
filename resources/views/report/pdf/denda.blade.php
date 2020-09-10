
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
<h2>Data Denda</h2>
<hr><table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Denda</th>
            <th>Nama Peminjam</th>
            <th>Tanggal Didenda</th>
            <th>Keterlambatan</th>
            <th >Total Dendaan</th>
            <th >Bayar Dendaan</th>
            <th>Status</th>
            <th>Petugas</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $dt)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$dt->kode_denda}}</td>
            <td>{{$dt->get_user->name}}</td>
            <td>{{$dt->tanggal_denda}}</td>
            <td>{{$dt->terlambat}} Hari</td>
            <td>{{$dt->total_denda}}</td>
            <td>{{$dt->bayar_denda}}</td>
            <td>{{$dt->status}}</td>
            <td>{{$dt->get_admin->name}}</td>
        </tr>
        @endforeach
        @php
            // dd();
        @endphp
    </tbody>
</table>