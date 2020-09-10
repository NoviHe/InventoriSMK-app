<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kategori extends Model
{
    protected $table = 'kategoris';
    protected $primaryKey = 'id_kategori';
    protected $fillable = [
        'id_kategori',
        'nama_kategori',
        'kode_kategori',
        'keterangan'
    ];

    public static function getID()
    {
        return $getId = DB::table('kategoris')->orderBy('id_kategori', 'DESC')->take('1')->get();
    }
}
