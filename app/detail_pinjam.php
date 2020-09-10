<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detail_pinjam extends Model
{
    protected $table = 'detail_pinjams';
    protected $primaryKey = 'id_detail';
    protected $fillable = [
        'id_detail',
        'id_inventaris',
        'id_peminjaman',
        'jumlah'
    ];
}
