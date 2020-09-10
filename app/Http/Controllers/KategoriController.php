<?php

namespace App\Http\Controllers;

use App\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mengambil ID terakhir
        $id = Kategori::getID();
        foreach ($id as $val);
        if (!empty($val->id_kategori)) {
            $idLm = $val->id_kategori;
        } else {
            $idLm = 0;
        }
        // $idLm = $val->id_jenis;
        $idBaru = $idLm + 1;
        $blt = date('m-Y');

        $kode = 'KAT-' . $idBaru;

        $data = kategori::all();
        return view('kategori.index', compact('data', 'kode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'nama_kategori' => 'required|min:3',
            // 'kode_jenis' => 'required|min:3',
            'keterangan' => 'required'
        ]);

        //mengambil ID terakhir
        $id = Kategori::getID();
        foreach ($id as $val);
        if (!empty($val->id_kategori)) {
            $idLm = $val->id_kategori;
        } else {
            $idLm = 0;
        }
        // $idLm = $val->id_jenis;
        $idBaru = $idLm + 1;
        $blt = date('m-Y');

        $kode = 'KA-' . $idBaru;

        $data = new Kategori;
        $data->nama_kategori = $request->nama_kategori;
        $data->kode_kategori = $request->kode_kategori;
        $data->keterangan = $request->keterangan;
        $add = $data->save();
        if ($add) {
            alert()->success('Saved!', 'Data Berhasil Di Tambah.');
            return redirect()->route('kategori.index');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Kategori::findorFail($id);
        return view('kategori.edit', compact('data'));
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
            'nama_kategori' => 'required|min:3',
            // 'kode_jenis' => 'required|min:3',
            'keterangan' => 'required'
        ]);

        $data = kategori::FindorFail($id);
        $edit = $data->update($request->all());
        if ($edit) {
            alert()->success('Updated!', 'Data Berhasil Di Ubah.');
            return redirect()->route('kategori.index');
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
    public function delete(Request $req)
    {
        // var_dump($_POST);
        $data = kategori::findOrFail($req->id_kategori);
        $del = $data->delete();
        if ($del) {
            alert()->success('Deleted!', 'Data Berhasil Di Hapus.');
            return redirect()->route('kategori.index');
        } else {
            alert()->error('Error Delete', 'Data Gagal Di Hapus.');
            return back();
        }
    }
}
