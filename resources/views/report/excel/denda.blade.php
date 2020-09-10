<table>
    <thead>
        <tr>
            <th>No</th>
            <th width="20px">Kode Denda</th>
            <th width="20px">Nama Peminjam</th>
            <th width="20px">Tanggal Didenda</th>
            <th width="20px">Keterlambatan</th>
            <th >Total Dendaan</th>
            <th >Bayar Dendaan</th>
            <th>Status</th>
            <th width ="20px">Petugas</th>
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