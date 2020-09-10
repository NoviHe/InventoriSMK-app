<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Exports\AdminReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Admin::get();
        return view('petugas.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('petugas.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Auth::id();
        $request->validate([
            'name' => 'required|between:3,100',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required|min:6',
            'rePassword' => 'same:password',
            'level' => 'required',
        ]);

        $data = new Admin();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->level = $request->level;
        $save = $data->save();

        if ($save) {
            alert()->success('Saved', 'Data Berhasil Di tambah.');
            return redirect()->route('petugas.index');
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
        $data = Admin::findOrFail($id);
        return view('petugas.edit', compact('data'));
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
            'name' => 'required|between:3,100',
            'email' => 'required|email|unique:users,email,' . $id,
            'rePassword' => 'same:password'
        ]);

        if (!empty($request->password)) {
            $field = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'level' => $request->level,
            ];
        } else {
            $field = [
                'name' => $request->name,
                'email' => $request->email,
                'level' => $request->level,
            ];
        }
        $data = Admin::findorFail($id);
        $update = $data->update($field);

        if ($update) {
            alert()->success('Updated!', 'Data Berhasil Di Ubah.');
            return redirect()->route('petugas.index');
        } else {
            alert()->error('Failed!', 'Data Gagal Di Ubah.');
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
        $data = Admin::findOrFail($req->id);
        $del = $data->delete();
        if ($del) {
            alert()->success('Deleted!', 'Data Berhasil Di Hapus.');
            return redirect()->route('petugas.index');
        } else {
            alert()->error('Error Delete', 'Data Gagal Di Hapus.');
            return back();
        }
    }
}
