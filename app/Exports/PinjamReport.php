<?php

namespace App\Exports;

use App\Peminjaman;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class PinjamReport implements FromView
{
    use Exportable;

    public function view(): View
    {
        return view('report.excel.pinjam', [
            'Pinjam' => Peminjaman::all()
        ]);
    }
}
