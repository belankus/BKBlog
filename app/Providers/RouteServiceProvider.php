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
use Illuminate\Contracts\Database\Eloquent\Builder;
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
    public const HOME = '/';

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
            $getRow = Post::where('slug', $slug)->firstOrFail();
            $published_at = $getRow->published_at;
            $published = Carbon::parse($published_at);
            $yearDB = $published->format('Y');
            if ($yearDB == $value) {
                $singlePost = Post::where([
                    'published_at' => $published_at,
                    'slug' => $slug,
                ])->firstOrFail();
                // dd($singlePost);
                return $singlePost;
            } else {
                abort(404);
            }
        });

        // Route::bind('tahun', function ($value) {

        //     $getRows = Post::with('category', 'user', 'tags')->select(DB::raw('*'))->whereRaw("published_at BETWEEN '$value-01-01 00:00:00' AND '$value-12-31 23:59:59' AND published = 1")->paginate(10);

        //     if (count($getRows) != 0) {
        //         return array($getRows, $value);
        //     } else {
        //         abort(404);
        //     }
        // });
    }
}
