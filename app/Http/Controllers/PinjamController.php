<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Cart;
use App\Inventaris;
use App\Kembali;
use App\Peminjaman;
use App\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class PinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Peminjaman::join()
            ->get();

        return view('peminjaman.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $inven = Inventaris::join()
            ->groupBy('id_kategori')
            ->get();
        $inve = DB::table('inventaris')
            ->join('kategoris', 'inventaris.id_kategori', '=', 'kategoris.id_kategori')
            ->orderBy('id_jenis')
            ->get();

        if (!Session::has('cart')) {
            return view('peminjaman.add', ['inven' => $inven, 'inve' => $inve]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        $barang = $cart->items;
        $totalQty = $cart->totalQty;
        $code = $cart->kode;

        // dd(Session::get('cart'));
        return view('peminjaman.add', compact('inve', 'inven'), ['barang' => $cart->items, 'totalQty' => $cart->totalQty, 'code' => $cart->kode]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // var_dump($_POST);
        $inven = Inventaris::join()
            ->groupBy('id_kategori')
            ->get();
        $inve = DB::table('inventaris')
            ->orderBy('id_jenis')
            ->get();

        if (!Session::has('cart')) {
            return view('peminjaman.add', ['inven' => $inven, 'inve' => $inve]);
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        $json = json_encode($cart);
        $decode = json_decode($json, true);
        // $count = count($decode['items']);
        $idinv = $decode['items'];
        $arr = json_encode($idinv);

        foreach ($idinv as $id) {
            $idnya = $id['items']['id_inventaris'];
            $value = Inventaris::findOrFail($idnya)->jumlah;
            // $value = $id['items']['jumlah'];
            $qty = $id['qty'];
            // var_dump($id);
            $newQty = (int) $value - $qty;
            Inventaris::where('id_inventaris', $idnya)->update(['jumlah' => $newQty]);
            // dd($qty);
        }

        $status = 'Dipinjam';
        $a = new DateTime($request->tanggal_kembali);
        $b = new DateTime($request->tanggal_pinjam);
        $lama = $a->diff($b)->format("%a");

        $data = new Peminjaman();
        $data->kode_pinjam = $request->kode_pinjam;
        $data->tanggal_pinjam = $request->tanggal_pinjam;
        $data->lama_pinjam = $lama;
        $data->tanggal_kembali = $request->tanggal_kembali;
        $data->cart = $arr;
        $data->cart_full = '[]';
        $data->status = $status;
        $data->user_id = $request->id;
        $data->admin_id = Session::get('id');

        $save = $data->save();

        if ($save) {
            Session::forget('cart');
            alert()->success('Saved', 'Data Berhasil Di tambah.');
            return redirect()->route('peminjaman.index');
        } else {
            alert()->error('Failed', 'Data Gagal Di tambah.');
            return back();
        }
    }

    public function storeUser(Request $request)
    {
        // var_dump($_POST);
        $inven = Inventaris::join()
            ->groupBy('id_kategori')
            ->get();
        $inve = DB::table('inventaris')
            ->join('kategoris', 'inventaris.id_kategori', '=', 'kategoris.id_kategori')
            ->orderBy('id_jenis')
            ->get();

        if (!Session::has('cart')) {
            return view('peminjaman.add', ['inven' => $inven, 'inve' => $inve]);
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        $json = json_encode($cart);
        $decode = json_decode($json, true);
        // $count = count($decode['items']);
        $idinv = $decode['items'];
        $arr = json_encode($idinv);

        foreach ($idinv as $id) {
            $idnya = $id['items']['id_inventaris'];
            $value = Inventaris::findOrFail($idnya)->jumlah;
            // $value = $id['items']['jumlah'];
            $qty = $id['qty'];
            // var_dump($id);
            $newQty = (int) $value - $qty;
            Inventaris::where('id_inventaris', $idnya)->update(['jumlah' => $newQty]);
            // dd($qty);
        }

        $status = 'Dipinjam';
        $a = new DateTime($request->tanggal_kembali);
        $b = new DateTime($request->tanggal_pinjam);
        $lama = $a->diff($b)->format("%a");

        $data = new Peminjaman();
        $data->kode_pinjam = $request->kode_pinjam;
        $data->tanggal_pinjam = $request->tanggal_pinjam;
        $data->lama_pinjam = $lama;
        $data->tanggal_kembali = $request->tanggal_kembali;
        $data->cart = $arr;
        $data->cart_full = '[]';
        $data->status = $status;
        $data->user_id = $request->id;
        $data->admin_id = $request->id_admin;

        $save = $data->save();

        if ($save) {
            Session::forget('cart');
            alert()->success('Saved', 'Data Berhasil Di tambah.');
            return redirect()->route('pinjam.histori');
        } else {
            alert()->error('Failed', 'Data Gagal Di tambah.');
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
        $data = Peminjaman::findOrFail($id);
        $datas = Peminjaman::with('get_user')->get();
        $qr = $data->kode_pinjam;
        $qrcode = QrCode::size(150)->generate($qr);

        $cart = $data->cart;
        $cart_back = $data->cart_full;

        $items = json_decode($cart, true);
        $result = json_decode($cart_back, true);
        foreach ($items as $key) {
            $qty[] = $key['qty'];
        }
        if ($data->cart == '[]') {
            $totalQty = 0;
        } else {
            $totalQty = array_sum($qty); // cari totalQty
        }
        // dd($items);
        return view('peminjaman.show', compact('data', 'datas', 'qrcode'), ['items' => $items, 'result' => $result, 'totalQty' => $totalQty]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data = Peminjaman::findOrFail($id);
        $cart = $data->cart;
        $items = json_decode($cart, true);
        // dd($items);
        foreach ($items as $key) {
            $qty[] = $key['qty'];
        }
        $totalQty = array_sum($qty);

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

        return view('pengembalian.add', compact('data', 'items', 'totalQty', 'kode'));
    }

    public function kembali($id)
    {
        $data = Peminjaman::findOrFail($id);
        return view('peminjaman.kembali', compact('data'));
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
            'cart' => 'required',
            'keterlambatan' => 'required'
        ]);
        $arr = $request->cart; // data pinjam ber. id
        $count = count($request->cart);
        $data = Peminjaman::findOrFail($id);
        $cart = $data->cart;
        $json = json_decode($cart, true);  //data array
        $countIf = count($json);
        // $jsons = $json['items']; 
        for ($i = 0; $i < $count; $i++) {
            $dt[] = $json[$arr[$i]];  //untuk mengambil data pinjam
        }
        // dd($dt);
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

        // dd($status);

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function jabar(Request $request)
    {
        if (isset($_POST['id_kategori'])) {
            $idKategori = join("','", $request->get('id_kategori'));
            $data = DB::select("SELECT * FROM inventaris WHERE id_kategori IN ('" . $idKategori . "') AND jumlah > 0");
        }

        $hasil = '';
        foreach ($data as $dt) {
            $hasil .= '<option value="'  . $dt->id_inventaris . '">' . $dt->kode_inventaris . ' / ' . $dt->nama . '</option>';
        }
        echo $hasil;
    }
    public function jateng(Request $request)
    {
        if (isset($_POST['id_kategori'])) {
            $idKategori = join("','", $request->get('id_kategori'));
            $data = DB::select("SELECT * FROM inventaris WHERE id_kategori IN ('" . $idKategori . "')");
        }

        $hasil = '';
        foreach ($data as $dt) {
            $hasil .= '<option value="'  . $dt->kode_inventaris . '">' . $dt->kode_inventaris . ' / ' . $dt->nama . '</option>';
        }
        echo $hasil;
    }

    public function cariPegawai(Request $request)
    {
        $id = $request->get('id');
        $data = User::cariPeg($id)->first();

        return response()->json(['data' => $data]);
    }

    public function getCart(Request $request, $id)
    {
        $product = Inventaris::findOrFail($id);
    }

    public function keranjang(Request $request)
    {
        $request->validate([
            'kode_inventaris' => 'required',
        ]);
        $id = $request->kode_inventaris;
        return redirect()->route('inventaris.addToCart', $id);
        // var_dump($id);
    }
    public function cartUser(Request $request)
    {
        $request->validate([
            'kode_inventaris' => 'required',
        ]);
        $id = $request->kode_inventaris;
        return redirect()->route('inventaris.addToCart', $id);
        // var_dump($id);
    }
    public function getCheckout()
    {
        // mengambil ID terakhir
        $id = Peminjaman::getID();
        foreach ($id as $val);
        if (!empty($val->id_peminjaman)) {
            $idLm = $val->id_peminjaman;
        } else {
            $idLm = 0;
        }
        // $idLm = $val->id_peminjaman;
        $idBaru = $idLm + 1;
        $blt = date('m/Y');

        $kode = 'PJM-' . $blt . '-' . $idBaru;

        $petugas = Admin::all();
        $pegawai = User::all();

        $inven = Inventaris::join()
            ->groupBy('id_kategori')
            ->get();
        $inve = DB::table('inventaris')
            ->orderBy('id_jenis')
            ->get();

        if (!Session::has('cart')) {
            return view('peminjaman.add', ['inven' => $inven, 'inve' => $inve]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $totalQty = $cart->totalQty;
        return view('peminjaman.pinjam', compact('totalQty', 'kode', 'petugas', 'pegawai'));
    }

    public function getCheckoutUser()
    {
        // mengambil ID terakhir
        $id = Peminjaman::getID();
        foreach ($id as $val);
        if (!empty($val->id_peminjaman)) {
            $idLm = $val->id_peminjaman;
        } else {
            $idLm = 0;
        }
        // $idLm = $val->id_peminjaman;
        $idBaru = $idLm + 1;
        $blt = date('m/Y');

        $kode = 'PJM-' . $blt . '-' . $idBaru;

        $petugas = Admin::all();
        $pegawai = User::findOrFail(Auth::user()->id);


        $inven = Inventaris::join()
            ->groupBy('id_kategori')
            ->get();
        $inve = DB::table('inventaris')
            ->orderBy('id_jenis')
            ->get();

        if (!Session::has('cart')) {
            return view('peminjaman.addUser', ['inven' => $inven, 'inve' => $inve]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $totalQty = $cart->totalQty;
        return view('peminjaman.pinjamUser', compact('totalQty', 'kode', 'petugas', 'pegawai'));
    }

    public function minByOne($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->minOne($id);

        Session::put('cart', $cart);
        return redirect()->back();
    }

    public function plusByOne($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->plusOne($id);

        Session::put('cart', $cart);
        return redirect()->back();
    }

    public function createUser()
    {
        $inven = Inventaris::join()
            ->groupBy('id_kategori')
            ->get();
        $inve = DB::table('inventaris')
            ->join('kategoris', 'inventaris.id_kategori', '=', 'kategoris.id_kategori')
            ->orderBy('id_jenis')
            ->get();

        if (!Session::has('cart')) {
            return view('peminjaman.addUser', ['inven' => $inven, 'inve' => $inve]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        $barang = $cart->items;
        $totalQty = $cart->totalQty;
        $code = $cart->kode;

        // dd(Session::get('cart'));

        return view('peminjaman.addUser', compact('inve', 'inven'), ['barang' => $cart->items, 'totalQty' => $cart->totalQty, 'code' => $cart->kode]);
    }

    public function histori()
    {
        $data = Peminjaman::join()
            ->where('user_id', Auth::user()->id)
            ->get();
        return view('peminjaman.histori', compact('data'));
    }
}
