<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Jenis extends Model
{
    protected $table = 'jenis';
    protected $primaryKey = 'id_jenis';
    protected $fillable = [
        'id_jenis',
        'nama_jenis',
        'kode_jenis',
        'keterangan'
    ];

    public static function getID()
    {
        return $getId = DB::table('jenis')->orderBy('id_jenis', 'DESC')->take('1')->get();
    }
}
