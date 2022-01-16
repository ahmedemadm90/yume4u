<?php

namespace App\Console;

use App\Console\Commands\ActiveLottariesCommand;
use App\Console\Commands\ExpirationCommand;
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
        ExpirationCommand::class,
        ActiveLottariesCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //Command To Expire Lotteries
        $schedule->command('command:lotteryExpire')->everyMinute();
        //Command To Active Lotteries
        $schedule->command('command:ActiveCommand')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}