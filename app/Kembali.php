<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kembali extends Model
{
    protected $table = 'kembalis';
    protected $primaryKey = 'id_kembali';
    protected $fillable = [
        'id_kembali',
        'user_id',
        'admin_id',
        'pinjam_id',
        'kode_kembali',
        'tanggal_masuk',
        'terlambat',
        'cart',
        'status'
    ];
    public static function getID()
    {
        return $getId = DB::table('kembalis')->orderBy('id_kembali', 'DESC')->take('1')->get();
    }

    public function get_user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function get_admin()
    {
        return $this->belongsTo('App\Admin', 'admin_id', 'id');
    }

    public function get_pinjam()
    {
        return $this->belongsTo('App\Peminjaman', 'pinjam_id', 'id_peminjaman');
    }

    public static function join()
    {
        $data = DB::table('kembalis')
            ->join('users', 'kembalis.user_id', '=', 'users.id')
            ->join('admins', 'kembalis.admin_id', '=', 'admins.id')
            ->orderBy('id_kembali', 'DESC');
        return $data;
    }
}
