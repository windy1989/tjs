<?php

namespace App\Console;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        Artisan::call('warehouse:sync');
        Artisan::call('stock:sync');
        Artisan::call('queue:work --stop-when-empty');
        
        // $schedule->command('warehouse:sync')->everyFiveMinutes()->withoutOverlapping()->runInBackground();
        // $schedule->command('stock:sync')->everyFiveMinutes()->withoutOverlapping()->runInBackground();
        // $schedule->command('queue:work --stop-when-empty')->everyMinute()->withoutOverlapping()->runInBackground();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
