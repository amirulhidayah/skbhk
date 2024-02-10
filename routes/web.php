<?php

use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\ListController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/getChartData', [App\Http\Controllers\HomeController::class, 'getchartdata']);
Route::get('/editprofile', [App\Http\Controllers\HomeController::class, 'edit']);
Route::put('/editprofile', [App\Http\Controllers\HomeController::class, 'update']);
Route::get('/infosurat', [App\Http\Controllers\HomeController::class, 'infosurat'])->name('infosurat');
Route::get('/surat', [App\Http\Controllers\HomeController::class, 'indexsurat']);
Route::get('/generate-pdf/{surat_id}', [App\Http\Controllers\HomeController::class, 'generatePDF']);
Route::get('/print/{surat_id}', [App\Http\Controllers\HomeController::class, 'printPDF']);
Route::get('/tambahsurat', [App\Http\Controllers\HomeController::class, 'create']);
Route::post('/tambahsurat', [App\Http\Controllers\HomeController::class, 'store']);
route::get('/editsurat/{surat_id}', [App\Http\Controllers\HomeController::class, 'editsurat']);
route::put('/editsurat/{surat_id}', [App\Http\Controllers\HomeController::class, 'updatesurat']);
route::get('/hapussurat/{surat_id}', [App\Http\Controllers\HomeController::class, 'destroy']);
route::get('/lihatskbhk/{surat_id}', [App\Http\Controllers\HomeController::class, 'lihatpdf']);
route::post('/importskbhk/{surat_id}', [App\Http\Controllers\HomeController::class, 'importpdf']);

