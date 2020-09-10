<table>
    <thead>
        <tr>
            <th>No</th>
            <th width="20px">Kode Peminjaman</th>
            <th width="20px">Nama Peminjam</th>
            <th>Status</th>
            <th>Lama Pinjam</th>
            <th width="20px">Tanggal Pinjam</th>
            <th width="20px">Tanggal Kembali</th>
            <th width="20px">Barang Di Pinjam</th>
            <th width="20px">Barang Di Kembalikan</th>
            <th width ="20px">Petugas</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($Pinjam as $dt)
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