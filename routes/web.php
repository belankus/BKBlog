<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
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

Route::prefix('blog')->group(function () {
    Route::get('/', [BlogController::class, 'index']);
    Route::get('categories/{category:slug}', [BlogController::class, 'category']);
    Route::get('tags/{tag:slug}', [BlogController::class, 'tag']);
    Route::get('archive/{tahun}', [BlogController::class, 'tahun']);
    Route::get('archive/{tahun}/{bulan}', [BlogController::class, 'bulan']);
    Route::get('{year}/{slug}', [BlogController::class, 'show']);
});

Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard.index', ['posts' => Post::all()]);
    });
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
    Route::get('posts/checkSlug', [PostController::class, 'checkSlug']);
    Route::post('posts/cache-image', [PostController::class, 'cache']);
    Route::resource('posts', PostController::class);
});


Route::get('/editor', function () {
    return view('editor', ['postData' => Post::where('id', 107)->first()]);
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'store']);
