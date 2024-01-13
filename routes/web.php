<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BikeController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminRegisterController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\Admin\AdminController;

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
Route::get('/park/contact' , [BikeController::class , 'contact'])->name('contact');
Route::post('/park/contact' , [BikeController::class, 'store']);
Route::get('/park', [BikeController::class, 'index'])->name('index')->middleware('auth');
Route::get('/park/index', [BikeController::class, 'selectform'])->name('selectform');
Route::get('/park/facilitysearch', [BikeController::class, 'facilitysearch'])->name('facilitysearch');
Route::get('/park/{facility}', [BikeController::class ,'show'])->name('show');
Route::get('/regions/{region}' , [RegionController::class, 'index']);
Route::get('/park/review/{facility}', [BikeController::class,'review'])->name('review');
Route::post('/park' , [BikeController::class, 'reviewstore'])->name('reviewstore'); //画像を含めた投稿の保存処理
Route::get('/park/{review}', [BikeController::class, 'imageshow']);//投稿詳細画面の表  

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});







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
        
            
   
    Route::get('admin/park/contact' , [AdminController::class , 'contact'])->name('admin.contact');
    Route::post('admin/park/contact' , [AdminController::class, 'store']);
    Route::get('admin/park', [AdminController::class, 'index'])->name('admin.index');
    Route::get('.admin/park/index', [AdminController::class, 'selectform']);
    Route::get('admin/park/facilitysearch', [AdminController::class, 'facilitysearch'])->name('admin.facilitysearch');
    Route::get('admin/park/{facility}', [AdminController::class ,'show'])->name('admin.show');
    Route::get('admin/park/review/{facility}', [AdminController::class,'review'])->name('admin.review');
    Route::post('admin/park' , [AdminController::class, 'reviewstore']); //画像を含めた投稿の保存処理
    Route::get('admin/park/{review}', [AdminController::class, 'imageshow']);//投稿詳細画面の表  
    Route::get('admin/answer', [AdminController::class,'answer'])->name('admin.answer');
    //Route::post('admin/auth/answer' ,[AdminController::class, 'answerStore']);
    
       
    });
});
