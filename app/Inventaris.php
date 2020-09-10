<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Inventaris extends Model
{
    protected $table = 'inventaris';
    protected $primaryKey = 'id_inventaris';
    protected $fillable = [
        'id_inventaris',
        'nama',
        'kondisi',
        'keterangan',
        'jumlah',
        'tanggal_registrasi',
        'kode_inventaris',
        'id_jenis',
        'id_ruang',
        'id_admin',
        'id_kategori',
    ];

    public static function join()
    {
        $data = DB::table('inventaris')
            ->join('kategoris', 'inventaris.id_kategori', '=', 'kategoris.id_kategori')
            ->join('ruangs', 'inventaris.id_ruang', '=', 'ruangs.id_ruang')
            ->select('inventaris.*', 'kategoris.nama_kategori', 'ruangs.nama_ruang');
        return $data;
    }

    public static function getID()
    {
        return $getId = DB::table('inventaris')->orderBy('id_inventaris', 'DESC')->take('1')->get();
    }
    public function get_jenis()
    {
        return $this->belongsTo('App\jenis', 'id_jenis', 'id_jenis');
    }
    public function get_ruang()
    {
        return $this->belongsTo('App\ruang', 'id_ruang', 'id_ruang');
    }
    public function get_kategori()
    {
        return $this->belongsTo('App\kategori', 'id_kategori', 'id_kategori');
    }
    public function get_petugas()
    {
        return $this->belongsTo('App\Admin', 'id_admin', 'id');
    }
}
