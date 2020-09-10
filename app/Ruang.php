<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ruang extends Model
{
    protected $table = 'ruangs';
    protected $primaryKey = 'id_ruang';
    protected $fillable = [
        'id_ruang',
        'nama_ruang',
        'kode_ruang',
        'keterangan'
    ];

    public static function getID()
    {
        return $getId = DB::table('ruangs')->orderBy('id_ruang', 'DESC')->take('1')->get();
    }
}
