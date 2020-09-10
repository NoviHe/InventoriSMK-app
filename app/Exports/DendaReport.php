<?php

namespace App\Exports;

use App\Denda;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class DendaReport implements FromView
{
    use Exportable;

    public function view(): View
    {
        return view('report.excel.denda', [
            'data' => Denda::all()
        ]);
    }
}
