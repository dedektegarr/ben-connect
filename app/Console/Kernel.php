<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('postdatabase:schedule')
        //      ->everyTwoMinute();
        // Menjadwalkan command postdatabase:schedule untuk berjalan pada pukul 08:00, 12:00, dan 15:00
        // $schedule->command('postdatabase:schedule')
        //         ->hourlyAt(8);  // Jam 8:00
        // $schedule->command('postdatabase:schedule')
        //         ->hourlyAt(16); // Jam 12:00
        $schedule->command('postdatabase:schedule')
            ->timezone('Asia/Jakarta')
            ->at('07:58');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
