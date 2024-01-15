<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;
use PhpParser\Node\Stmt\TryCatch;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });

        Route::bind('year', function ($value) {
            $slug = request()->route('slug');
            $getRow = DB::table('posts')->where('slug', $slug)->get()->first();
            $published_at = $getRow->published_at;
            $published = Carbon::parse($published_at);
            $yearDB = $published->format('Y');
            if ($yearDB == $value) {
                $GLOBALS['singlePost'] = Post::where([
                    'published_at' => $published_at,
                    'slug' => $slug,
                ])->firstOrFail();
                // dd($singlePost);
                return $GLOBALS['singlePost'];
            }
        });
    }
}
