<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\Auth\RedirectAuthenticatedUsersController;
use App\Http\Controllers\BankPertanyaanController;
use App\Http\Controllers\UserJabatanController;

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

Route::get('/', function () {
    return redirect('login');
});


Route::group(['middleware' => 'auth'], function () {
    Route::get("/redirectAuthenticatedUsers", [RedirectAuthenticatedUsersController::class, "home"]);
    //untuk admin
    Route::group(['middleware' => 'checkRole:admin'], function () {
        Route::get('/adminDashboard', [DashboardController::class, 'indexAdm'])->name('admin-dashboard');
        Route::get('/ubahRole', [UserJabatanController::class, 'ubahRole'])->name('ubah-role');
        Route::put('/updateRole', [UserJabatanController::class, 'ubahRoleUpdate'])->name('update-data-role');
        Route::get('/tambahRole', [UserJabatanController::class, 'tambahRole'])->name('tambah-role');
        Route::post('/store', [UserJabatanController::class, 'addRole'])->name('store-data-role');
        //view yang dapat diakses oleh admin
    });

    // User
    Route::group(['middleware' => 'checkRole:user'], function () {
        Route::get('/userDashboard', [DashboardController::class, 'indexUser'])->name('user-dashboard');
        Route::get('/surveyDashboard', [SurveyController::class, 'indexSurvey'])->name('survey-dashboard');
        Route::post('/storeSurvey', [SurveyController::class, 'addSurvey'])->name('store-data-survey');
        Route::get('/tambahPertanyaan/{id}', [SurveyController::class, 'tambahPertanyaan'])->name('tambah-pertanyaan-data-survey');
        Route::get('tambah-pertanyaan', [SurveyController::class, 'tambah_pertanyaan'])->name('tambah-pertanyaan');
        Route::get('/deleteSurvey/{id}', [SurveyController::class, 'deleteSurvey'])->name('delete-data-survey');
        Route::get('/detailSurvey/{id}', [SurveyController::class, 'detailSurvey'])->name('detail-data-survey');
        Route::get('/addQuestion/{id}', [SurveyController::class, 'addQuestion'])->name('add-question-data-survey');
        Route::post('/add-pertanyaan', [SurveyController::class, 'add_to_bank'])->name('add-pertanyaan');
        Route::get('/deleteAku/{pertanyaan_id}/{survey_id}', [SurveyController::class, 'deletePertanyaan'])->name('delete-data-pertanyaan-surveys');
        Route::get('/lock-survey/{id}', [SurveyController::class, 'lockSurvey'])->name('lock-data-surveys');
        Route::POST('/add_penjawab', [SurveyController::class, 'add_penjawab'])->name('add-penjawab');

        Route::get('/tambah_penjawab/{id}', [SurveyController::class, 'halamanTambahJawaban'])->name('tambah-penjawab');
        Route::get('/siapa_menjawab/{id}', [SurveyController::class, 'lihat_penjawab'])->name('lihat-penjawab');
        Route::get('/siapa_menjawab_detail/{user_id}/{survey_id}', [SurveyController::class, 'lihat_penjawab_detail'])->name('lihat-penjawab-detail');

        Route::get('/past-survey-dashboard', [SurveyController::class, 'indexPastSurvey'])->name('past-survey-dashboard');

        Route::get('/penjawab_semua/{id}', [SurveyController::class, 'penjawab_semua'])->name('penjawab-semua');
        Route::post('/tambahJawaban', [SurveyController::class, 'tambahJawaban'])->name('tambah-jawaban');
        Route::get('/kerjakan_survey/{id}', [SurveyController::class, 'kerjakan_survey'])->name('kerjakan-survey');
        Route::get('/detail_nilai/{id}', [SurveyController::class, 'detail_nilai'])->name('detail-nilai');

        Route::get('/bankPertanyaan', [BankPertanyaanController::class, 'indexBank'])->name('bank-pertanyaan');
        Route::get('/tambahBank', [BankPertanyaanController::class, 'tambahBank'])->name('tambah-bank');
        Route::post('/storeBank', [BankPertanyaanController::class, 'addBank'])->name('store-data-bank');

        Route::get('/questionDashboard', [BankPertanyaanController::class, 'indexPertanyaan'])->name('pertanyaan-dashboard');
        Route::post('/storePertanyaan', [BankPertanyaanController::class, 'savePertanyaan'])->name('store-data-pertanyaan');
        Route::get('/deletePertanyaan/{id}', [BankPertanyaanController::class, 'deletePertanyaan'])->name('delete-data-pertanyaan');
        //view yang dapat diakses oleh user
    });

    //Guest
    Route::group(['middleware' => 'checkRole:guest'], function () {
        Route::get('/guestDashboard', [DashboardController::class, 'guestUser'])->name('guest-dashboard');
        //view yang dapat diakses oleh guest
    });
});
require __DIR__ . '/auth.php';
