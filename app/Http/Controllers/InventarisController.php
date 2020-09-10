<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Exports\InventarisReport;
use App\Inventaris;
use App\Jenis;
use App\kategori;
use App\Ruang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class InventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Inventaris::with('get_jenis')->get();
        $genre = Kategori::get();
        return view('inventaris.index', ['data' => $data], compact('genre'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return 'lol';
        // mengambil ID terakhir
        $id = Inventaris::getID();
        foreach ($id as $val);
        if (!empty($val->id_inventaris)) {
            $idLm = $val->id_inventaris;
        } else {
            $idLm = 0;
        }
        // $idLm = $val->id_inventaris;
        $idBaru = $idLm + 1;
        $blt = date('m-Y');

        $kode = 'INV-' . $idBaru;

        $data = Inventaris::get();
        $jenis = Jenis::get();
        $ruang = Ruang::get();
        $kategori = kategori::get();
        return view('inventaris.add', compact('data', 'jenis', 'ruang', 'kode', 'kategori'));
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
            'nama' => 'required|min:3',
            'kondisi' => 'required',
            'keterangan' => 'required',
            'jumlah' => 'required',
            // 'kode_inventaris' => 'required|min:3',
            'id_jenis' => 'required',
            'id_ruang' => 'required',
            'id_kategori' => 'required',
            'tanggal_registrasi' => 'required'

        ]);

        $users = Auth::user()->id;

        $inventaris = new Inventaris;
        $inventaris->id_inventaris = $request->id_inventaris;
        $inventaris->nama = $request->nama;
        $inventaris->kondisi = $request->kondisi;
        $inventaris->keterangan = $request->keterangan;
        $inventaris->jumlah = $request->jumlah;
        $inventaris->tanggal_registrasi = $request->tanggal_registrasi;
        $inventaris->kode_inventaris = $request->kode_inventaris;
        $inventaris->id_jenis = $request->id_jenis;
        $inventaris->id_ruang = $request->id_ruang;
        $inventaris->id_kategori = $request->id_kategori;
        $inventaris->id_admin = $users;
        // $inventaris->id_admin = $request->id_admin;
        $add = $inventaris->save();
        if ($add) {
            alert()->success('Saved!', 'Data Berhasil Di Tambah.');
            return redirect()->route('inventaris.index');
        } else {
            alert()->error('Error Save', 'Data Gagal Di Tambah.');
            return back();
        }
        // var_dump($_POST);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Inventaris::findOrFail($id);
        $jenis = Jenis::get();
        $ruang = Ruang::get();
        $kategori = kategori::get();
        // $petugas = Petugas::get();
        $datas = Inventaris::with('get_jenis')->get();
        return view('inventaris.show', compact('data', 'jenis', 'ruang', 'kategori'), ['datas' => $datas]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Inventaris::findOrFail($id);
        $jenis = Jenis::get();
        $ruang = Ruang::get();
        // $petugas = Petugas::get();
        $kategori = kategori::get();
        $datas = Inventaris::with('get_jenis')->get();
        return view('inventaris.edit', compact('data', 'jenis', 'ruang', 'kategori'), ['datas' => $datas]);
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
            'nama' => 'required|min:3',
            'kondisi' => 'required',
            'keterangan' => 'required',
            'jumlah' => 'required',
            'kode_inventaris' => 'required|min:3',
            'id_jenis' => 'required',
            'id_ruang' => 'required',
            'id_kategori' => 'required',
        ]);
        // var_dump($_POST);
        $data = Inventaris::findOrFail($id);
        $save = $data->update($request->all());
        if ($save) {
            alert()->success('Updated!', 'Data Berhasil Di Ubah.');
            return redirect()->route('inventaris.index');
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
        // var_dump($_POST);
        // $data = Inventaris::findOrFail($id);
        // $del = $data->delete();
        // if ($del) {
        //     alert()->success('Deleted!', 'Data Berhasil Di Hapus.');
        //     return redirect()->route('inventaris.index');
        // } else {
        //     alert()->error('Error Delete', 'Data Gagal Di Hapus.');
        //     return back();
        // }
    }
    public function delete(Request $req)
    {
        // var_dump($_POST);
        $data = Inventaris::findOrFail($req->id_inventaris);
        $del = $data->delete();
        if ($del) {
            alert()->success('Deleted!', 'Data Berhasil Di Hapus.');
            return redirect()->route('inventaris.index');
        } else {
            alert()->error('Error Delete', 'Data Gagal Di Hapus.');
            return back();
        }
    }

    public function daftar()
    {
        $data = Inventaris::with('get_jenis')->get();
        return view('inventaris.daftar', ['data' => $data]);
    }

    public function getAddToCart(Request $request, $id)
    {
        $brg = Inventaris::findOrFail($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($brg, $brg->id_inventaris);

        $request->session()->put('cart', $cart);
        // dd($request->session()->get('cart'));
        return redirect()->back();
        // return redirect()->route('inventaris.index');
    }
}
