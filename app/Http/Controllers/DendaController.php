<?php

namespace App\Http\Controllers;

use App\Denda;
use App\Inventaris;
use App\Kembali;
use App\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $id = 3;
        // $val = Inventaris::findOrFail($id)->jumlah;
        // dd($val);
        $data = Denda::get();
        return view('denda.index', compact('data'));
    }

    public function histori()
    {
        $id = Auth::user()->id;
        $data = Denda::where('user_id', $id)->get();
        // dd($data);
        return view('denda.histori', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Kembali::where('status', 'Terlambat & Kurang')->orWhere('status', 'Terlambat')
            ->get();

        // dd($data);
        return view('denda.add', compact('data'));
    }

    public function createUser()
    {
        // $id = Kembali::find(Auth::user()->id);

        $id = Auth::user()->id;
        $array = array("Terlambat & Kurang", "Terlambat");
        // $data = DB::select('select * from kembalis WHERE user_id = ' . $id . ' AND status IN ( "Terlambat & Kurang","Terlambat")');
        $data = Kembali::where('user_id', $id)
            ->whereIn('status', $array)
            ->get();
        // dd($id);
        return view('denda.cek', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($_POST);
        $id = $request->kembali_id;
        $total =  $request->total_denda;
        $bayar = $request->bayar_denda;
        $sisa = $request->sisa_denda;
        if ($total > $bayar) {
            $hasil = $bayar;
        } else {
            $hasil = $total;
        }
        // dd($hasil);

        $save = new Denda();
        $save->kode_denda = $request->kode_denda;
        $save->terlambat = $request->terlambat;
        $save->tanggal_denda = date('Y-m-d', strtotime(now()));
        $save->total_denda = $request->total_denda;
        $save->bayar_denda = $hasil;
        $save->status = $request->status;
        $save->kembali_id = $id;
        $save->user_id = $request->user_id;
        $save->admin_id = $request->admin_id;
        $store = $save->save();
        if ($store) {
            Kembali::where('id_kembali', $id)->update(['status' => 'Complete']);
            alert()->success('Saved', 'Data Berhasil Di tambah.');
            return redirect()->route('denda.index');
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
        $data = Denda::findOrFail($id);
        $qr = $data->kode_denda;
        $qrcode = QrCode::size(150)->generate($qr);
        return view('denda.show', compact('data', 'qrcode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
    public function add($id)
    {

        // mengambil ID terakhir
        $idK = Denda::getID();
        foreach ($idK as $val);
        if (!empty($val->id_denda)) {
            $idLm = $val->id_denda;
        } else {
            $idLm = 0;
        }
        // $idLm = $val->id_peminjaman;
        $idBaru = $idLm + 1;
        $blt = date('m/Y');

        $kode = 'DND-' . $blt . '-' . $idBaru;

        $data = Kembali::findOrFail($id);
        // dd($data);
        $idPinjam = $data->pinjam_id;
        $datas = Peminjaman::findOrFail($idPinjam);
        $denda = $data->terlambat * 1000;

        return view('denda.tambah', compact('data', 'datas', 'denda', 'kode'));
    }
}
