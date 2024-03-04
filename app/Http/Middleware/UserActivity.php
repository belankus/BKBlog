<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserActivity as UserActivityModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class UserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $userId = auth()->id();

        if ($userId) {
            // Update the user's online status cache expiration time
            Cache::put('user_' . $userId . '_online', true, now()->addMinutes(5));

            // Update the last_activity timestamp using the UserActivity model
            $userActivity = UserActivityModel::where('user_id', $userId)->first();
            if ($userActivity) {
                $userActivity->last_activity = now();
                $userActivity->save();
            } else {
                // Create a new user activity record if it doesn't exist
                UserActivityModel::create([
                    'user_id' => $userId,
                    'last_activity' => now()
                ]);
            }
        }

        return $response;
    }
}
