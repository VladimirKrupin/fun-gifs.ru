<?php

namespace App\Console;

use App\Http\Controllers\Posting\InstagrammController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Posting\PostingController;
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
//        $schedule->call(function()
//        {
//            (new UserController())->createUser();
//        })->everyMinute();

        $times = [
            '7:00','7:15','7:30',
            '10:00','10:15','10:30',
            '16:00','16:15','16:30',
            '20:00','20:15','20:30',
        ];
        foreach ($times as $time){
            $schedule->call(function()
            {
                (new PostingController())->wallAllPosting();
            })->dailyAt($time)->timezone('Europe/Moscow');
        }

//        $schedule->call(function()
//        {
//            (new PostingController())->wallAllPosting();
////            (new InstagrammController())->sendInstagramm();
//        })->everyMinute();

//        $schedule->call(function()
//        {
//            (new PostingController())->postingFb();
//        })->everyMinute();



    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
