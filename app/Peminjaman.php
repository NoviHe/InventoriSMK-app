<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';
    protected $fillable = [
        'id_peminjaman',
        'kode_pinjam',
        'tanggal_pinjam',
        'lama_pinjam',
        'tanggal_kembali',
        'cart',
        'cart_new',
        'status',
        'user_id',
        'admin_id'
    ];

    public static function join()
    {
        $data = DB::table('peminjaman')
            ->join('users', 'peminjaman.user_id', '=', 'users.id')
            ->select('peminjaman.*', 'users.name')
            ->orderBy('status', 'DESC')
            ->orderBy('id_peminjaman', 'DESC');
        return $data;
    }

    public static function joinUser()
    {
        $data = DB::table('peminjaman')
            ->join('users', 'peminjaman.user_id', '=', 'users.id')
            ->select('peminjaman.*', 'users.name')
            ->orderBy('status', 'DESC')
            ->orderBy('id_peminjaman', 'DESC');
        return $data;
    }

    public static function cari($id)
    {
        $data = DB::table('peminjaman')
            ->join('users', 'peminjaman.user_id', '=', 'users.id')
            ->join('admins', 'peminjaman.admin_id', '=', 'admins.id')
            ->select('peminjaman.*', 'users.name')
            ->where('peminjaman.id_peminjaman', $id);
        return $data;
    }

    public static function Code($id)
    {
        $data = DB::table('inventaris')
            ->select('nama')
            ->where('kode_inventaris', $id);
    }

    public static function getID()
    {
        return $getId = DB::table('peminjaman')->orderBy('id_peminjaman', 'DESC')->take('1')->get();
    }

    public function get_user()
    {
        return $this->belongsTo('App\user', 'user_id', 'id');
    }
    public function get_admin()
    {
        return $this->belongsTo('App\Admin', 'admin_id', 'id');
    }
}
