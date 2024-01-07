<?php

use App\Http\Controllers\LetterController;
use App\Http\Controllers\LetterTypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function(){
    Route::get('/', function () {
        return view('login');
    })->name("login");
    Route::post('/login-auth', [UserController::class, 'loginAuth'])->name('login.auth');
});

Route::middleware(['IsLogin'])->group(function () {

    Route::get('/home', function () {
        return view('home');
    }); 
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    // Route::post('/cari', [UserController::class, 'search']);
});
Route::get('/error-permission', function () {
    return view('error.permission');
})->name('error.permission');

Route::middleware(['IsStaff','IsLogin'])->group(function(){
Route::prefix('staff')->name('staff.')->group(function () {
    Route::get('/', [UserController::class, 'Staffindex'])->name('index');
    Route::get('/create', [UserController::class, 'Staffcreate'])->name('create');
    Route::post('/store', [UserController::class, 'Staffstore'])->name('store');
    Route::get('/{id}/edit', [UserController::class, 'Staffedit'])->name('edit');
    Route::put('/{id}', [UserController::class, 'Staffupdate'])->name('update');
    Route::delete('/delete/{id}', [UserController::class, 'Staffdestroy'])->name('delete');
});
Route::prefix('guru')->name('guru.')->group(function () {
    Route::get('/', [UserController::class, 'GuruIndex'])->name('index');
    Route::get('/create', [UserController::class, 'GuruCreate'])->name('create');
    Route::post('/store', [UserController::class, 'GuruStore'])->name('store');
    Route::get('/{id}/edit', [UserController::class, 'GuruEdit'])->name('edit');
    Route::put('/{id}', [UserController::class, 'GuruUpdate'])->name('update');
    Route::delete('/delete/{id}', [UserController::class, 'GuruDestroy'])->name('delete');
});
Route::prefix('letype')->name('letype.')->group(function () {
    Route::get('/', [LetterTypeController::class, 'index'])->name('index');
    Route::get('/create', [LetterTypeController::class, 'create'])->name('create');
    Route::post('/store', [LetterTypeController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [LetterTypeController::class, 'edit'])->name('edit');
    Route::put('/{id}', [LetterTypeController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [LetterTypeController::class, 'destroy'])->name('delete');
    Route::get('/export-excel', [LetterTypeController::class, 'exportExcel'])->name('export-excel');
});
Route::prefix('letter')->name('letter.')->group(function () {
    Route::get('/', [LetterController::class, 'index'])->name('index');
    Route::get('/create', [LetterController::class, 'create'])->name('create');
    Route::post('/store', [LetterController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [LetterController::class, 'edit'])->name('edit');
    Route::put('/{id}', [LetterController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [LetterController::class, 'destroy'])->name('delete');
    Route::get('/letters/export', [LetterController::class, 'export'])->name('export');
});
});

// Route::get('/', function(){
//     return view('login');
// })->name('home');



