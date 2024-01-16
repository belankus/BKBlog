<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;

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

Route::get('/', [HomeController::class, 'index']);

Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/{year}/{slug}', [BlogController::class, 'show']);
Route::get('/blog/{tahun}', [BlogController::class, 'tahun']);

Route::prefix('dashboard')->group(function () {
    Route::get('/', function () {
        return view('dashboard.index');
    });
    Route::get('posts', function () {
        return view('dashboard.posts.index');
    });
    Route::get('categories', function () {
        return view('dashboard.categories.index');
    });
    Route::get('tags', function () {
        return view('dashboard.tags.index');
    });
    Route::get('users', function () {
        return view('dashboard.users.index');
    });
});

Route::resource('posts', PostController::class);
