<?php

namespace App\Exports;

use App\Kembali;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class KembaliReport implements FromView
{
    use Exportable;

    public function view(): View
    {
        return view('report.excel.kembali', [
            'data' => Kembali::all()
        ]);
    }
}
