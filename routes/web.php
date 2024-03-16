<?php

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


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

Route::get('/u/{username}', function ($username) {
    $user = \App\Models\User::where('username', $username)->first();
    if (!$user) {
        abort(404);
    }
    return view('blog');
});

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
        if (Auth::user()->hasRole('superadmin')) {

            $posts = Post::with('category', 'tags')->get();
        } else {
            $posts = Post::with('category', 'tags')->where('user_id', Auth::user()->id)->get();
        }
        return view('dashboard.index', ['posts' => $posts]);
    });
    Route::get('posts/checkSlug', [PostController::class, 'checkSlug']);
    Route::get('categories/checkSlug', [CategoryController::class, 'checkSlug']);
    Route::get('tags/checkSlug', [TagController::class, 'checkSlug']);
    Route::post('posts/cache-image', [PostController::class, 'cache']);
    Route::post('users/{username}/verify', [\App\Http\Controllers\UserController::class, 'verify']);
    Route::post('users/{username}/unverify', [\App\Http\Controllers\UserController::class, 'unverify']);
    Route::post('users/{user:username}/saveImage', [\App\Http\Controllers\UserController::class, 'saveImage'])->name('users.saveImage');
    Route::resource('posts', PostController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
    Route::resource('users', \App\Http\Controllers\UserController::class);
});


Route::get('/editor', function () {
    return view('editor', ['postData' => Post::where('id', 1)->first()]);
});

Route::get('/cropper', function () {
    return view('cropper');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/register', [AuthController::class, 'store']);

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    // Get the authenticated user
    $user = $request->user();

    // Unassign the previous role
    if ($user->hasRole('visitor')) {
        $user->removeRole('visitor');
    }

    // Assign the 'user' role upon successful email verification
    $user->assignRole('user');

    // Fire the Verified event to trigger the event listener
    event(new Verified($user));

    session()->flash('success', 'Verification successful! Please relogin.');

    return redirect('/login');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    /** @var MustVerifyEmail $user */
    $user = auth()->user();
    if ($user instanceof MustVerifyEmail && !$user->hasVerifiedEmail()) {
        $user->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }

    return back();
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
