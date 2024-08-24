<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Middleware\Authenticate;

Route::get('/tex', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {


Route::post('/resim/kaydet', [BlogController::class, 'imagesave'])->name('imagesave');
Route::get('/', [BlogController::class, 'index'])->name('index');
Route::get('/add', [BlogController::class, 'addpage'])->name('addpage');
Route::post('/add', [BlogController::class, 'addblog'])->name('addblog');
Route::get('/detail/{slug}', [BlogController::class, 'detailshow'])->name('detail');
Route::post('/blog/{slug}', [BlogController::class, 'deleteblog'])->name('deleteblog');
Route::get('/edit/{slug}', [BlogController::class, 'updateblog'])->name('updateblog');
 Route::post('/update/{slug}', [BlogController::class, 'updatebutton'])->name('update');
 Route::get('/getTitleList', [BlogController::class,'getTitleList'])->name('getTittle');
 Route::get('/account', [BlogController::class, 'iblogshow'])->name('iblog');//bak
 Route::post('/reset', [AuthController::class, 'resetpassword'])->name('resetpassword');
});
Route::get('/login', [AuthController::class,'showLoginForm'])->name('login');
Route::post('/login-in', [AuthController::class,'login'])->name('login.in');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/kayit-ol', [RegisterController::class, 'register'])->name('register');
Route::get('/kayit-ol', [RegisterController::class, 'showLoginForm'])->name('getregister');
Route::post('/users-delete', [RegisterController::class, 'deregister'])->name('user.delete');

