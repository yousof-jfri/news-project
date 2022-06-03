<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\TopicController;
use App\Models\Topic;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes : Admin Panel Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// admin
Route::get('/', [AdminController::class, 'index']);

// Profile
Route::get('/profile', [AdminController::class, 'profile'])->name('.profile');

// users
Route::get('/users', [UserController::class, 'index'])->name('.users.index');

// categories
Route::get('/categories', [CategoryController::class, 'index'])->name('.categories.index');

// newses
Route::get('/newses', [NewsController::class, 'index'])->name('.newses.index');

// comments
Route::get('/comments', [CommentController::class, 'index'])->name('.comments.index');

// topic
Route::prefix('/topics')->name('.topics')->group(function () {
    Route::get('/', [TopicController::class, 'index'])->name('.index');
    Route::get('/new-topic', [TopicController::class, 'create'])->name('.create');
    Route::get('/edit/{id}', [TopicController::class, 'edit'])->name('.edit');
});