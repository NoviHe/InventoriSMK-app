<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// use Illuminate\Routing\Route;

// use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('/');

// Route::get('qrcode', function () {
//     return QrCode::size(300)->generate('A basic example of QR code!');
// });

//User
Route::get('/user', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('/logout', 'Auth\LoginController@logoutUser')->name('logoutuser');
//Admin
Route::get('/dashboard', 'AdminController@index')->name('dashboard'); //view
Route::get('/Admin', 'AuthAdmin\AdminLoginController@showLogin')->name('login.admin'); //form login
Route::post('/Admin/login', 'AuthAdmin\AdminLoginController@login')->name('admin.masuk'); //proses login
Route::get('/logoutadmin', 'AuthAdmin\AdminLoginController@logoutAdmin')->name('logoutAdmin');

Route::get('/peminjaman/add-to-cart/{id}', 'InventarisController@getAddToCart')->name('inventaris.addToCart');
Route::get('/peminjaman/pinjam', 'PinjamController@getCheckout')->name('checkout')->middleware('auth:admin');
Route::post('/peminjaman/pinjam', 'PinjamController@store')->name('peminjaman.store')->middleware('auth:admin');
Route::get('/inventaris/create', 'InventarisController@create')->middleware('auth:admin');

Route::group(['middleware' => 'auth'], function () {
    Route::prefix('pegawai')->group(function () {
        Route::get('/daftar', 'UserController@daftar')->name('pegawai.daftar');

        Route::get('/setting', 'UserController@settingForm')->name('pegawai.setting');
        Route::post('/setting', 'UserController@settingUpdate');
    });
    //peminjaman
    Route::prefix('/peminjaman')->group(function () {
        Route::get('/pinjam-barang', 'PinjamController@createUser')->name('pinjam.addUser');
        Route::post('/pinjam-barang/cart', 'PinjamController@cartUser')->name('pinjam.keranjang');
        Route::get('/pinjam-barang/reduce/{id}', 'PinjamController@minByOne')->name('pinjam.minOne');
        Route::get('/pinjam-barang/plus/{id}', 'PinjamController@plusByOne')->name('pinjam.plusOne');
        Route::get('/pinjam-barang/pinjam', 'PinjamController@getCheckoutUser')->name('checkoutUser');
        Route::post('/pinjam-barang', 'PinjamController@storeUser')->name('peminjaman.storeUser');
        Route::get('/pinjam-barang/histori', 'PinjamController@histori')->name('pinjam.histori');
        Route::get('/pinjam-barang/{id}/show', 'PinjamController@show')->name('pinjam.show');
    });
    //Denda
    Route::prefix('/denda')->group(function () {
        Route::get('/{id}/add', 'DendaController@add')->name('denda.add');
        Route::get('/cek-denda', 'DendaController@createUser')->name('denda.cek');
        Route::get('/cek-denda/{id}/show', 'KembaliController@show')->name('denda.cekShow');
        Route::get('/histori', 'DendaController@histori')->name('denda.histori');
    });
    Route::prefix('inventaris')->group(function () {
        Route::get('/daftar', 'InventarisController@daftar')->name('inventaris.daftar');
        // Route::get('/{id}', 'InventarisController@show')->name('inventaris.show');
    });
});

Route::prefix('inventaris')->group(function () {
    Route::get('/{id}', 'InventarisController@show')->name('inventaris.show');
});

//group midleware auth:admin
Route::group(['middleware' => 'auth:admin'], function () {
    //jenis
    Route::resource('/jenis', 'JenisController');
    Route::prefix('jenis')->group(function () {
        Route::delete('/', 'JenisController@delete')->name('jenis.delete');
    });
    //kategori
    Route::resource('/kategori', 'KategoriController');
    Route::prefix('kategori')->group(function () {
        Route::delete('/', 'KategoriController@delete')->name('kategori.delete');
    });
    //ruang
    Route::resource('/ruang', 'RuangController');
    Route::prefix('ruang')->group(function () {
        Route::delete('/', 'RuangController@delete')->name('ruang.delete');
    });
    //inventaris
    Route::resource('/inventaris', 'InventarisController');
    Route::prefix('inventaris')->group(function () {
        Route::delete('/', 'InventarisController@delete')->name('inventaris.delete');
    });
    //pegawai
    Route::resource('/pegawai', 'UserController');
    Route::prefix('pegawai')->group(function () {
        Route::delete('/', 'UserController@delete')->name('pegawai.delete');
    });
    //petugas
    Route::resource('/petugas', 'PetugasController');
    Route::prefix('petugas')->group(function () {
        // Route::get('/setting', 'UserSettingController@form')->name('petugas.setting');
        // Route::post('/setting', 'UserSettingController@updateSetting');

        Route::delete('/', 'PetugasController@delete')->name('petugas.delete');
    });
    //peminjaman
    Route::resource('/peminjaman', 'PinjamController');
    Route::prefix('/peminjaman')->group(function () {
        Route::Post('/', 'PinjamController@keranjang')->name('peminjaman.keranjang');
        Route::get('/reduce/{id}', 'PinjamController@minByOne')->name('pinjam.minByOne');
        Route::get('/plus/{id}', 'PinjamController@plusByOne')->name('pinjam.plusByOne');
    });
    //pengembalian
    Route::resource('/pengembalian', 'KembaliController');
    Route::prefix('/pengembalian')->group(function () {
        Route::get('/add/{id}', 'PinjamController@edit')->name('pengembalian.add');
        // Route::get('/edit/{id}', 'KembaliController@ubah')->name('pengembalian.edit');
    });
    //Denda
    Route::resource('/denda', 'DendaController');
    Route::prefix('/denda')->group(function () {
        Route::get('/{id}/add', 'DendaController@add')->name('denda.add');
    });
    //Report
    Route::prefix('/report')->group(function () {
        Route::get('/excel_report', 'ReportController@report_excel')->name('report.excel');
        Route::get('/excel_user_report', 'ReportController@laporanExcelUser')->name('user.excel');
        Route::get('/excel_admin_report', 'ReportController@laporanExcelAdmin')->name('admin.excel');
        Route::get('/excel_inventaris_report', 'ReportController@laporanExcelInventaris')->name('inventaris.excel');
        Route::get('/excel_peminjaman_report', 'ReportController@laporanExcelPinjam')->name('pinjam.excel');
        Route::get('/excel_pengembalian_report', 'ReportController@laporanExcelKembali')->name('kembali.excel');
        Route::get('/excel_denda_report', 'ReportController@laporanExcelDenda')->name('denda.excel');


        Route::get('/pdf_report', 'ReportController@report_pdf')->name('report.pdf');
        Route::get('/pdf_inventaris_report', 'ReportController@laporanPdfInventaris')->name('inventaris.pdf');
        Route::get('/pdf_user_report', 'ReportController@laporanPdfUser')->name('user.pdf');
        Route::get('/pdf_admin_report', 'ReportController@laporanPdfAdmin')->name('admin.pdf');
        Route::get('/pdf_peminjaman_report', 'ReportController@laporanPdfPinjam')->name('pinjam.pdf');
        Route::get('/pdf_pengembalian_report', 'ReportController@laporanPdfKembali')->name('kembali.pdf');
        Route::get('/pdf_denda_report', 'ReportController@laporanPdfDenda')->name('denda.pdf');
    });
});


Route::post('/jabar', 'PinjamController@jabar')->name('jabar');
Route::post('/cariPegawai', 'PinjamController@cariPegawai')->name('cariPegawai');
Route::post('/cari', 'KembaliController@cari')->name('cari');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');
