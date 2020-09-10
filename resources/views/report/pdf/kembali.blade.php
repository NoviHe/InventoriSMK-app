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
<h2>Data Pengembalian</h2>
<hr><table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Pengembalian</th>
            <th>Nama Peminjam</th>
            <th>Status</th>
            <th>Tanggal Pengembalian</th>
            <th>Keterlambatan</th>
            <th>Barang Di Kembalikan</th>
            <th>Petugas</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $dt)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$dt->kode_kembali}}</td>
            <td>{{$dt->get_user->name}}</td>
            <td>{{$dt->status}}</td>
            <td>{{$dt->tanggal_masuk}}</td>
            @php
                if (!empty($dt->terlambat)) {
                    $hasil = $dt->terlambat;
                } else {
                    $hasil = 0;
                }
            @endphp
            <td>{{$hasil}} Hari</td>
            @php
                $cart_full = $dt->cart;
                $item_full = json_decode($cart_full, true);
                foreach ((array)$item_full as $keys) {
                    $cuys[] = $keys['items']['nama'];
                    $cuys[] .= $keys['kode'];
                    $cuys[] .= $keys['qty'];
                }
                $carts_full = implode(", ",$cuys);
                if ($dt->cart_full == "[]") {
                    $res = " ";
                } else {
                    $res = $carts_full;
                }
            @endphp
            <td>{{$res}}</td>
            <td>{{$dt->get_admin->name}}</td>
        </tr>
        @endforeach
        @php
            // dd();
        @endphp
    </tbody>
</table>