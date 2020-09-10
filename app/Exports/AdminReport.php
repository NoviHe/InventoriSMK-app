<?php

namespace App\Exports;

use App\Admin;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class AdminReport implements FromView
{
    use Exportable;

    public function view(): View
    {
        return view('report.excel.admin', [
            'admins' => Admin::all()
        ]);
    }
}
