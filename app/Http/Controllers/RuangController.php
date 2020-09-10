<?php

namespace App\Http\Controllers;

use App\Ruang;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mengambil ID terakhir
        $id = Ruang::getID();
        foreach ($id as $val);
        if (!empty($val->id_ruang)) {
            $idLm = $val->id_ruang;
        } else {
            $idLm = 0;
        }
        // $idLm = $val->id_ruang;
        $idBaru = $idLm + 1;
        $blt = date('m-Y');

        $kode = 'RUA-' . $idBaru;

        $data = Ruang::all();
        return view('ruang.index', compact('data', 'kode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ruang.tambah');
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
            'nama_ruang' => 'required|min:3',
            // 'kode_ruang' => 'required|min:3',
            'keterangan' => 'required'
        ]);

        $data = new ruang;
        $data->nama_ruang = $request->nama_ruang;
        $data->kode_ruang = $request->kode_ruang;
        $data->keterangan = $request->keterangan;
        $add = $data->save();
        if ($add) {
            alert()->success('Saved!', 'Data Berhasil Di Tambah.');
            return redirect()->route('ruang.index');
        } else {
            alert()->error('Error Save', 'Data Gagal Di Tambah.');
            return redirect()->route('ruang.index');
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
        $data = Ruang::findOrFail($id);
        return view('ruang.edit', compact('data'));
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
            'nama_ruang' => 'required|min:3',
            'kode_ruang' => 'required|min:3',
            'keterangan' => 'required'
        ]);
        // var_dump($_POST);
        $data = Ruang::findOrFail($id);
        $save = $data->update($request->all());
        if ($save) {
            alert()->success('Updated!', 'Data Berhasil Di Ubah.');
            return redirect()->route('ruang.index');
        } else {
            alert()->error('Error Update', 'Data Gagal Di Ubah.');
            return redirect()->route('ruang.index');
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
        $data = Ruang::findOrFail($id);
        $del = $data->delete();
        if ($del) {
            alert()->success('Deleted!', 'Data Berhasil Di Hapus.');
            return redirect()->route('ruang.index');
        } else {
            alert()->error('Error Delete', 'Data Gagal Di Hapus.');
            return redirect()->route('ruang.index');
        }
    }
    public function delete(Request $req)
    {
        // var_dump($_POST);
        $data = ruang::findOrFail($req->id_ruang);
        $del = $data->delete();
        if ($del) {
            alert()->success('Deleted!', 'Data Berhasil Di Hapus.');
            return redirect()->route('ruang.index');
        } else {
            alert()->error('Error Delete', 'Data Gagal Di Hapus.');
            return back();
        }
    }
}
