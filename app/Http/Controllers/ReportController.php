<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Denda;
use App\Exports\AdminReport;
use App\Exports\DendaReport;
use App\Exports\InventarisReport;
use App\Exports\KembaliReport;
use App\Exports\PinjamReport;
use App\Exports\UserReport;
use App\Inventaris;
use App\Kembali;
use App\Peminjaman;
use App\User;
use PDF;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function report_excel()
    {
        return view('report.excel');
    }

    public function report_pdf()
    {
        return 'Tampilan PDF';
    }

    public function laporanExcelUser()
    {
        // return Excel::download(new UserReport, 'user.xlsx');
        $date = date(now());
        return (new UserReport)->download('user-' . $date . '.xlsx');
    }

    public function laporanExcelAdmin()
    {
        $date = date(now());
        return (new AdminReport)->download('petugas-' . $date . '.xlsx');
    }

    public function laporanExcelInventaris()
    {
        $date = date(now());
        return (new InventarisReport)->download('Inventaris-' . $date . '.xlsx');
    }

    public function laporanExcelPinjam()
    {
        $date = date(now());
        return (new PinjamReport)->download('Peminjaman-' . $date . '.xlsx');
    }

    public function laporanExcelKembali()
    {
        $date = date(now());
        return (new KembaliReport)->download('Pengembalian-' . $date . '.xlsx');
    }

    public function laporanExcelDenda()
    {
        $date = date(now());
        return (new DendaReport)->download('Denda-' . $date . '.xlsx');
    }



    // PDF Export
    public function laporanPdfInventaris()
    {
        $date = date(now());
        $data = Inventaris::get();
        $pdf = PDF::loadView('report.pdf.inventaris', compact('data'));
        return $pdf->download('Inventaris-' . $date . '.pdf');
    }

    public function laporanPdfUser()
    {
        $date = date(now());
        $data = User::get();
        $pdf = PDF::loadView('report.pdf.user', compact('data'));
        return $pdf->download('User-' . $date . '.pdf');
    }

    public function laporanPdfAdmin()
    {
        $date = date(now());
        $data = Admin::get();
        $pdf = PDF::loadView('report.pdf.admin', compact('data'));
        return $pdf->download('Admin-' . $date . '.pdf');
    }

    public function laporanPdfPinjam()
    {
        $date = date(now());
        $data = Peminjaman::get();
        $pdf = PDF::loadView('report.pdf.pinjam', compact('data'));
        return $pdf->download('Peminjaman-' . $date . '.pdf');
    }

    public function laporanPdfKembali()
    {
        $date = date(now());
        $data = Kembali::get();
        $pdf = PDF::loadView('report.pdf.kembali', compact('data'));
        return $pdf->download('Pengembalian-' . $date . '.pdf');
    }

    public function laporanPdfDenda()
    {
        $date = date(now());
        $data = Denda::get();
        $pdf = PDF::loadView('report.pdf.denda', compact('data'));
        return $pdf->download('Denda-' . $date . '.pdf');
    }
}
