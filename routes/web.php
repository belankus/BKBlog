<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Models\Category;
use App\Models\Post;


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
Route::get('/blog/categories/{category:slug}', [BlogController::class, 'category']);
Route::get('/blog/tags/{tag:slug}', [BlogController::class, 'tag']);
Route::get('/blog/archive/{tahun}', [BlogController::class, 'tahun']);
Route::get('/blog/archive/{tahun}/{bulan}', [BlogController::class, 'bulan']);
Route::get('/blog/{year}/{slug}', [BlogController::class, 'show']);

Route::prefix('dashboard')->group(function () {
    Route::get('/', function () {
        return view('dashboard.index', ['posts' => Post::all()]);
    });
    Route::get('posts', [PostController::class, 'index']);
    Route::get(
        'categories',
        [CategoryController::class, 'index']
    );
    Route::get('tags', function () {
        return view('dashboard.tags.index');
    });
    Route::get('users', function () {
        return view('dashboard.users.index');
    });
});

Route::resource('posts', PostController::class);
