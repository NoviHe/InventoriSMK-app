<?php

namespace App\Exports;

use App\Inventaris;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class InventarisReport implements FromView
{
    use Exportable;

    public function view(): View
    {
        return view('report.excel.inventaris', [
            'inven' => Inventaris::get()
        ]);
    }
}
