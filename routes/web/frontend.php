<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes : Home Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// auth
Route::middleware('guest')->group(function(){
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
});
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


// home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// news page
Route::get('/news-archive/{news:slug}', [HomeController::class, 'news'])->name('home.news');

// topic list page and topic page
Route::prefix('topic-archive')->group(function() {
    // all topics
    Route::get('/', [HomeController::class, 'archive'])->name('home.archive');
    
    // topic page
    Route::get('/{topic:slug}', [HomeController::class, 'topic'])->name('home.topic');
});

// category page
Route::get('/{category:slug}', [HomeController::class, 'categoryNews'])->name('home.cate.news');