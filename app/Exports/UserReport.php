<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class UserReport implements FromView
{
    use Exportable;

    public function view(): View
    {
        return view('report.excel.user', [
            'users' => User::all()
        ]);
    }
}
