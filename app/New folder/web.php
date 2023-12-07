<?php
namespace App\Http\Middleware;

use App\Models\User;
use App\Models\Post;
use App\Models\CoverImage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\PostController;
use App\Mail\NailEmail;
use Illuminate\Http\Request;



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

Route::get('/', function () {  return view('login');});

Route::get('/register', function(){ return view('register',[ "coverimage" => CoverImage::all(), ]); })->middleware('guest');

Route::post('/register',[RegisterController::class, 'registration']);

Route::get('/login', function(){ return view('login'); })->name('login')->middleware('guest');

Route::post('/login',[LoginController::class, 'index']);

Route::post('/logout',[LoginController::class, 'logout']);

Route::post('/dashboard/download',[DashboardController::class, 'download'])->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::resource('/dashboard/user', UserController::class);

Route::get('recovery/{user}', function(User $user, Request $request){
    if (! $request->hasValidSignature()) {
        abort(401);
    }

    return view('recovery', [
        'coverimage' => CoverImage::all(),
        'user' => $user
        
    ]);
})->name('recovery');

Route::get('/psnr', function(){ return view('psnr', ['coverimage' => CoverImage::all(), ]); })->middleware('auth');

Route::get('/upload', [PostController::class, 'index'])->middleware('auth');

// Route::get('/dashboard', [PostController::class, 'show'])->middleware('auth');

Route::get('/createpost', [PostController::class, 'create'])->middleware('auth');

Route::post('/store', [PostController::class, 'store'])->middleware('auth');

Route::get('/destroy/{id}', [PostController::class, 'destroy'])->middleware('auth');

Route::get('/download/{file}',[PostController::class, 'download'])->middleware('auth');

Route::post('/dashboard/test/fidelity', [TestController::class, 'fidelity']);

Route::post('/link', [ForgotController::class, 'Mail']);

Route::get('/forgot', function(){ return view("forgot"); });

Route::get('/tes', function(){ return view("tes"); });

Route::get('/info', [InfoController::class, 'index'])->middleware('auth');


Route::post('/forgot', [UserController::class, 'forgot']);

