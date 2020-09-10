
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
<h2>Data Peminjaman</h2>
<hr><table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Peminjaman</th>
            <th>Nama Peminjam</th>
            <th>Status</th>
            <th>Lama Pinjam</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Barang Di Pinjam</th>
            <th>Barang Di Kembalikan</th>
            <th>Petugas</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $dt)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$dt->kode_pinjam}}</td>
            <td>{{$dt->get_user->name}}</td>
            <td>{{$dt->status}}</td>
            <td>{{$dt->lama_pinjam}}</td>
            <td>{{$dt->tanggal_pinjam}}</td>
            <td>{{$dt->tanggal_kembali}}</td>
            @php
                $cart = $dt->cart;
                $item = json_decode($cart, true);
                foreach ($item as $key) {
                    $cuy[] = $key['items']['nama'];
                    $cuy[] .= $key['kode'];
                    $cuy[] .= $key['qty'];
                }
                $carts = implode(", ",$cuy);
                if ($dt->cart == "[]") {
                    $hasil = " ";
                } else {
                    $hasil = $carts;
                }
            @endphp
            <td>{{$hasil}}</td>
            @php
                $cart_full = $dt->cart_full;
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
                // dd($res);
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