<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Denda extends Model
{
    protected $table = 'dendas';
    protected $primaryKey = 'id_denda';
    protected $fillable = [
        'id_denda',
        'kode_denda',
        'terlambat',
        'tanggal_denda',
        'total_denda',
        'bayar_denda',
        'status',
        'kembali_id',
        'user_id',
        'admin_id'
    ];

    public function get_user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function get_admin()
    {
        return $this->belongsTo('App\Admin', 'admin_id', 'id');
    }

    public function get_kembali()
    {
        return $this->belongsTo('App\Kembali', 'kembali_id', 'id_kembali');
    }

    public static function getID()
    {
        return $getId = DB::table('dendas')->orderBy('id_denda', 'DESC')->take('1')->get();
    }
    public function whereID()
    {
        $data = DB::table('dendas')->where('id_denda', Auth::user()->id);
        return $data;
    }
}
