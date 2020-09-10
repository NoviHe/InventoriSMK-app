<?php

namespace App\Http\Controllers;

use App\Inventaris;
use App\Kembali;
use App\Peminjaman;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class KembaliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kembali::orderBy('id_kembali', 'DESC')->get();
        return view('pengembalian.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Peminjaman::join()
            ->where('status', 'Dipinjam')
            ->get();

        // mengambil ID terakhir
        $id = Kembali::getID();
        foreach ($id as $val);
        if (!empty($val->id_kembali)) {
            $idLm = $val->id_kembali;
        } else {
            $idLm = 0;
        }
        // $idLm = $val->id_peminjaman;
        $idBaru = $idLm + 1;
        $blt = date('m/Y');

        $kode = 'KMB-' . $blt . '-' . $idBaru;

        return view('pengembalian.tambah', compact('data', 'kode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'pinjam_id' => 'required',
            'cart' => 'required',
            'keterlambatan' => 'required'
        ]);
        // dd($_POST);
        $arr = $request->cart;
        $count = count($request->cart);
        $id = $request->pinjam_id;
        $data = Peminjaman::findOrFail($id);
        $cart = $data->cart;
        $json = json_decode($cart, true);
        $countIf = count($json);

        for ($i = 0; $i < $count; $i++) {
            $dt[] = $json[$arr[$i]];  //untuk mengambil data pinjam
        }
        for ($a = 0; $a < $count; $a++) {
            unset($json[$arr[$a]]);  //mengurangi data cart
        }
        $carts = json_encode($dt);
        $nA = count($json);
        $nB = count($dt);
        $nC = $request->terlambat;
        if ($nB == $countIf && $nC == 0) {
            $status = 'Clear';
            $stat = 'Dikembalikan';
        } elseif ($nB < $countIf && $nC == 0) {
            $status = 'Kurang';
            $stat = 'Kurang';
        } elseif ($nB < $countIf && $nC > 0) {
            $status = 'Terlambat & Kurang';
            $stat = 'Kurang';
        } elseif ($nC > 0) {
            $status = 'Terlambat';
            $stat = 'Dikembalikan';
        }

        $back = new Kembali();
        $back->user_id = $request->user_id;
        $back->admin_id = $request->admin_id;
        $back->pinjam_id = $id;
        $back->kode_kembali = $request->kode_kembali;
        $back->tanggal_masuk = $request->tanggal_pengembalian;
        $back->terlambat = $request->terlambat;
        $back->cart = $carts;
        $back->status = $status;
        $save = $back->save();
        if ($save) {
            Peminjaman::where('id_peminjaman', $id)->Update(['status' => $stat, 'cart' => $json, 'cart_full' => $carts]);
            foreach ($dt as $data) {
                $idnya = $data['items']['id_inventaris'];
                // $value = $data['items']['jumlah'];
                $value = Inventaris::findOrFail($idnya)->jumlah;
                $qty = $data['qty'];
                $newQty = (int) $value + $qty;
                Inventaris::where('id_inventaris', $idnya)->update(['jumlah' => $newQty]);
            }
            alert()->success('Saved!', 'Data Berhasil Di Tambah.');
            return redirect()->route('pengembalian.index');
        } else {
            alert()->error('Error Save', 'Data Gagal Di Tambah.');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Kembali::findOrFail($id);
        $qr = $data->kode_kembali;
        $qrcode = QrCode::size(150)->generate($qr);
        $datas = Peminjaman::findOrFail($data->pinjam_id);
        $cart_sisa = json_decode($datas->cart, true);
        $cart = json_decode($data->cart, true);
        // dd($cart);
        foreach ($cart as $key) {
            $qty[] = $key['qty'];
        }
        $totalQty = array_sum($qty);

        return view('pengembalian.show', compact('data', 'qrcode', 'cart', 'cart_sisa', 'totalQty'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $getData = Peminjaman::findOrFail($id);
        $getID = $getData->id_peminjaman;
        $data = Kembali::where('pinjam_id', $getID)->first();
        $getCart = $data->cart;
        $getCarts = $getData->cart;
        $cart = json_decode($getCart, true);
        $carts = json_decode($getCarts, true);
        foreach ($cart as $key) {
            $qty[] = $key['qty'];
        }
        foreach ($carts as $key) {
            $qtys[] = $key['qty'];
        }
        $totalQty = array_sum($qty);
        $totalQtys = array_sum($qtys);
        // dd($totalQty);
        return view('pengembalian.edit', compact('data', 'cart', 'carts', 'totalQty', 'totalQtys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'cart' => 'required'
        ]);
        $getCart = $request->cart;
        $totalQtyA = count($getCart);
        $getPinjamID = $request->pinjam_id;
        $getBefore = Peminjaman::findOrFail($getPinjamID);
        $getCartData = $getBefore->cart;
        $jsonCartData = json_decode($getCartData, true);
        $totalQtyB = count($jsonCartData);

        if ($totalQtyA == $totalQtyB) {
            $result = 'Clear';
            $res = 'Dikembalikan';
        } elseif ($totalQtyA < $totalQtyB) {
            $result = 'Kurang';
            $res = 'Kurang';
        }
        $oldCart = $request->cartOld;
        $back = Kembali::findOrFail($request->id_kembali);
        $arr = json_decode($back->cart, true); //array old
        for ($i = 0; $i < $totalQtyA; $i++) {
            $arr2[] = $jsonCartData[$getCart[$i]];
        }

        for ($i = 0; $i < count($arr2); $i++) {
            $p = $arr2[$i];
            array_push($arr, $p);
        }

        for ($i = 0; $i < count($getCart); $i++) {
            unset($jsonCartData[$getCart[$i]]);
        }

        // dd($result, $arr, $jsonCartData);

        $fieldA = [
            'cart' => json_encode($arr),
            'status' => $result
        ];
        $fieldB = [
            'cart' => json_encode($jsonCartData),
            'cart_full' => json_encode($arr),
            'status' => $res
        ];

        $edit = Kembali::findOrFail($request->id_kembali);
        $update = $edit->update($fieldA);
        if ($update) {
            Peminjaman::where('id_peminjaman', $getPinjamID)->update($fieldB);
            foreach ($arr2 as $data) {
                $idnya = $data['items']['id_inventaris'];
                // $value = $data['items']['jumlah'];
                $value = Inventaris::findOrFail($idnya)->jumlah;
                $qty = $data['qty'];
                $newQty = (int) $value + $qty;
                Inventaris::where('id_inventaris', $idnya)->update(['jumlah' => $newQty]);
            }
            alert()->success('Updated!', 'Data Berhasil Di Ubah.');
            return redirect()->route('pengembalian.index');
        } else {
            alert()->error('Error Update', 'Data Gagal Di Ubah.');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cari(Request $request)
    {
        $id = $request->get('id');
        $data = Peminjaman::cari($id)->first();

        return response()->json(['data' => $data]);
    }
}
