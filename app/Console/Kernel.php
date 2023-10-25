<?php

namespace App\Console;

use App\Models\DataCheckpoint;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $checkpoints = DataCheckpoint::where('status', '!=', '')
                // ->where('lokasi_cp', 'office lt.1')
                ->get();

            foreach ($checkpoints as $checkpoint) {
                $checkpoint->update([
                    'status' => ''
                ]);
            }
        })->twiceDaily(4, 19);
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