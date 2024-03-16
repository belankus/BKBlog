<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Http\Controllers\PostController;
use App\Livewire\User\ModalImage;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $postController = app()->make(PostController::class);
        $imageProfileController = app()->make(ModalImage::class);

        $schedule->call(function () use ($postController) {
            $postController->cleanupTemporaryImages();
        })->daily();

        $schedule->call(function () use ($imageProfileController) {
            $imageProfileController->cleanupTemporaryImages();
        })->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
