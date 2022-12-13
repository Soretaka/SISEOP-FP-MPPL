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
