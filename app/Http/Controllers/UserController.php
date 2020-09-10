<?php

namespace App\Http\Controllers;

use App\Exports\UserReport;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::get();
        return view('pegawai.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pegawai.add');
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
            'no_telp' => 'required|max:13',
            'alamat' => 'required',
        ]);

        $data = new User;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->no_telp = $request->no_telp;
        $data->alamat = $request->alamat;
        $save = $data->save();

        if ($save) {
            alert()->success('Saved', 'Data Berhasil Di tambah.');
            return redirect()->route('pegawai.index');
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
        $data = User::findorFail($id);
        return view('pegawai.edit', compact('data'));
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
            'no_telp' => 'required|max:13',
            'alamat' => 'required',
        ]);

        if (!empty($request->password)) {
            $field = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat
            ];
        } else {
            $field = [
                'name' => $request->name,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat
            ];
        }
        $data = User::findorFail($id);
        $update = $data->update($field);

        if ($update) {
            alert()->success('Updated!', 'Data Berhasil Di Ubah.');
            return redirect()->route('pegawai.index');
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
        $data = User::findOrFail($req->id);
        $del = $data->delete();
        if ($del) {
            alert()->success('Deleted!', 'Data Berhasil Di Hapus.');
            return redirect()->route('pegawai.index');
        } else {
            alert()->error('Error Delete', 'Data Gagal Di Hapus.');
            return back();
        }
    }
    public function daftar()
    {
        $id = Auth::user()->id;
        $data = User::findOrFail($id);
        // dd($data);
        return view('pegawai.daftar', compact('data'));
    }
    public function settingForm()
    {
        $data = User::where('id', Auth::id())->first();
        return view('pegawai.setting', compact('data'));
    }
    public function settingUpdate(Request $request)
    {
        // var_dump($_POST);
        $id = Auth::id();
        $request->validate([
            'name' => 'required|between:3,100',
            'email' => 'required|email|unique:users,email,' . $id,
            'no_telp' => 'required|max:13',
            'alamat' => 'required',
        ]);

        if (!empty($request->password)) {
            $field = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat
            ];
        } else {
            $field = [
                'name' => $request->name,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat
            ];
        }

        $result = User::where('id', $id)->update($field);

        if ($result) {
            alert()->success('Updated!', 'Data Berhasil Di Ubah.');
            return redirect()->route('pegawai.daftar');
        } else {
            alert()->error('Failed!', 'Data Gagal Di Ubah.');
            return back();
        }
    }
}