Route::get('/admin/surat', 'Admin\SuratController@index')->name('admin.surat.index');
Route::get('/admin/surat/search', 'Admin\SuratController@search')->name('admin.surat.search');
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
    Route::get('/getChartData', [App\Http\Controllers\Admin\DashboardController::class, 'getChartData']);
    route::get('/editprofil', [App\Http\Controllers\Admin\EditprofilController::class, 'edit']);
    route::put('/editprofil', [App\Http\Controllers\Admin\EditprofilController::class, 'update']);

    route::get('/masteruser', [App\Http\Controllers\Admin\MasterUserController::class, 'index']);
    route::get('/tambahuser', [App\Http\Controllers\Admin\MasterUserController::class, 'create']);
    route::post('/tambahuser', [App\Http\Controllers\Admin\MasterUserController::class, 'store']);
    route::get('/edituser/{masteruser_id}', [App\Http\Controllers\Admin\MasterUserController::class, 'edit']);
    route::put('/edituser/{masteruser_id}', [App\Http\Controllers\Admin\MasterUserController::class, 'update']);
    route::get('/hapususer/{masteruser_id}', [App\Http\Controllers\Admin\MasterUserController::class, 'destroy']);

    route::get('/masterkaryawan', [App\Http\Controllers\Admin\KaryawanController::class, 'index']);
    route::get('/tambahkaryawan', [App\Http\Controllers\Admin\KaryawanController::class, 'create']);
    route::post('/tambahkaryawan', [App\Http\Controllers\Admin\KaryawanController::class, 'store']);
    route::get('/editkaryawan/{karyawan_id}', [App\Http\Controllers\Admin\KaryawanController::class, 'edit']);
    route::put('/editkaryawan/{karyawan_id}', [App\Http\Controllers\Admin\KaryawanController::class, 'update']);
    route::get('/hapuskaryawan/{karyawan_id}', [App\Http\Controllers\Admin\KaryawanController::class, 'destroy']);
    route::post('/importkaryawan', [App\Http\Controllers\Admin\KaryawanController::class, 'import']);


    Route::get('/infosurat', [App\Http\Controllers\Admin\SuratController::class, 'infosurat']);
    Route::get('/surat', [App\Http\Controllers\Admin\SuratController::class, 'index']);
    Route::get('/generate-pdf/{surat_id}', [App\Http\Controllers\Admin\SuratController::class, 'generatePDF']);
    Route::get('/print/{surat_id}', [App\Http\Controllers\Admin\SuratController::class, 'printPDF']);
    Route::get('/tambahsurat', [App\Http\Controllers\Admin\SuratController::class, 'create']);
    Route::post('/tambahsurat', [App\Http\Controllers\Admin\SuratController::class, 'store']);
    route::get('/editsurat/{surat_id}', [App\Http\Controllers\Admin\SuratController::class, 'edit']);
    route::put('/editsurat/{surat_id}', [App\Http\Controllers\Admin\SuratController::class, 'update']);
    route::get('/hapussurat/{surat_id}', [App\Http\Controllers\Admin\SuratController::class, 'destroy']);
    route::get('/lihatskbhk/{surat_id}', [App\Http\Controllers\Admin\SuratController::class, 'lihatpdf']);
    route::post('/importskbhk/{surat_id}', [App\Http\Controllers\Admin\SuratController::class, 'importpdf']);
    Route::get('/masterbranchreguler', [App\Http\Controllers\Admin\MasterBranchRegulerController::class, 'index']);
    Route::patch('/masterbranchreguler/{id}/update-status', [App\Http\Controllers\Admin\MasterBranchRegulerController::class, 'updateStatus']);
    Route::get('/tambahbranchreguler', [App\Http\Controllers\Admin\MasterBranchRegulerController::class, 'create']);
    Route::post('/tambahbranchreguler', [App\Http\Controllers\Admin\MasterBranchRegulerController::class, 'store']);
    Route::get('/editbranchreguler/{masterbranchreguler_id}', [App\Http\Controllers\Admin\MasterBranchRegulerController::class, 'edit']);
    Route::put('/editbranchreguler/{masterbranchreguler_id}', [App\Http\Controllers\Admin\MasterBranchRegulerController::class, 'update']);
    Route::get('/hapusbranchreguler/{masterbranchreguler_id}', [App\Http\Controllers\Admin\MasterBranchRegulerController::class, 'destroy']);

    Route::get('/masterbranchfranchise', [App\Http\Controllers\Admin\MasterBranchFranchiseController::class, 'index']);
    Route::post('/update-status/{id}', [App\Http\Controllers\Admin\MasterBranchFranchiseController::class, 'updateStatus']);
    Route::get('/tambahbranchfranchise', [App\Http\Controllers\Admin\MasterBranchFranchiseController::class, 'create']);
    Route::post('/tambahbranchfranchise', [App\Http\Controllers\Admin\MasterBranchFranchiseController::class, 'store']);
    Route::get('/editbranchfranchise/{masterbranchfranchise_id}', [App\Http\Controllers\Admin\MasterBranchFranchiseController::class, 'edit']);
    Route::put('/editbranchfranchise/{masterbranchfranchise_id}', [App\Http\Controllers\Admin\MasterBranchFranchiseController::class, 'update']);
    Route::get('/hapusbranchfranchise/{masterbranchfranchise_id}', [App\Http\Controllers\Admin\MasterBranchFranchiseController::class, 'destroy']);

    Route::get('/masterttd', [App\Http\Controllers\Admin\MasterTtdController::class, 'index']);
    Route::get('/tambahttd', [App\Http\Controllers\Admin\MasterTtdController::class, 'create']);
    Route::post('/tambahttd', [App\Http\Controllers\Admin\MasterTtdController::class, 'store']);
    Route::get('/editttd/{masterttd_id}', [App\Http\Controllers\Admin\MasterTtdController::class, 'edit']);
    Route::put('/editttd/{masterttd_id}', [App\Http\Controllers\Admin\MasterTtdController::class, 'update']);
    Route::get('/hapusttd/{masterttd_id}', [App\Http\Controllers\Admin\MasterTtdController::class, 'destroy']);

    Route::get('/mastertoko', [App\Http\Controllers\Admin\TokoController::class, 'index']);
    Route::get('/tambahtoko', [App\Http\Controllers\Admin\TokoController::class, 'create']);
    Route::post('/tambahtoko', [App\Http\Controllers\Admin\TokoController::class, 'store']);
    Route::get('/edittoko/{mastertoko_id}', [App\Http\Controllers\Admin\TokoController::class, 'edit']);
    Route::put('/edittoko/{mastertoko_id}', [App\Http\Controllers\Admin\TokoController::class, 'update']);
    Route::get('/hapustoko/{mastertoko_id}', [App\Http\Controllers\Admin\TokoController::class, 'destroy']);
});

Route::get('list/toko', [ListController::class, 'toko']);
