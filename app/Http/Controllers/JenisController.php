<?php

namespace App\Http\Controllers;

use App\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        //mengambil ID terakhir
        $id = Jenis::getID();
        foreach ($id as $val);
        if (!empty($val->id_jenis)) {
            $idLm = $val->id_jenis;
        } else {
            $idLm = 0;
        }
        // $idLm = $val->id_jenis;
        $idBaru = $idLm + 1;
        $blt = date('m-Y');

        $kode = 'JNS-' . $idBaru;
        // var_dump($kode);
        $data = Jenis::all();
        return view('jenis.index', compact('data', 'kode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //mengambil ID terakhir
        $id = Jenis::getID();
        foreach ($id as $val);
        if (!empty($val->id_jenis)) {
            $idLm = $val->id_jenis;
        } else {
            $idLm = 0;
        }
        // $idLm = $val->id_jenis;
        $idBaru = $idLm + 1;
        $blt = date('m-Y');

        $kode = 'JNS-' . $idBaru;
        // var_dump($kode);
        return view('jenis.tambah', compact('kode'));
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
            'nama_jenis' => 'required|min:3',
            // 'kode_jenis' => 'required|min:3',
            'keterangan' => 'required'
        ]);
        $data = new Jenis();
        $data->nama_jenis = $request->nama_jenis;
        $data->kode_jenis = $request->kode_jenis;
        $data->keterangan = $request->keterangan;
        $add = $data->save();
        if ($add) {
            alert()->success('Saved!', 'Data Berhasil Di Tambah.');
            return redirect()->route('jenis.index');
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
        $data = Jenis::findOrFail($id);
        return view('jenis.edit', compact('data'));
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
            'nama_jenis' => 'required|min:3',
            'kode_jenis' => 'required|min:3',
            'keterangan' => 'required'
        ]);
        // var_dump($_POST);
        $data = Jenis::findOrFail($id);
        $save = $data->update($request->all());
        if ($save) {
            alert()->success('Updated!', 'Data Berhasil Di Ubah.');
            return redirect()->route('jenis.index');
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
        $data = Jenis::findOrFail($id);
        $del = $data->delete();
        if ($del) {
            alert()->success('Deleted!', 'Data Berhasil Di Hapus.');
            return redirect()->route('jenis.index');
        } else {
            alert()->error('Error Delete', 'Data Gagal Di Hapus.');
            return back();
        }
    }
    public function delete(Request $req)
    {
        // var_dump($_POST);
        $data = Jenis::findOrFail($req->id_jenis);
        $del = $data->delete();
        if ($del) {
            alert()->success('Deleted!', 'Data Berhasil Di Hapus.');
            return redirect()->route('jenis.index');
        } else {
            alert()->error('Error Delete', 'Data Gagal Di Hapus.');
            return back();
        }
    }
}
