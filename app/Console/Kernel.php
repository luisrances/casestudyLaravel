<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\SetupProject;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        // Register your custom commands here
        SetupProject::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        // Define scheduled commands here
    }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
