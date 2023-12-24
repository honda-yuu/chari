<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BikeController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminRegisterController;
use App\Http\Controllers\RegionController;

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

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/park/review/{facility}', [BikeController::class,'review'])->name('review');
Route::get('/park/contact' , [BikeController::class , 'contact'])->name('contact');
Route::post('/park' , [BikeController::class, 'store']);
Route::get('/park', [BikeController::class, 'index'])->name('index')->middleware('auth');
Route::get('/park/index', [BikeController::class, 'selectform'])->name('selectform');
Route::get('/park/facilitysearch', [BikeController::class, 'facilitysearch'])->name('facilitysearch');
Route::get('/park/{facility}', [BikeController::class ,'show'])->name('show');
Route::get('/regions/{region}' , [RegionController::class, 'index']);
Route::post('/park' , [BikeController::class, 'reviewstore'])->name('reviewstore');




require __DIR__.'/auth.php';



Route::group(['prefix' => 'admin'], function () {
    // 登録
    Route::get('register', [AdminRegisterController::class, 'create'])
        ->name('admin.register');

    Route::post('register', [AdminRegisterController::class, 'store']);

    // ログイン
    Route::get('login', [AdminLoginController::class, 'showLoginPage'])
        ->name('admin.login');

    Route::post('login', [AdminLoginController::class, 'login']);

    // 以下の中は認証必須のエンドポイントとなる
    Route::middleware(['auth:admin'])->group(function () {
        // ダッシュボード
        Route::get('dashboard', fn() => view('admin.dashboard'))
            ->name('admin.dashboard');
    });
});
